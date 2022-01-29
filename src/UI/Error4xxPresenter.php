<?php declare(strict_types = 1);

namespace Contributte\Nella\UI;

use Nette\Application\BadRequestException;
use Nette\Application\Request;

class Error4xxPresenter extends NellaPresenter
{

	public function startup(): void
	{
		parent::startup();

		$request = $this->getRequest();

		if ($request !== null && !$request->isMethod(Request::FORWARD)) {
			$this->error('Invalid access to Error4xx presenter');
		}

		$this->setLayout($this->override->getLayoutTemplate());
	}

	public function renderDefault(BadRequestException $exception): void
	{
		// load template 403.latte or 404.latte or ... 4xx.latte
		$file = __DIR__ . '/Templates/' . $exception->getCode() . '.latte';
		$file = is_file($file) ? $file : __DIR__ . '/Templates/4xx.latte';
		$this->template->setFile($file);
	}

}
