<?php

namespace App\Models;

use WsSystem\Model\Model;

class User extends Model
{
    // Subscreve o atributo da classe Pai (Ou seja a WsSystem\Model\Model)
    protected $_table = "User";

    /**
     * Método que define as regras de validação de novos usuários cadastrados
     * @return array
     */
    public function rules()
    {
      return [
        "nome"  => 'required|max:30',
        "email" => 'required|email',
        "senha" => 'required|min:8'
      ];
    }//end rules

    /**
     * Método que define as regras de validação de novos usuarios cadastradas
     * @return array
     */
    public function rulesAuth(){
        return [
            "login" => 'required|email',
            "senha" => 'required'
        ];
    }//end rulesAuth
}//end model usuários
