<?php
/**
 * --- WorkSena - Micro Framework ---
 *
 * Classe de validação de extensão de arquivo
 *
 * Esta classe valida uma extensão de arquivo de upload.
 *
 * Exemplo: 'png' ou array ('jpg', 'png', 'gif').
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\Upload\Validators;

use Core\Components\File\Messages;

class Extension extends Messages
{
    protected $allowedExtensions;

    /**
     * @param string|array $allowedExtensions Extensões de arquivo permitidas
     */
    public function __construct($allowedExtensions)
    {
        if (is_string($allowedExtensions) === true) {
            $allowedExtensions = array($allowedExtensions);
        }

        $this->allowedExtensions = array_map('strtolower', $allowedExtensions);
    }

    /**
     * @param  FileInfo $fileInfo
     * Metodo que valida a extensão do arquivo
     */
    public function validate(\Core\Components\File\FileInfo $fileInfo)
    {
        $fileExtension = strtolower($fileInfo->getExtension());

        if (in_array($fileExtension, $this->allowedExtensions) === false) {
            return $this->getMessage(['validator' => 'extension', 'message' => 'invalidExtension', 'value' => implode(', ', $this->allowedExtensions)]);
        }
        return true;
    }
}