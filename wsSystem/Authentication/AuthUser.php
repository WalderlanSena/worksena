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

class AuthUser
{
    private $id    = null;
    private $name  = null;
    private $email = null;

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
        if ($this->id == null || $this->nome == null || $this->email == null)
            return false;
        else
            return true;
    }//end método verifyLogin

}//end AuthUser
