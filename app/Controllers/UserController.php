<?php

/**
 * --- WorkSena - Micro Framework ---
 * UserController - Controller que realiza operações pertinetes aos usuario
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace App\Controllers;

use WsSystem\Controller\Action;
use WsSystem\Di\Container;
use WsSystem\Components\Validators\ValidatorData;
use WsSystem\Components\RouteRedirector\Redirector;
use WsSystem\Authentication\Auth;

class UserController extends Action
{
    use Auth;   //Trait que realiza login e logout dos usuarios

    private $user;  // Atributo que receberá um objeto model

    public function __construct()
    {
        parent::__construct();
        $this->user = Container::getModel("Usuarios");
    }//end construct

    // Action que chama a página de cadastro de novos usuarios
    public function novocadastroAction()
    {
        // Setando o titulo da página
        $this->setPageTitle("Cadastre-se");
        // Renderizando a view cadastre-se
        return $this->render("cadastre-se");
    }//end newRegister

    public function cadastrandoAction($request)
    {
        //Capturados os dados enviados via post
        $data = [
            'nome'  => $request->post->nome,
            'email' => $request->post->email,
            'senha' => $request->post->senha
        ];

        //Validando os dados capturados
        if (ValidatorData::validatorField($data, $this->user->rules())) {
            return Redirector::redirectToRoute("/cadastre-se", [
                'errors' => ['Oppis ! Erro ao cadastrar-se'],
                'inputs' => [
                    'nome'  => $request->post->nome,
                    'email' => $request->post->email
                ]
            ]);
        }//end if

        $data['senha'] = password_hash($request->post->senha, PASSWORD_BCRYPT);

        if ($this->user->insert($data)) {
            return Redirector::redirectToRoute("/cadastre-se",[
                'success' => [
                    'Usúario cadastrado com sucesso !  ',
                    'Verifique seu email para confirmar o cadastro.'
                ]
            ]);
        } else {
            return Redirector::redirectToRoute("/Cadastre-se",[
                'errors' => ['Desculpe ! Não foi possivel realizar seu cadastro']
            ]);
        }//end if

    }//end cadastrandoAction

}//end Controller UserController
