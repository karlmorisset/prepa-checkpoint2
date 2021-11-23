<?php

namespace App\Model;

class QuoteManager extends AbstractManager
{
    public const TABLE = 'quotes';


    /**
     * Insert new item in database
     */
    public function addQuote(array $quote): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (quote) VALUES (:quote)");

        $statement->bindValue('quote', $quote['quote'], \PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }
}
