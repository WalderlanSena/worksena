<?php

/**
 * --- WorkSena - Micro Framework ---
 * Trait Auth - Responsavel por realiza a autenticação ao sistema
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Authentication;

use WsSystem\Components\Validators\ValidatorData;
use WsSystem\Components\RouteRedirector\Redirector;
use WsSystem\Components\Sessions\Session;

trait Auth
{
    private $segundo = 3600;

    // AbstractActionController que realiza o login
    public function loginAction()
    {
        // Sentando o titulo da página
        $this->setPageTitle("Login ");
        // Renderizando a view login
        return $this->render("login");
    }//end loginAction

    // AbstractActionController que realiza a autenticação do usúario
    public function logarAction($request)
    {
        // Capturando requisição na realização do login
        $auth = [
            'login' => $request->post->login,
            'senha' => $request->post->senha
        ];
        // Verificando se os campos não estão vazios
        if (ValidatorData::validatorField($auth, $this->user->rulesAuth())) {
            return Redirector::redirectToRoute("/login", [
                'errors' => ["Ambos campos são Obrigatórios para realizar o login !"]
            ]);
        }//end if
        // Verificando se o email está correto
        $result = $this->user->where("email", $auth['login']);
        /**
         *  Verificando se a senha está correta
         *  password_verify - @param [ Senha digitado, senha do banco de dados ]
         */
        if ($result && password_verify($request->post->senha, $result->senha)) {
            // Caso o login e a senha sejam equivalentes aos do banco de dados
            $dataUser = [
                'id'    => $result->idUsuarios,
                'nome'  => $result->nome,
                'email' => $result->email
            ];
            // Criando a session de usuario logado e passando os dados do banco
            $id_da_session = session_id();
            Session::setSession("user",                       $dataUser);
            Session::setSession("ID_DA_SESSION",              $id_da_session);
            Session::setSession("TEMPO_DA_SESSION",           time() + $this->segundo);
            Session::setSession("IP_DA_SESSION",              $_SERVER['REMOTE_ADDR']);
            Session::setSession("HTTP_USER_AGENT_DA_SESSION", $_SERVER['HTTP_USER_AGENT']);
            Session::setSession("HTTP_HOST_DA_SESSION",       $_SERVER['HTTP_HOST']);
            return Redirector::redirectToRoute("/administrator",[
                'success' => [
                    'Olá, Seja BemVindo(A): '.$dataUser['nome'],
                    'Seu email é: '.$dataUser['email']
                ]
            ]);
        }//end if
        // Caso o login não seja efetuado
        return Redirector::redirectToRoute("/login", [
            'errors' => ['Oppis ! Login ou senha invalidos...'],
            'inputs' => ['email' => $request->post->login]
        ]);
    }//end logarAction

    public function logoutAction()
    {
        Session::destroySessionLogin();
        return Redirector::redirectToRoute("/login",[
            'info' => ['Até logo ! aguardamos você :)']
        ]);
    }//end action exitAction

}//end trait Auth
