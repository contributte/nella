<?php declare(strict_types = 1);

namespace Contributte\Nella\Form;

use Nette\Application\UI\Form;

class FormFactory
{

	public function create(): Form
	{
		return new Form();
	}

}
