<?php

namespace Tygh\Addons\Analytics;

use Tygh\Tygh;

class Analytics
{
    /**
     * Before executing our dispatching, we will save the HTTP referer headers and all
     *
     * @hook before_dispatch
     *
     * @param $controller
     * @param $mode
     * @param $action
     * @param $dispatch_extra
     * @param $area
     */
    public function onBeforeDispatch(&$controller, &$mode, &$action, &$dispatch_extra, &$area)
    {
        if ($area !== 'C' || defined('CRAWLER') || defined('NO_SESSION'))
            return;

        $analytics = [
            'browser' => USER_AGENT,
            'utm_source' => $_GET['utm_source'] ?? '',
            'utm_campaign' => $_GET['utm_campaign'] ?? '',
            'utm_medium' => $_GET['utm_medium'] ?? ''
        ];

        if (!$analytics['utm_source'] || !$analytics['$utm_campaign'])
            return;

        if (!isset(Tygh::$app['session']['analytics']))
            Tygh::$app['session']['analytics'] = [];

        if (count(Tygh::$app['session']['analytics']) <= 5 && !in_array($analytics, Tygh::$app['session']['analytics']))
            Tygh::$app['session']['analytics'][] = $analytics;
    }

    /**
     * Save the analytical data when an order is placed-
     *
     * @hook place_order
     *
     * @param $order_id
     * @param $action
     * @param $order_status
     * @param $cart
     * @param $auth
     */
    public function onPlaceOrder(&$order_id, &$action, &$order_status, &$cart, &$auth)
    {
        $analytics = Tygh::$app['session']['analytics'] ?? [];

        foreach ($analytics as &$analytic) {
            $analytic['order_id'] = $order_id;
        }

        if (empty($cart['order_id']))
            db_query("INSERT INTO ?:order_connections ?m", $analytics);
    }
}