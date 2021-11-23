<?php

namespace App\Controller;

use App\Model\QuoteManager;
use App\Exception\ValidationException;

class QuotesController extends AbstractController
{
    protected QuoteManager $manager;

    public function __construct()
    {
        parent::__construct();

        $this->manager = new QuoteManager();
    }


    public function add()
    {
        return $this->twig->render('Quotes/add.html.twig');
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            try {
                $data = $this->validation();

                $this->manager->addQuote($data);
                header('Location:/');
            } catch (ValidationException $e) {
                $errors = json_decode($e->getMessage(), true);

                return $this->twig->render('Quotes/add.html.twig', [
                    'errors' => $errors
                ]);
            }
        }
    }


    public function validation(): array
    {
        $errors = [];

        $data = array_map('trim', $_POST);

        if ($data['quote'] == "") {
            $errors['quote'] = "La citation ne peut pas être vide";
        }

        if (!empty($errors)) {
            throw new ValidationException(json_encode($errors));
        }

        return $data;
    }
}
