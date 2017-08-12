<?php

namespace App\Models;

use WsSystem\Model\Model;

class Usuarios extends Model
{
    // Sobrescrevendo table da classe pai
    protected $_table = "Usuarios";

    /**
     * Método que define as regras de validação de novos usuarios cadastrados
     * @return Array com as regras de validação dos campos de formulario
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
     *  Método que define as regras de validação do formulario de login
     *  @return Array com as regras de validação do formulario de login
     */
    public function rulesAuth(){
        return [
            "login" => 'required|email',
            "senha" => 'required'
        ];
    }//end rulesAuth
}//end model usuarios
