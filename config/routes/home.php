<?php
/**
 * --- WorkSena - Micro Framework ---
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 * @copyright © 2013-2018 - @author Walderlan Sena <walderlan@worksena.xyz>
 */

namespace Config\Router;

use App\Controller\Home\HomeController;

return [
    'main' => [
        'method'        => 'GET',
        'route'         => '/',
        'controller'    =>  HomeController::class,
        'action'        => 'index',
    ]
];