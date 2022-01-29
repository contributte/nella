<?php declare(strict_types = 1);

namespace Contributte\Nella\UI;

use Contributte\Nella\Override\Override;
use Nette\Application\UI\Presenter;
use Nette\Bridges\ApplicationLatte\Template;
use Nette\DI\Attributes\Inject;

/**
 * Base presenter for all Nella's children.
 *
 * @property-read Template $template
 */
abstract class NellaPresenter extends Presenter
{

	#[Inject]
	public Override $override;

	/**
	 * @return string[]
	 */
	public function formatLayoutTemplateFiles(): array
	{
		return $this->override->getLayoutTemplateFiles($this);
	}

	/**
	 * @return string[]
	 */
	public function formatTemplateFiles(): array
	{
		return $this->override->getTemplateFiles($this);
	}

}
