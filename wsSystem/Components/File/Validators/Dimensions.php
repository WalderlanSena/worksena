<?php

/**
 * --- WorkSena - Micro Framework ---
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\Upload\Validators;

use Core\Components\File\Messages;

class Dimensions extends Messages
{

    protected $width;
    protected $height;

    /**
     * @param int $expectedWidth
     * @param int $expectedHeight
     */
    function __construct(array $expectedDimensions)
    {
        $this->width = $expectedDimensions['width'];
        $this->height = $expectedDimensions['height'];
    }

    /**
     * @param  FileInfo $fileInfo
     * Metodo que valida as dimensões do arquivo
     */
    public function validate(\Core\Components\File\FileInfo $fileInfo)
    {
        $dimensions = $fileInfo->getDimensions();
        if (!$dimensions) {
            return $this->getMessage(['validator' => 'dimensions', 'message' => 'notDetected']);
        }
        if ($dimensions['width'] != $this->width) {
            return $this->getMessage(['validator' => 'dimensions', 'message' => 'invalidWidth', 'value' => ''.$this->width.'px']);
        }
        if ($dimensions['height'] != $this->height) {
            return $this->getMessage(['validator' => 'dimensions', 'message' => 'invalidHeight', 'value' => ''.$this->height.'px']);
        }
        return true;
    }
}