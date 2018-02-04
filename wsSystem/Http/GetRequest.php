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
        /**
         *  @return Object
         *  Retorna um objeto com o indice GET, onde as requisições post são capturadas
         */
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $request    = [];
            $objRequest = new \stdClass();
            foreach ($_GET as $key => $value) {
                $request[$key] = $value;
            }
            $objRequest->post = (object)$request;
            return $objRequest;
        }

        /**
         *  @return Object
         *  Retorna um objeto com o indice POST, onde as requisições post são capturadas
         */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request    = [];
            $objRequest = new \stdClass();
            foreach ($_POST as $key => $value) {
                $request[$key] = $value;
            }
            $objRequest->post = (object)$request;
            return $objRequest;
        }

        return false;
    }//end newGetRequest

}//end class GetRequest
