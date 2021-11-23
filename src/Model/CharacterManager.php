<?php

namespace App\Model;

use DateTime;

class CharacterManager extends AbstractManager
{
    public const TABLE = 'characters';

    /**
     * Insert new item in database
     */
    public function addCharacter(array $character): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (name, img, quote_id, created_at)
        VALUES (:name, :img, :quote_id, :created_at)");

        $statement->bindValue('name', $character['name'], \PDO::PARAM_STR);
        $statement->bindValue('img', $character['img'], \PDO::PARAM_STR);
        $statement->bindValue('quote_id', $character['quote_id'], \PDO::PARAM_INT);
        $date = (new DateTime())->format('Y-m-d H:i:s');

        $statement->bindValue('created_at', $date, \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
