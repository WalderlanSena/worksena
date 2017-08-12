<?php

/**
 *  WorkSena - Micro Framework PHP -
 *  @author     Walderlan Sena - <walderlan@worksena.xyz>
 *  @license    MIT <https://opensource.org/licenses/MIT>
 *  @warning    Redistributions of files must retain the above copyright notice.
 *  @version    v0.0.1 - <https://github.com/WalderlanSena/worksena>
 *  @link       <https://www.worksena.xyz>
 *  @copyright  Mentes Virtuais Sena © <https://www.mentesvirtuaissena.com>
 *
 */
// verificando e inicializando session
if(!session_id()) session_start();
// incluindo o autoload do composer
require_once __DIR__ . "/../vendor/autoload.php";

// inicializando rotas e a aplicação
$app = new \WsSystem\Routes();
