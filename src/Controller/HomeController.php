<?php

namespace App\Controller;

use App\Model\CharacterManager;

class HomeController extends AbstractController
{
    protected CharacterManager $manager;

    public function __construct()
    {
        parent::__construct();

        $this->manager = new CharacterManager();
    }


    public function index()
    {
        $characters = $this->manager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['characters' => $characters]);
    }
}
