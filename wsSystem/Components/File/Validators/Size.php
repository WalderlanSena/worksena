<?php
/**
 * --- WorkSena - Micro Framework ---
 *
 * Classe de validação de tamanho de arquivo
 *
 * Esta classe valida o tamanho do arquivo de upload usando o máximo e (opcionalmente)
 * limites mínimos de tamanho de arquivo.
 *
 * Exemplo: "5MB"
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\File\Validators;

use Core\Components\File\Messages;

class Size extends Messages
{

    protected $minSize;
    protected $maxSize;

    /**
     * @param int $maxSize
     * @param int $minSize
     */
    public function __construct($maxSize, $minSize = 0)
    {
        if (is_string($maxSize)) {
            $maxSize = File::humanReadableToBytes($maxSize);
        }
        $this->maxSize = $maxSize;

        if (is_string($minSize)) {
            $minSize = File::humanReadableToBytes($minSize);
        }
        $this->minSize = $minSize;
    }

    /**
     * @param  FileInfo $fileInfo
     * Metodo que valida o tamanho do arquivo
     */
    public function validate(\Core\Components\File\FileInfo $fileInfo)
    {
        $fileSize = $fileInfo->getSize();

        if ($fileSize < $this->minSize) {
            return $this->getMessage(['validator' => 'size', 'message' => 'minSize', 'value' => $this->minSize]);
        }

        if ($fileSize > $this->maxSize) {
            return $this->getMessage(['validator' => 'size', 'message' => 'maxSize', 'value' => $this->maxSize]);
        }
        return true;
    }
}