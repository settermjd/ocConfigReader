<?php
namespace ConfigReader\Test;

use ConfigReader\SimpleConfigReader;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class SimpleConfigReaderTest extends TestCase
{
	/**
	 * @var A vfsStream mocked filesystem
	 */
	private $file_system;

	/**
	 * @var array A simulated ownCloud config/config.php
	 */
	private $config;

	public function setUp()
	{
		$directory = [
			'var' => [
				'www' => [
					'ownCloud' => [
					]
				]
			]
		];

		// setup and cache the virtual file system
		$this->file_system = vfsStream::setup('/', null, $directory);

		vfsStream::newDirectory(
			'apps', 655
		)->at($this->file_system->getChild('var/www/ownCloud'));

		vfsStream::newDirectory(
			'custom', 0444
		)->at($this->file_system->getChild('var/www/ownCloud'));

		vfsStream::newDirectory(
			'apps2', 755
		)->at($this->file_system->getChild('var/www/ownCloud'));

	}

	/**
	 * This tests that if a directory is marked in the config as being
	 * writable and is writable in the filesystem, that it's returned,.
	 */
	public function testReturnsWritableAppDirectory()
	{
		$this->config = [
			'apps_paths' => [
				[
					'path' => vfsStream::url('var/www/ownCloud/apps'),
					'url' => '/apps',
					'writable' => false,
				],
				[
					'path' => vfsStream::url('var/www/ownCloud/custom'),
					'url' => '/custom',
					'writable' => true,
				],
				[
					'path' => vfsStream::url('var/www/ownCloud/apps2'),
					'url' => '/custom',
					'writable' => true,
				],
			],
		];
		$reader = new SimpleConfigReader($this->config);
		$this->assertSame(vfsStream::url('var/www/ownCloud/apps2'), $reader->findPath(), 'Incorrect path returned');
	}

	/**
	 * This tests that if a directory is marked in the config as being
	 * writable and is writable in the filesystem, that it's returned,.
	 */
	public function testReturnsErrorMessageWhenNoValidWritableDirectoryIsFound()
	{
		$this->config = [
			'apps_paths' => [
				[
					'path' => vfsStream::url('var/www/ownCloud/apps'),
					'url' => '/apps',
					'writable' => false,
				],
				[
					'path' => vfsStream::url('var/www/ownCloud/custom'),
					'url' => '/custom',
					'writable' => true,
				],
				[
					'path' => vfsStream::url('var/www/ownCloud/apps2'),
					'url' => '/custom',
					'writable' => false,
				],
			],
		];
		$reader = new SimpleConfigReader($this->config);
		$this->assertSame('No writable apps directory was found.', $reader->findPath(), 'Incorrect path returned');
	}
}
