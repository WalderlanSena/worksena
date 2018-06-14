<?php

/**
 * --- WorkSena - Micro Framework ---
 *
 * Classe de métodos para funções comuns de arquivo
 *
 * @license https://github.com/WalderlanSena/worksena/blob/master/LICENSE (MIT License)
 *
 * @copyright © 2013-2017 - @author Walderlan Sena <walderlan@worksena.xyz>
 *
 */

namespace Core\Components\File;

class File extends Messages
{

    private $fileName;
    private $filePath;
    private $validators;
    private $nameSpaceValidators;

    public function __construct()
    {
        $this->nameSpaceValidators = '\\Core\\Components\\Upload\\Validators\\';
    }

    public function setFilePatch($path){
        if(!is_null($path))
            $this->filePath = $path;
        else
            return $this->getMessage(['validator' => 'file', 'message' => 'invalidFilePath']);
    }

    public function setFileName($path){
        if(!is_null($path))
            $this->filePath = $path;
        else
            return $this->getMessage(['validator' => 'file', 'message' => 'invalidFileName']);
    }

    public function addValidators(array $validators){
        foreach ($validators as $key => $value){
            $validatorClass = $this->nameSpaceValidators.ucfirst($key);
            $this->validators[] = new $validatorClass($value);
        }
    }
    
    public function uploadFile($file){
        $validateFile = $this->validateFile($file);
        if($validateFile){
            if(move_uploaded_file($file['tmp_name'], $this->filePath.$this->fileName))
                return true;
            else
                return $this->getMessage(['validator' => 'file', 'message' => 'errorUpload']);
        }else{
            return $validateFile;
        }
    }

    private function validateFile($file){
        if(is_null($this->filePath))
            return $this->getMessage(['validator' => 'file', 'message' => 'requiredFilePath']);
        elseif(is_null($this->fileName))
            return $this->getMessage(['validator' => 'file', 'message' => 'requiredFileName']);

        $fileInfo = new FileInfo($file);
        foreach ($this->validators as $validator){
            $fileValidator = $validator->validate($fileInfo);
        }
        return $fileValidator;
    }
    
    /**
     * Método converter em tamanho de arquivo legível para humanos
     *
     * @param  string $input
     * @return int
     */
    public static function humanReadableToBytes($input)
    {
        $number = (int)$input;
        $units = array(
            'b' => 1,
            'k' => 1024,
            'm' => 1048576,
            'g' => 1073741824
        );
        $unit = strtolower(substr($input, -1));
        if (isset($units[$unit])) {
            $number = $number * $units[$unit];
        }

        return $number;
    }
}