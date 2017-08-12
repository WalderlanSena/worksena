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
     * @param $key nome da session que será criada
     * @param $val valor que recebera a session
     */
    public static function setSession($key, $val)
    {
        $_SESSION[$key] = $val;
    }//end método setSession

    /**
     * @param key referente a Session a ser capturada
     * @return a session e seu repectivo valor ou
     * @return false caso não encontre a mesma
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
     * @param key referente a Session a ser destruida
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

}//end class Session
