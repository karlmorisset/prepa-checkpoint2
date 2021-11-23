<?php

namespace App\Controller;

use App\Model\ImageManager;
use App\Model\QuoteManager;
use App\Model\CharacterManager;
use App\Exception\ValidationException;

class CharactersController extends AbstractController
{
    protected CharacterManager $manager;

    public function __construct()
    {
        parent::__construct();

        $this->manager = new CharacterManager();
    }


    public function add()
    {
        $quotes = $this->getQuotes();
        $images = $this->getImages();

        return $this->twig->render('Characters/add.html.twig', [
            'quotes' => $quotes,
            'images' => $images
        ]);
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            try {
                $data = $this->validation();

                $this->manager->addCharacter($data);
                header('Location:/');
            } catch (ValidationException $e) {
                $errors = json_decode($e->getMessage(), true);
                $quotes = $this->getQuotes();
                $images = $this->getImages();

                return $this->twig->render('Characters/add.html.twig', [
                    'quotes' => $quotes,
                    'images' => $images,
                    'errors' => $errors
                ]);
            }
        }
    }


    public function validation(): array
    {
        $errors = [];

        $data = array_map('trim', $_POST);

        if ($data['name'] == "") {
            $errors['name'] = "Vous devez donner un nom à votre personnage";
        }

        if ($data['img'] == "") {
            $errors['img'] = "Vous devez choisir une image pour votre personnage";
        }

        if ($data['quote_id'] == "") {
            $errors['quote_id'] = "Vous devez choisir une citation";
        }

        if (!empty($errors)) {
            throw new ValidationException(json_encode($errors));
        }

        return $data;
    }


    public function getQuotes()
    {
        $quotesManager = new QuoteManager();

        return $quotesManager->selectAll();
    }

    public function getImages()
    {
        $imagesManager = new ImageManager();

        return $imagesManager->selectAll();
    }
}
