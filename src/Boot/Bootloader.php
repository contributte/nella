<?php declare(strict_types = 1);

namespace Contributte\Nella\Boot;

use Contributte\Bootstrap\ExtraConfigurator;
use Contributte\Nella\Boot\Preset\BasePreset;

class Bootloader
{

	/** @var BasePreset[] */
	private array $presets = [];

	/** @var callable[] */
	private array $fns = [];

	private function __construct()
	{
		// Use self::create()
	}

	public static function create(): self
	{
		return new self();
	}

	public function use(BasePreset $preset): self
	{
		$this->presets[] = $preset;

		return $this;
	}

	public function fn(callable $callback): self
	{
		$this->fns[] = $callback;

		return $this;
	}

	public function boot(): ExtraConfigurator
	{
		// @todo custom configurator
		$configurator = new ExtraConfigurator();

		// Trigger presets
		array_map(fn (BasePreset $preset) => $preset->apply($configurator), $this->presets);

		// Trigger callbacks
		array_map(fn (callable $fn) => $fn($configurator), $this->fns);

		return $configurator;
	}

}
