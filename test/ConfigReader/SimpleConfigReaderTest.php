<?php
namespace ConfigReader\Test;

use ConfigReader\SimpleConfigReader;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class SimpleConfigReaderTest extends TestCase
{
	private $file_system;
	private $config =  [
		'apps_paths' =>
			[
				[
					'path' => '/var/www/owncloud/apps',
					'url' => '/apps',
					'writable' => false,
				],
				[
					'path' => '/var/www/owncloud/custom',
					'url' => '/custom',
					'writable' => true,
				],
			],
	];

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
	}

	public function testCanReadConfigFile()
	{
		$reader = new SimpleConfigReader($this->config);
		$this->assertSame('/var/www/owncloud/custom', $reader->findPath(), 'Incorrect path returned');
	}
}
