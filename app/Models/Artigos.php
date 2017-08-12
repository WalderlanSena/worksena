<?php

namespace App\Models;

use WsSystem\Model\Model;

class Artigos extends Model
{
	// Sobescreve atributo da classe Pai(Ou seja a Model)
	protected $_table = "Artigos";
	/**
	 * Método que define as regras de validação de novos usuarios cadastrados
	 * @return Array com as regras de validação dos campos de formulario
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
