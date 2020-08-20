<?php

namespace Tygh\Addons\Analytics;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['addons.analytics.service'] = function () {
            return new Analytics();
        };
    }
}