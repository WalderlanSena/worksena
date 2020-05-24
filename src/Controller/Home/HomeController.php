<?php

namespace App\Controller\Home;

use App\Service\Home\Interfaces\HomeServiceInterface;

class HomeController
{
    private $homeService;

    public function __construct(HomeServiceInterface $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index() 
    {
        $response = $this->homeService->getCurrentVersion();
        echo json_encode($response);
    }
}