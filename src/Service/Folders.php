<?php declare(strict_types = 1);

namespace Contributte\Nella\Service;

use Contributte\Nella\Exception\RuntimeException;

class Folders
{

	/** @var string[] */
	protected array $dirs = [];

	/**
	 * @param string[] $dirs
	 */
	public function __construct(array $dirs)
	{
		$this->dirs = $dirs;
	}

	public function getRootDir(): string
	{
		return $this->dirs['rootDir'] ?? throw new RuntimeException('Cannot get rootDir');
	}

	public function getAppDir(): string
	{
		return $this->dirs['appDir'] ?? throw new RuntimeException('Cannot get rootDir');
	}

	public function getWwwDir(): string
	{
		return $this->dirs['wwwDir'] ?? throw new RuntimeException('Cannot get wwwDir');
	}

	public function getLogDir(): string
	{
		return $this->dirs['logDir'] ?? throw new RuntimeException('Cannot get logDir');
	}

	public function getTempDir(): string
	{
		return $this->dirs['tempDir'] ?? throw new RuntimeException('Cannot get tempDir');
	}

}
