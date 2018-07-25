<?php
namespace ConfigReader;

/**
 * Class SimpleConfigReader
 * @package ConfigReader
 */
class SimpleConfigReader
{
	/**
	 * @var array
	 */
	private $config = [];

	/**
	 * String returned to the user.
	 * @var string
	 */
	private $output = 'No writable apps directory was found.';

	/**
	 * SimpleConfigReader constructor.
	 * @param string $config
	 */
	public function __construct($config = '')
	{
		$this->config = $config;
	}

	/**
	 * Find the first app directory path that is set as
	 * being writable and is physically writable in the filesystem
	 *
	 * @return string
	 * @throws \Exception
	 */
	function findPath()
	{
		if (!array_key_exists('apps_paths', $this->config)) {
			throw new \Exception('Configuration is missing the apps_path key');
		}

		foreach ($this->config['apps_paths'] as $path) {
			if ($path['writable'] == true && is_writable($path['path'])) {
				$this->output = $path['path'];
				break;
			}
		}

		return $this->output;
	}
}

