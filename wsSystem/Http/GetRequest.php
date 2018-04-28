<?php

/**
 * --- WorkSena - Micro Framework ---
 * GetRequest - Captura as solicitações via GET e POST da aplicação
 * Transforma as requisições no tipo objeto e disponibiliza para o controller
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena
 *
 */

namespace WsSystem\Http;

abstract class GetRequest
{
    /**
     * Método responsável pela captura das requisições HTTP
     * @return bool|\stdClass
     */
    public static function getRequests()
    {
        /**
         *  @return Object
         *  Retorna um objeto com o índice GET, onde as requisições post são capturadas
         */
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $request    = [];
            $objRequest = new \stdClass();
            foreach ($_GET as $key => $value) {
                $request[$key] = $value;
            }
            $objRequest->get = (object)$request;
            return $objRequest;
        }

        /**
         *  @return Object
         *  Retorna um objeto com o índice POST, onde as requisições post são capturadas
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
