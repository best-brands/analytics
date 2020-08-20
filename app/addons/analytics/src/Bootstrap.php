<?php

namespace Tygh\Addons\Analytics;

use Tygh\Core\BootstrapInterface;
use Tygh\Core\HookHandlerProviderInterface;
use Tygh\Core\ApplicationInterface;

class Bootstrap implements BootstrapInterface, HookHandlerProviderInterface
{
    public function boot(ApplicationInterface $app)
    {
        $app->register(new ServiceProvider());
    }

    public function getHookHandlerMap()
    {
        return [
            'before_dispatch' => [
                'addons.analytics.service',
                'onBeforeDispatch',
            ],
            'place_order' => [
                'addons.analytics.service',
                'onPlaceOrder'
            ]
        ];
    }
}
