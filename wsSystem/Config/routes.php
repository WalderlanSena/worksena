<?php
/**
 * --- WorkSena - Micro Framework ---
 * Retorna as rotas que serão utilizadas na aplicação
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2018 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Config;

return [
    'routes' => [

        'main' => [
            'route'         => '/',
            'controller'    => 'IndexController',
            'action'        => 'indexAction'
        ],

        'home' => [
            'authentication'    => [
                'redirect' => '/'
            ],
            'route'             => '/home',
            'controller'        => 'IndexController',
            'action'            => 'indexAction'
        ],
    ],
];