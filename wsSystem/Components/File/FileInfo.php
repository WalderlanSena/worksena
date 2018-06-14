<?php
/**
 * --- WorkSena - Micro Framework ---
 *
 * Classe para descobrir as informações do arquivo
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\File;

class FileInfo
{
    private $size;
    private $extension;
    private $mimetype;
    private $dimensions;

    public function __construct($file)
    {
        $this->setSize($file);
        $this->setExtension($file);
        $this->setMimetype($file);
        $this->setDimensions($file);
    }

    /**
     * Método de retorno do tamanho do arquivo
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Método que seta a extensão do arquivo
     */
    private function setSize($file)
    {
        return $this->size = filesize($file["tmp_name"]);
    }

    /**
     * Método de retorno da extensão do arquivo
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Método que seta a extensão do arquivo
     */
    private function setExtension($file)
    {
        return $this->extension = pathinfo($file["name"], PATHINFO_EXTENSION);
    }

    /**
     * Metodo de retorno do mimetype
     *
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Método que seta o mimetype do arquivo
     */
    private function setMimetype($file)
    {
        $mtype = false;
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mtype = finfo_file($finfo, $file["tmp_name"]);
            finfo_close($finfo);
        } elseif (function_exists('mime_content_type')) {
            $mtype = mime_content_type($file["tmp_name"]);
        }
        return $this->mimetype = $mtype;
    }

    /**
     * Método que seta o mimetype do arquivo
     *
     * @return array
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Método que seta o mimetype do arquivo
     */
    private function setDimensions($file)
    {
        list($width, $height) = getimagesize($file["tmp_name"]);

        return $this->dimensions = ['width' => $width, 'height' => $height];
    }
}