<?php

/**
 * --- WorkSena - Micro Framework ---
 * Classe de definição do motor rotas da aplicação
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2018 - @author Walderlan Sena <walderlan@worksena.xyz>
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

        $route = include __DIR__ . '/../wsSystem/Config/routes.php';

        /**
         * Seta as rotas via parâmetro para o método setRoutes
         */
        $this->setRoutes(array_filter($route['routes']));
    }//end initRoutes
}//end class
