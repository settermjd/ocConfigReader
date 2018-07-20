<?php
namespace ConfigReader;

class SimpleConfigReader
{
	private $config = '';
	private $output = 'No writable apps directory was found.';

	public function __construct($config = '')
	{
		$this->config = $config;
	}

	/**
	 * Find the first writable app directory path
	 *
	 * @return string
	 */
	function findPath()
	{
		if (array_key_exists('apps_paths', $this->config)) {
			// Returns the first available app directory, if one is available.
			foreach ($this->config['apps_paths'] as $path) {
				if ($path['writable'] == true) {
					$this->output = $path['path'];
					break;
				}
			}
		}

		return $this->output;
	}
}

