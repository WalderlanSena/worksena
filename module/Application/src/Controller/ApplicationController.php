<?php

namespace Application\Controller;

use MVS\WorksenaMvc\AbstractActionController;

class ApplicationController extends AbstractActionController
{
    public function index()
    {
        $this->setPageTitle('Bem Vindo(A) !');

        return $this->render('application.index', [
            'version' => 'v2.0.0'
        ]);
    }
}