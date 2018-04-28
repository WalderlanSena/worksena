<?php

/**
 * --- WorkSena - Micro Framework ---
 * Componente de Redirecionamento automático da aplicação
 * Classe de Redirecionamento de rotas
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Components\RouteRedirector;

use WsSystem\Components\Sessions\Session;

abstract class Redirector
{
    /**
     * Método estático responsável pelo Redirecionamento a partir do parâmetro (rota) passado
     * @param $route
     * @param array $message
     */
    public static function redirectToRoute($route, $message = [])
    {
        // Verifica se o array foi passado com as mensagens
        if (count($message) > 0)
            foreach ($message as $key => $value)
                Session::setSession($key, $value);
                // Se não passado apensa realiza o redirecionamento
                return header("Location: $route");
    }//end método setRedirector

}//end class
