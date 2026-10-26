<?php declare(strict_types = 1);

namespace Contributte\Nella\Routing;

use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;

class RouterFactory
{

	public function create(): Router
	{
		$router = new RouteList();
		// $router->addRoute('[<module>/]<presenter>/<action>', 'Home:default');
		$router->addRoute('<presenter>/<action>', 'Home:default');

		return $router;
	}

}
