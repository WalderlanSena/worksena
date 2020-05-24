<?php

namespace App\Service\Home;

use App\Service\Home\Interfaces\HomeServiceInterface;

class HomeService implements HomeServiceInterface
{
    public function getCurrentVersion()
    {
        return [
            'version' => '2.0.0'
        ];
    }
}