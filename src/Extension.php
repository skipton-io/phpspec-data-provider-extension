<?php

namespace Kanel\PhpSpec\DataProvider;

use Kanel\PhpSpec\DataProvider\Listener;
use Kanel\PhpSpec\DataProvider\Maintainer;
use PhpSpec\ServiceContainer;

class Extension implements \PhpSpec\Extension
{
	public function load(ServiceContainer $container, array $params)
	{

		$container->define('runner.maintainers.data_provider', function () {
			return new Maintainer();
		}, ['runner.maintainers']);

		$container->define('event_dispatcher.listeners.data_provider', function () {
			return new Listener();
		}, ['event_dispatcher.listeners']);
	}
}
