<?php declare(strict_types = 1);

namespace Contributte\Nella\Service;

class AppParams
{

	/** @var array<string, mixed> */
	protected array $parameters = [];

	/**
	 * @param array<string, mixed> $parameters
	 */
	public function __construct(array $parameters)
	{
		$this->parameters = $parameters;
	}

	/**
	 * @return array<string, mixed>
	 */
	public function all(): array
	{
		return $this->parameters;
	}

	public function get(string $key): mixed
	{
		return $this->parameters[$key];
	}

}
