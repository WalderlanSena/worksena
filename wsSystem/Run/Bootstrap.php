<?php

/**
 * --- WorkSena - Micro Framework ---
 * Classe abstrata responsavel pela configuração de motor de rotas da
 * aplicação. Definindo as mesmas e capturando as requisição solicitadas
 * das views da aplicação...
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena
 *
 */

namespace WsSystem\Run;

use WsSystem\Di\Container;
use WsSystem\Http\GetRequest;

abstract class Bootstrap
{
    private $router; // Atributo que recebe as rotas cadastradas na aplicação
    private $params; // Atributo que recebre os parêmetros passados pelo usuário

    /**
     *  Inicializando a captura e setando as rotas
     */
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }//end construct

    /**
     *  Método abstrado para especificar as rotas do sistema
     */
    abstract protected function initRoutes();

    /**
     * Captura as rotas solicitadas via Url
     * @param passando rotas capturadas via URL
     */
    protected function run($url)
    {
	    // Converte a url para um array de dados
	    $request = explode("/", $url);
        // Limpando a quantidade de parâmetros possivelmente armazenados
        $this->params  = [];
	    // Captura rotas cadastradas na aplicação
	    foreach ($this->router as $route) {
    		// Transforma a posição com a rota em um array
    		$routeBase = explode("/", $route[0]);
    		// Percorre as rotas cadastradas no sistema
    		for ($i = 0; $i < count($routeBase); $i++) {
    			// Verifica se há paramêtros nas rotas cadastradas
    			if ((strpos($routeBase[$i], "{") !== false) && (count($request) == count($routeBase))) {
    				// Se hover substitui o valor de {id} pelo passado na requisição
    				$routeBase[$i]  = $request[$i];
    				$this->params[] = $request[$i];
    			}//end if
    			// Remontando a rota com o paramêntro passado
    			$route[0] = implode($routeBase, "/");
    		}//end for
    		// Verifica se a rota existe
    		if ($url == $route[0]) {
                // Existindo as mesmas são separadas em controller e action respectivamente
                $routeFound = true;
    			$controller = $route[1];
    			$action     = $route[2];
    			break;
    		} else {
                // Se a rota não existir
    			$routeFound = false;
    		}//end if
	    }//end foreach
	    if ($routeFound) {
    		// Instanciando o controller
    		$controller = Container::newController($controller);
    		// Varificando a quantidade de paramentros
    		switch (count($this->params)) {
                // Caso um parâmetro tenha sido passado
    			case 1:
                    if(method_exists($controller, $action))
    				    $controller->$action($this->params[0], GetRequest::get());
                    else
                        Container::pageNotFound();
    				break;
                // Caso dois parâmetro tenha sido passado
    			case 2:
                    if(method_exists($controller, $action))
    				    $controller->$action($this->params[0], $this->params[1], GetRequest::get());
                    else
                        Container::pageNotFound();
    				break;
                // Caso três parâmetro tenha sido passado
    			case 3:
                    if(method_exists($controller, $action))
    				    $controller->$action($this->params[0], $this->params[1], $this->params[2], GetRequest::get());
                    else
                        Container::pageNotFound();
    				break;
                // Caso nenhum parâmetro tenha sido passado
    			default:
                    if(method_exists($controller, $action))
    				    $controller->$action(GetRequest::get());
                    else
                        Container::pageNotFound();
                    break;
    		}//end switch
	    } else {
            // Se a página não foi encontrada - Erro 404
		    Container::pageNotFound();
	    }//end if
    }//end function run

    /**
     * Setando as rotas cadastradas para o atributo da classe
     * @param array com as rotas cadsatradas na aplicação
     */
    protected function setRoutes(array $router)
    {
        $this->router = $router;
    }//end setRoutes

    /**
     * @return retorna as requisições de rotas do usuário
     */
    protected function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }//end getUrl

}//end class
