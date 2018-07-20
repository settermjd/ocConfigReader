<?php
namespace ConfigReader\Test;

use ConfigReader\SimpleConfigReader;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class SimpleConfigReaderTest extends TestCase
{
	private $file_system;
	private $config;

	public function setUp()
	{
		$directory = [
			'var' => [
				'www' => [
					'ownCloud' => [
						'apps' => [],
						'custom' => []
					]
				]
			]
		];

		// setup and cache the virtual file system
		$this->file_system = vfsStream::setup('/', 655, $directory);
		$this->file_system->getChild('var/www/ownCloud/apps')->chmod(444);

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
			],
		];
	}

	public function testCanReadConfigFile()
	{
		$reader = new SimpleConfigReader($this->config);
		$this->assertSame(vfsStream::url('var/www/ownCloud/custom'), $reader->findPath(), 'Incorrect path returned');
	}
}
