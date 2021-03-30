<?php

require_once '_connec.php';

class DataBase
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USER, PASS);
    }

    public function insert (string $title, string $content, string $author): void
    {
        $query = 'INSERT INTO story (title, content, author) VALUES (:title, :content, :author)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':content', $content, PDO::PARAM_STR);
        $statement->bindValue(':author', $author, PDO::PARAM_STR);
        $statement->execute();
    }

    public function selectAll (): array
    {
        $query = 'SELECT * FROM story';
        $statement = $this->pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function selectById (int $id): ?object
    {
        $query = 'SELECT * FROM story WHERE id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_OBJ);
        if ($result === false) {
            return null;
        }
        return $result;
    }

    public function updateById (int $id, string $title, string $content, string $author): void
    {
        $query = 'UPDATE story SET title=:title, content=:content, author=:author WHERE id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', $title, PDO::PARAM_STR);
        $statement->bindValue(':content', $content, PDO::PARAM_STR);
        $statement->bindValue(':author', $author, PDO::PARAM_STR);
        $statement->execute();
    }

}