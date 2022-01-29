<?php declare(strict_types = 1);

namespace Tests\Cases\Override;

use Contributte\Nella\Override\Override;
use Contributte\Nella\Service\AppFolder;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(static function (): void {
	$override = new Override(new AppFolder('/foo'));

	Assert::equal('/foo/UI/@Templates/@layout.latte', $override->getLayoutTemplate());
});
