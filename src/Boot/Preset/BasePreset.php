<?php declare(strict_types = 1);

namespace Contributte\Nella\Boot\Preset;

use Contributte\Bootstrap\ExtraConfigurator;

abstract class BasePreset
{

	abstract public function apply(ExtraConfigurator $configurator): void;

}
