<?php

/**
 * --- WorkSena - Micro Framework ---
 * Dependency Injection - Depêndencia da aplicação
 * Classe responsavel por realizações extras da aplicação, como retornar
 * objetos criados
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena
 *
 */

namespace WsSystem\Di;

use WsSystem\Database\Database;

abstract class Container
{
    /**
     * Método que retorna um novo controller
     * @param $controller
     * @return mixed
     */
    public static function newController($controller)
    {
        $objController = "\App\\Controllers\\".$controller;
        return new $objController;
    }//end Método newController

    /**
     * Método que retorna um novo model
     * @param $model
     * @return mixed
     */
    public static function getModel($model)
    {
        $objModel = "\App\\Models\\".$model;
        return new $objModel(Database::getConection());
    }//end método getModel

    /**
     * Método de erro 404
     * @return mixed
     */
    public static function pageNotFound()
    {
        if (file_exists("../app/Views/errors/404.php")) {
            return require_once "../app/Views/errors/404.php";
        } else {
            echo "Erro: Página não encontrada...";
        }
    }//end método pageNotFound

}//end classe Container
