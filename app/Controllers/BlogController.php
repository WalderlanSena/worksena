<?php

/**
 * --- WorkSena - Micro Framework ---
 *	BlogController - Controller do blog da aplicação
 * 	Exemplo de funcionamento do controller
 * 	@license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * 	@copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace App\Controllers;

use WsSystem\Controller\AbstractActionController;
use WsSystem\Di\Container;
use WsSystem\Components\RouteRedirector\Redirector;

class BlogController extends AbstractActionController
{
	private $post;	// Atributo que receberá o retorno da criação do model a ser instanciado

	public function __construct()
	{
		// Mantendo um construtor da classe pai
		parent::__construct();
		// Setando a model a ser trabalhada na classe
		$this->post = Container::getModel('Artigos');
	}//end construct

	// Action index
	public function index()
	{
		// Realizando as buscas pelo os últimos posts cadastrados
		$this->view->posts = $this->post->readAll(5, null, "idArtigo DESC");
		// Setando o titulo da view
		$this->setPageTitle("Blog");
		// Renderizando a view blog
		return $this->render("blog");
	}//end action index

	// Action post - Lista um post especifico (Conteúdo do post por completo)
	public function post($id)
	{
		// Verificando retorno da busca pelo post solicitado pela rota
		if(!$this->view->posts = $this->post->where("link", "$id[0]")){
			return Redirector::redirectToRoute("/404");
		}//end if
		// Setando o titulo da página de listagem de posts
		$this->setPageTitle("{$this->view->posts->titulo}");
		// Renderizando a view responsável pela exibição das postagens
		return $this->render("blogpost");
	}//end action post

}//end classe
