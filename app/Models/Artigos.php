<?php

namespace App\Models;

use WsSystem\Model\Model;

class Artigos extends Model
{
	// Subscreve o atributo da classe Pai (Ou seja a WsSystem\Model\Model)
	protected $_table = "Artigos";

    /**
     * Método que define as regras de validação de novos usuários cadastrados
     * @return array
     */
	public function rules()
	{
		return  [
			"titulo"   	=> "min:2|max:10",
			"autor"   	=> "required",
			"descricao" => "required",
			"conteudo" 	=> "required",
			"link"    	=> "required"
		];
	}//end rules

}//end model artigos
