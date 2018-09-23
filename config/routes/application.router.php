<?php
/**
 * --- WorkSena - Micro Framework ---
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 * @copyright © 2013-2018 - @author Walderlan Sena <walderlan@worksena.xyz>
 */

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