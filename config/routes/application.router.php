<?php

namespace Config\Router;

use Application\Controller\ApplicationController;

return [
    'main' => [
        'method'        => 'GET',
        'route'         => '/',
        'controller'    =>  ApplicationController::class,
        'action'        => 'index',
    ],

    'home' => [
        'method'        => 'GET',
        'route'         => '/home',
        'controller'    =>  ApplicationController::class,
        'action'        => 'index',
    ],
];