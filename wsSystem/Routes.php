<?php

/**
 * --- WorkSena - Micro Framework ---
 * Classe de definição do motor rotas da aplicação
 * Aqui são definidos exclusivamente as rotas que aplicação utilizara
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem;

use WsSystem\Run\Bootstrap;

class Routes extends Bootstrap
{
    // Método abstrato(Da Classe Bootstrap) para especificar todas as rotas do sistema
    protected function initRoutes()
    {
        /**
         * Ex: Rotas padrões da aplicação
         * Parâmentros a serem passados na criação de novas rotas
         * @param 1 - ('rota acessada', 'Controller', 'Action')
         * @param 2 - Os parâmetros de rotas devem ser passados entre {}, ex: {id}
         *
         */
        $route[] = array('/','IndexController','indexAction');

        $route[] = array('/login','UserController','loginAction');
        $route[] = array('/auth/login','UserController','logarAction');

        $route[] = array('/cadastre-se','UserController','novocadastroAction');
        $route[] = array('/novo/registro','UserController','cadastrandoAction');

        $route[] = array('/blog','BlogController','index');
        $route[] = array('/blog/post/{id}','BlogController','post');

        $route[] = array('/administrator','AdminController','indexAction');
        $route[] = array('/administrator/createnewpost','AdminController', 'createNewPost');
        $route[] = array('/auth/logout','UserController', 'logoutAction');

        /**
         * Seta as rotas via parâmetro para o método setRoutes
         * @param Array com as rotas da aplicação
         */
        $this->setRoutes($route);
    }//end initRoutes
}//end class
