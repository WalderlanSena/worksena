<?php

/**
 * --- WorkSena - Micro Framework ---
 * IndexController - Controller do index da aplicação
 * Exemplo de funcionamento do controller
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace App\Controllers;

use WsSystem\Controller\Action;

class IndexController extends Action
{
    /**
     * ActionIndex - Primeira view a ser chamada pela app
     * @return Render view Index 
     */
	public function indexAction()
    {
        // Seta um titulo dinâmico para view
		$this->setPageTitle("WorkSena - Default Themes");
		// Renderizando a view
	    return $this->render("index");
	}//end action index

}//end class
