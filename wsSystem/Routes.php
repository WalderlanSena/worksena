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
    /**
     * Método abstrato (Da Classe Bootstrap) para especificar todas as rotas do sistema
     */
    protected function initRoutes()
    {
        /**
         * Ex: Rotas padrões da aplicação
         * Parâmetros a serem passados na criação de novas rotas
         * @param 1 - ('rota acessada', 'Controller', 'AbstractActionController')
         * @param 2 - Os parâmetros de rotas devem ser passados entre {}, ex: {id}
         *
         */
        $route[] = ['/','IndexController','indexAction'];

        $route[] = ['/login','UserController','loginAction'];
        $route[] = ['/auth/login','UserController','logarAction'];

        $route[] = ['/cadastre-se','UserController','novocadastroAction'];
        $route[] = ['/novo/registro','UserController','cadastrandoAction'];

        $route[] = ['/blog','BlogController','index'];
        $route[] = ['/blog/post/{id}','BlogController','post'];
        $route[] = ['/curso/{id}/aula/{id}/aluno/{id}','BlogController','teste'];

        $route[] = ['/administrator','AdminController','indexAction'];
        $route[] = ['/administrator/createnewpost','AdminController', 'createNewPost'];
        $route[] = ['/auth/logout','UserController', 'logoutAction'];

        /**
         * Seta as rotas via parâmetro para o método setRoutes
         */
        $this->setRoutes($route);
    }//end initRoutes
}//end class
