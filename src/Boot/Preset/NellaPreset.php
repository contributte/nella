<?php declare(strict_types = 1);

namespace Contributte\Nella\Boot\Preset;

use Contributte\Bootstrap\ExtraConfigurator;
use Contributte\Nella\DI\NellaExtension;
use Nette\DI\Compiler;

class NellaPreset extends BasePreset
{

	protected string $bootPoint;

	private function __construct(string $bootPoint)
	{
		$this->bootPoint = $bootPoint;
	}

	public static function create(string $bootPoint): self
	{
		return new self($bootPoint);
	}

	public function apply(ExtraConfigurator $configurator): void
	{
		$configurator->setEnvDebugMode();

		$configurator->addStaticParameters([
			'rootDir' => dirname($this->bootPoint),
			'appDir' => $this->bootPoint,
			'wwwDir' => realpath($this->bootPoint . '/../www'),
			'logDir' => realpath($this->bootPoint . '/../var/log'),
			'tempDir' => realpath($this->bootPoint . '/../var/tmp'),
		]);

		$configurator->enableTracy($this->bootPoint . '/../var/log');

		$configurator->onCompile[] = static function (ExtraConfigurator $configurator, Compiler $compiler): void {
			$compiler->addExtension('nella', new NellaExtension());

			// nette/application conventions
			$compiler->addConfig([
				'application' => [
					'catchExceptions' => '%productionMode%',
					'errorPresenter' => 'Nella:Error',
					'mapping' => [
						'*' => ['App\UI', '*', '*\*Presenter'],
						'Nella' => 'Contributte\Nella\UI\*Presenter',
					],
				],
			]);

			// nette/http conventions
			$compiler->addConfig([
				'session' => [
					'debugger' => '%debugMode%',
					'expiration' => '+14 days',
					'autoStart' => 'smart',
				],
			]);

			// nette/http conventions
			$compiler->addConfig([
				'http' => [
					'headers' => [
						'X-XSS-Protection' => '1; mode=block',
						'X-Powered-By' => 'contributte',
					],
				],
			]);

			// nette/routing conventions
			$compiler->addConfig([
				'routing' => [
					'debugger' => '%debugMode%',
				],
			]);

			// nette/di conventions
			$compiler->addConfig([
				'di' => [
					'debugger' => '%debugMode%',
				],
			]);

			// tracy/tracy conventions
			$compiler->addConfig([
				'tracy' => [
					'strictMode' => true,
				],
			]);
		};

		$configurator->addConfig($this->bootPoint . '/../config/config.neon');

		if (file_exists($this->bootPoint . '/../config/local.neon')) {
			$configurator->addConfig($this->bootPoint . '/../config/local.neon');
		}
	}

}
