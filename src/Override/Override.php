<?php declare(strict_types = 1);

namespace Contributte\Nella\Override;

use Contributte\Nella\Service\AppFolder;
use Contributte\Nella\UI\NellaPresenter;
use Nette\Application\Helpers;

class Override
{

	protected AppFolder $appFolder;

	public function __construct(AppFolder $appFolder)
	{
		$this->appFolder = $appFolder;
	}

	/**
	 * @return string[]
	 */
	public function getLayoutTemplateFiles(NellaPresenter $presenter): array
	{
		$layout = $presenter->getLayout();
		if (is_string($layout) && preg_match('#/|\\\\#', $layout) !== false) {
			return [$layout];
		}

		[$module, $presenterName] = Helpers::splitName((string) $presenter->getName());

		$dir = dirname((string) $presenter::getReflection()->getFileName());

		$dir = is_dir($dir . '/Templates') ? $dir : dirname($dir);
		$list = [
			$dir . '/Templates/' . $presenterName . '/@layout.latte',
			$dir . '/Templates/' . $presenterName . '.@layout.latte',
		];

		do {
			$list[] = dirname($dir) . '/@Templates/@layout.latte';
			$dir = dirname($dir);
		} while ($dir !== '' && $module && ([$module] = Helpers::splitName($module)) !== []);

		return $list;
	}

	/**
	 * @return string[]
	 */
	public function getTemplateFiles(NellaPresenter $presenter): array
	{
		$dir = dirname((string) $presenter::getReflection()->getFileName());

		return [
			$dir . '/Templates/' . $presenter->getView() . '.latte',
		];
	}

	public function getLayoutTemplate(): string
	{
		return ((string) $this->appFolder) . '/UI/@Templates/@layout.latte';
	}

}
