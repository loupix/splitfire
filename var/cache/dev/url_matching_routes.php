<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/events' => [
            [['_route' => 'events', '_controller' => 'App\\Controller\\EventsController::view'], null, null, null, false, false, -1],
            [['_route' => 'events_add', '_controller' => 'App\\Controller\\EventsController::add'], null, ['POST' => 0, 'PUT' => 1], null, false, false, null],
            [['_route' => 'events_get', '_controller' => 'App\\Controller\\EventsController::view'], null, ['GET' => 0, 'HEAD' => 1], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    static function ($condition, $context, $request) { // $checkCondition
        switch ($condition) {
            case -1: return in_array($context->getMethod(), [0 => "GET", 1 => "HEAD"]);
        }
    },
];
