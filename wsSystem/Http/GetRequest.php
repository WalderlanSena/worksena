<?php

/**
 * --- WorkSena - Micro Framework ---
 * GetRequest - Captura as solicitaçẽos via GET e POST da aplicação
 * Tranforma as requisições no tipo objeto e disponibiliza para o controller
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena
 *
 */

namespace WsSystem\Http;

abstract class GetRequest
{
    /**
     * Método responsavel pela captura das requisições atualmente suportadas pelo
     * Micro-framework
     * @return Requisições via GET ou POST
     */
    public static function get()
    {
        // Cria um objeto como o nome obj
        $newRequest = new \stdClass();
        
        // Recebe requisições via GET
        foreach ($_GET as $key => $value)
            $newRequest->get->$key = $value;

        // Recebe requisições via POST
        foreach ($_POST as $key => $value)
            $newRequest->post->$key = $value;

        // Retora os dados em forma de objeto
        return $newRequest;
    }//end newGetRequest

}//end class GetRequest
