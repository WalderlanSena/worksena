<?php

/**
 * --- WorkSena - Micro Framework ---
 * Classe AuthUser - Respónsavel por retorna dados do usúario logado
 * @license: https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author: Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Authentication;

use WsSystem\Components\Sessions\Session;
use WsSystem\Components\RouteRedirector\Redirector;

class AuthUser
{
    private $id;
    private $name;
    private $email;

    public function __construct()
    {
        // Verificando se o usuario está logado
        if (Session::getSession("user")) {
            // Capturando os dados do array que estão na Session
            $userData    = Session::getSession("user");
            // Atribuindos os dados aos atributos da classe
            $this->id    = $userData['id'];
            $this->nome  = $userData['nome'];
            $this->email = $userData['email'];
        }//end if
    }//end método construct

    /**
     * @return o id do usuario logado no momento
     */
    public function getId()
    {
        return $this->id;
    }//end getID

    /**
     * @return o nome do usuario logado no momento
     */
    public function getNome()
    {
        return $this->nome;
    }//end getNome

    /**
     * @return o email do usuario logado no momento
     */
    public function getEmail()
    {
        return $this->email;
    }//end método getEmail

    /**
     * @return true se o usúario estiver logado
     */
    public function verifyLogin()
    {
        // Verifica se as sessions existem
        if (Session::getSession("user") && Session::getSession('ID_DA_SESSION') && Session::getSession('TEMPO_DA_SESSION') && Session::getSession('IP_DA_SESSION') && Session::getSession('HTTP_USER_AGENT_DA_SESSION') && Session::getSession('HTTP_HOST_DA_SESSION')) {
            // Capturando o id da session atual
            $id_da_session = session_id();
            // Verificando requisitos das sessions existentes
            if (Session::getSession('ID_DA_SESSION') != $id_da_session) {
                // Se a id da sessão do usúario não for igual a session atual
                return false;
            } else if (Session::getSession('TEMPO_DA_SESSION') < time()) {
                // Se o tempo da sessião for ultrapassado
                Session::destroySessionLogin();
                // Redireciona para a view de login após destruir todas as sessions
                return Redirector::redirectToRoute("/login", [
                    'errors' => ['Desculpe ! Sua sessão expirou...']
                ]);
            } else if ($_SESSION['IP_DA_SESSION'] != $_SERVER['REMOTE_ADDR']) {
                // Se o ip da sessão é diferente do ip atual
                return false;
            } else {
                // Retorna true as verificações das sessions estiverem ok
                return true;
            }//end if
        } else {
            // Caso não exista nenhuma session ativa, ou seja o usúario não está logado
            return Redirector::redirectToRoute("/login",[
				'errors' => ['<b>Desculpe, Área Restrita !</b> É nescessário está logado para acessar está página !']
			]);
        }//end if
    }//end método verifyLogin

}//end AuthUser
