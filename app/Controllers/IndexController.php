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

use WsSystem\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    /**
     * @return Render view Index
     */
	public function indexAction()
    {
        // Seta um titulo dinâmico para view
		$this->setPageTitle("WorkSena - Default Themes - WorkSena Micro Framework");
		// Renderizando a view
	    return $this->render("index");
	}//end action index

}//end class
