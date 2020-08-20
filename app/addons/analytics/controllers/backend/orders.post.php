<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($mode === 'details' && ($order_id = intval($_REQUEST['order_id']) ?? 0)) {
        Tygh::$app['view']->assign('analytics', db_get_array(
            'SELECT * FROM ?:order_connections WHERE order_id = ?i',
            $order_id
        ));
    }
}