<?php

/**
 * --- WorkSena - Micro Framework ---
 *
 * Classe de mensagens de validação
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\File;

abstract class Messages
{

    /**
     * @param  $message
     * Método que busca a respectiva mensagem de validação
     */
    protected function getMessage(array $message)
    {
        $messages['dimensions'] = [
            'notDetected' => 'Não foi possível detectar as dimensões da imagem.',
            'invalidWidth' => 'A largura da imagem não corrende a largura necessária. Largura necessária: ',
            'invalidHeight' => 'A altura da imagem não corrende a altura necessária. Altura necessária: '
        ];
        $messages['extension'] = [
            'invalidExtension' => 'Extensão de arquivo inválida. Extensões suportadas: '
        ];
        $messages['mimetype'] = [
            'invalidMimetype' => 'Extensão de imagem inválida. Extensões suportadas: '
        ];
        $messages['size'] = [
            'minSize' => 'O tamanho do arquivo é muito pequeno. O arquivo deve ser maior que ou igual a: ',
            'maxSize' => 'O tamanho do arquivo é muito grande. O arquivo deve ser menor que ou igual a: '
        ];
        $messages['file'] = [
            'invalidFilePath' => 'Diretório inválido!',
            'invalidFileName' => 'Nome de arquivo inválido!',
            'requiredFilePath' => 'Especifique um diretório para upload.',
            'requiredFileName' => 'Especifique um nome para o arquivo.',
            'errorUpload' => 'Erro! Não foi possível fazer upload do arquivo.'
        ];

        if(isset($message['value']))
            $message = $messages[$message['validator']][$message['message']].$message['value'];
        else
            $message = $messages[$message['validator']][$message['message']];
        return $message;
    }
}