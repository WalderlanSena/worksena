<?php

/**
 * --- WorkSena - Micro Framework ---
 * Componente de configuração de Sessions
 * Classe responsavel por atribuições via session
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Components\Sessions;

abstract class Session
{
    /**
     * @param $key
     * @param $val
     */
    public static function setSession($key, $val)
    {
        $_SESSION[$key] = $val;
    }//end método setSession

    /**
     * @param $key
     * @return bool
     */
    public static function getSession($key)
    {
        // Se a session existir então retorna a session
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
        // Se não existir retorna false
        return false;
    }//end método getSession

    /**
     * @param $keys
     */
    public static function destroySession($keys)
    {
        // Verifica se a session existe
        if(is_array($keys)){
            foreach($keys as $key)
                unset($_SESSION[$key]);
            // Se não for um array de Session
        } else {
            // Se um array não foi passando, exclui somente a referente passada
            unset($_SESSION[$keys]);
            // unset($_SESSION[$keys]);
        }//end if
    }//end método destroySession

    /**
     * Método para destruir Session criadas pelo sistema de login
     */
    public static function destroySessionLogin()
    {
        Session::destroySession("user");
        Session::destroySession("ID_DA_SESSION");
        Session::destroySession("TEMPO_DA_SESSION");
        Session::destroySession("IP_DA_SESSION");
        Session::destroySession("HTTP_USER_AGENT_DA_SESSION");
        Session::destroySession("HTTP_HOST_DA_SESSION");
    }

}//end class Session
