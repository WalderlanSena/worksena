<?php
/**
 * --- WorkSena - Micro Framework ---

 * Classe de validação de extensão de arquivo de mídia
 *
 * Esta classe valida o tipo de mídia de um upload.
 *
 * Exemplo: "image / png"
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\Upload\Validators;

use Core\Components\File\Messages;

class Mimetype extends Messages
{

    protected $mimetypes;
    /**
     * @param string|array $mimetypes
     */
    public function __construct($mimetypes)
    {
        if (is_string($mimetypes) === true) {
            $mimetypes = array($mimetypes);
        }
        $this->mimetypes = $mimetypes;
    }

    /**
     * @param  FileInfo $fileInfo
     * Metodo que valida a extensão do arquivo de mídia
     */
    public function validate(\Core\Components\File\FileInfo $fileInfo)
    {
        if (in_array($fileInfo->getMimetype(), $this->mimetypes) === false) {
            return $this->getMessage(['validator' => 'mimetype', 'message' => 'invalidMimetype', 'value' => implode(', ', $this->mimetypes)]);
        }
        return true;
    }
}