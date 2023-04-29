<?php declare(strict_types = 1);

namespace Contributte\Nella\DI;

use Contributte\DI\Extension\CompilerExtension;
use Contributte\Nella\Override\Override;
use Contributte\Nella\Routing\RouterFactory;
use Contributte\Nella\Service\AppFolder;
use Contributte\Nella\Service\AppParams;
use Contributte\Nella\Service\Folders;
use Contributte\Nella\Service\LogFolder;
use Contributte\Nella\Service\RootFolder;
use Contributte\Nella\Service\TempFolder;
use Contributte\Nella\Service\WwwFolder;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\DI\Definitions\Statement;

class NellaExtension extends CompilerExtension
{

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('routerFactory'))
			->setFactory(RouterFactory::class);

		$builder->addDefinition($this->prefix('folders'))
			->setFactory(Folders::class, [
				[
					'rootDir' => $builder->parameters['rootDir'],
					'appDir' => $builder->parameters['appDir'],
					'wwwDir' => $builder->parameters['wwwDir'],
					'tempDir' => $builder->parameters['tempDir'],
					'logDir' => $builder->parameters['logDir'],
				],
			]);

		$builder->addDefinition($this->prefix('rootFolder'))
			->setFactory(RootFolder::class, [$builder->parameters['rootDir']]);

		$builder->addDefinition($this->prefix('appFolder'))
			->setFactory(AppFolder::class, [$builder->parameters['appDir']]);

		$builder->addDefinition($this->prefix('wwwFolder'))
			->setFactory(WwwFolder::class, [$builder->parameters['wwwDir']]);

		$builder->addDefinition($this->prefix('logFolder'))
			->setFactory(LogFolder::class, [$builder->parameters['logDir']]);

		$builder->addDefinition($this->prefix('tempFolder'))
			->setFactory(TempFolder::class, [$builder->parameters['tempDir']]);

		$builder->addDefinition($this->prefix('appParams'))
			->setFactory(AppParams::class, [$builder->parameters]);

		$builder->addDefinition($this->prefix('override'))
			->setFactory(Override::class);
	}

	public function beforeCompile(): void
	{
		$builder = $this->getContainerBuilder();

		$routerDef = $builder->getDefinition('routing.router');
		assert($routerDef instanceof ServiceDefinition);
		$routerDef->setFactory(new Statement($this->prefix('@routerFactory::create')));
	}

}
