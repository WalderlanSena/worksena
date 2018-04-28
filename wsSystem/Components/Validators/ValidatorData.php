<?php

/**
 * --- WorkSena - Micro Framework ---
 * Componente de validação dos campos requeridos a aplicação
 * Classe responsavel por realizar a validação dos dados
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace WsSystem\Components\Validators;

use WsSystem\Components\Sessions\Session;

abstract class ValidatorData
{
    /**
     * Método que realiza campos de inserção via formulário na aplicação
     * @param array $data
     * @param array $rules
     * @return bool
     */
    public static function validatorField(array $data, array $rules)
    {
        $errors = null;  // variável que recebe os erros retornados pela a validação

        //Percorrendo as regras passadas
        foreach ($rules as $rulesKey => $rulesValue) {
            // Percorrendo o array de dados
            foreach ($data as $dataKey => $dataValue) {
                // Se a regra for igual as dado referido
                if ($rulesKey == $dataKey) {
                    // Zerando $itemsValue
                    $itemsValue = [];
                    // Verificação se há dupla verificação no mesmo campo
                    if (strpos($rulesValue, "|")) {
                        // Separando os dados de verificação em um array
                        $itemsValue = explode("|", $rulesValue);
                        // Percorrendo os dados separadamente
                        foreach ($itemsValue as $itemValue) {
                            // Zerando o $subItems
                            $subItems = [];
                            // Verificando se há o parâmetros de definição de caracteres
                            if (strpos($itemValue, ":")) {
                                $subItems = explode(":", $itemValue);
                                // Inicia-se o processo de verificação
                                switch ($subItems[0]) {
                                    // Caso seja uma definição de tamanho minimo de caractere
                                    case 'min':
                                        if (strlen($dataValue) < $subItems[1])
                                            $errors["$rulesKey"] = "O campo deve conter no minimo {$subItems[1]} caracteres !";
                                            break;
                                    // Caso seja uma definição de tamanho máximo de caractere
                                    case 'max':
                                        if (strlen($dataValue) > $subItems[1])
                                            $errors["$rulesKey"] = "O campo deve conter no máximo {$subItems[1]} caracteres !";
                                        break;
                                }//end switch
                            } else {
                                // Testando as regras
                                switch ($itemValue) {
                                    // Verificando se o campo está vazio
                                    case 'required':
                                        if ($dataValue == ' ' || empty($dataValue))
                                            $errors["$rulesKey"] = "O campo {$rulesKey} é requerido !";
                                        break;
                                    // Verificando se o campo é um email
                                    case 'email':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL))
                                            $errors["$rulesKey"] = "O campo {$rulesKey} não é um email válido !";
                                        break;
                                    // Verificando se o campo é um inteiro
                                    case 'int':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_INT))
                                            $errors["$rulesKey"] = "O campo {$rulesKey} dever ser inteiro !";
                                        break;
                                    // Verificando se o campo é um float
                                    case 'float':
                                        if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT))
                                            $errors["$rulesKey"] = "O campo {$rulesKey} dever ser decimal !";
                                        break;
                                    case 'date':
                                        $data = explode("/", $dataValue);
                                        $d = $data[0];
                                    	$m = $data[1];
                                    	$y = $data[2];
                                    	$res = checkdate($m,$d,$y);
                                    	if (!$res)
                                    	   $errors["$rulesKey"] = "O campo {$rulesKey} contem um data invalida !";
                                        break;
                                    // Se os casos acima não forem atendidos executa o padrão
                                    default:
                                        break;
                                }//end switch
                            }//end if $itemsstr
                        }//end foreach itemsValues

                    // Verificando se há parâmetros referente ao tamanhos caracteres
                    } elseif (strpos($rulesValue, ":")) {
                        // Separando os itens dos valores
                        $itens = explode(":", $rulesValue);
                        // Inicia-se o processo de verificação
                        switch ($itens[0]) {
                            // Caso seja uma definição de tamanho minimo de caractere
                            case 'min':
                                if (strlen($dataValue) < $itens[1])
                                    $errors["$rulesKey"] = "O campo deve conter no minimo {$itens[1]} caracteres !";
                                break;
                            // Caso seja uma definição de tamanho máximo de caractere
                            case 'max':
                                if (strlen($dataValue) > $itens[1])
                                    $errors["$rulesKey"] = "O campo deve conter no máximo {$itens[1]} caracteres !";
                                break;
                        }//end switch
                    }// end if position :
                } else {
                    // Testando as regras
                    switch ($rulesValue) {
                        // Verificando se o campo está vazio
                        case 'required':
                            if ($dataValue == ' ' || empty($dataValue))
                                $errors["$rulesKey"] = "O campo {$rulesKey} é requerido !";
                            break;
                        // Verificando se o campo é um email
                        case 'email':
                            if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL))
                                $errors["$rulesKey"] = "O campo {$rulesKey} não é um email válido !";
                            break;
                        // Verificando se o campo é um inteiro
                        case 'int':
                            if (!filter_var($dataValue, FILTER_VALIDATE_INT))
                            $errors["$rulesKey"] = "O campo {$rulesKey} dever ser inteiro !";
                        break;
                        // Verificando se o campo é um float
                        case 'float':
                            if (!filter_var($dataValue, FILTER_VALIDATE_FLOAT))
                                $errors["$rulesKey"] = "O campo {$rulesKey} dever ser decimal !";
                            break;
                        case 'date':
                            $data = explode("/", $dataValue);
                            $d = $data[0];
                        	$m = $data[1];
                        	$y = $data[2];
                        	$res = checkdate($m,$d,$y);
                        	if (!$res)
                        	   $errors["$rulesKey"] = "O campo {$rulesKey} contem uma data invalida !";
                            break;
                        // Se os casos acima não forem atendidos executa o padrão
                        default:
                            break;
                    }//end switch
                }//end if de verificação das chaves de verificação
            }//end foreach data
        }//end foreach rules

        /**
         * Retornando os erros encontrado, caso existam
         */
        if ($errors) {
            // Se houver erros, retorna true
            Session::setSession('errors', $errors);
            Session::setSession('inputs', $data);
            return true;
        } else {
            // Se não houver erros retorna false
            Session::destroySession(['errors','inputs']);
            return false;
        }//end if
    }//end método validatorField

}//end ValidatorData
