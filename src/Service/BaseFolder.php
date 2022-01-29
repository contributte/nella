<?php declare(strict_types = 1);

namespace Contributte\Nella\Service;

abstract class BaseFolder
{

	protected string $folder;

	public function __construct(string $folder)
	{
		$this->folder = $folder;
	}

	public function get(): string
	{
		return $this->folder;
	}

	public function __toString(): string
	{
		return $this->get();
	}

	public function __invoke(): string
	{
		return $this->get();
	}

}
