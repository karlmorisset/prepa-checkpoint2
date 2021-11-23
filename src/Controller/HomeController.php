<?php

namespace App\Controller;

use App\Model\CharacterManager;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Home/index.html.twig');
    }
}
