<?php

/**
 * --- WorkSena - Micro Framework ---
 * AdminController - Controller de administração da aplicação
 * Exemplo de funcionamento do controller
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace App\Controllers;

use WsSystem\Controller\Action;
use WsSystem\Di\Container;
use WsSystem\Components\RouteRedirector\Redirector;
use WsSystem\Components\Validators\ValidatorData;
use WsSystem\Components\Sessions\Session;

class AdminController extends Action
{
    private $post; // Atributo que recebe o retorno do objeto Model a ser trabalhado
    private $user; // Atributo que recebe o retorno do objeto Model a ser trabalhado

    //  Método construct
    public function __construct()
    {
        // Mantendo o construtor da classe Pai
        parent::__construct();
        // Setando o trabalho com a Model Artigos
        $this->post = Container::getModel("Artigos");
    }//end metodo

    // Action index do administrator
    public function indexAction()
    {
        // Verificando a existencia de usúario logado no sistema
		if (!$this->auth->verifyLogin() && Session::getSession('user')) {
			return Redirector::redirectToRoute("/auth/logout",[]);
		}
        // Retorna todos os últimos 5 posts registrados no banco de dados
        $this->view->posts = $this->post->readAll(5, null, "idArtigo DESC");
        // Setando o titulo da página
        $this->setPageTitle("Administração");
        // Renderizando a view do administrator
        return $this->render("administrator");
    }//end indexAction

    // Action novo - realiza o cadastro de uma nova postagem no blog
	public function createNewPost($request)
    {
	    // Montado um array com os dados pego via requisição POST
        $data = [
            "titulo"   	=> $request->post->titulo,
		    "autor"   	=> $request->post->autor,
		    "descricao" => $request->post->descricao,
		    "conteudo" 	=> $request->post->conteudo,
		    "link"    	=> $request->post->link,
            // Código que deve ser gerado automaticamente para diferenciar criptograficamente os posts
            "codArtigo" => md5(sha1(base64_encode("{$request->post->conteudo}".date('d h i s'))))
		];//end array dos dados capturados

        // Validando os dados enviandos ao banco de dados
        if (ValidatorData::validatorField($data, $this->post->rules())) {
            return Redirector::redirectToRoute("/administrator");
        }
		// Verificando se os dados foram inseridos com sucesso
		if ($this->post->insert($data)) {
			return Redirector::redirectToRoute("/administrator",[
                'success' => ['Postagem realizada com sucesso !']
            ]);
		} else {
		    return Redirector::redirectToRoute("/administrator", [
                'errors' => ['Não foi possivel inserir os dados desejados !']
            ]);
		}//end if
    }//end createNewPost

}//end controller Admin
