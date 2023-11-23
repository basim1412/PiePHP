<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private  $pdo;

    public  function getDatabase()
    {
        if ($this->pdo === null) {
            $host = 'localhost';
            $dbname = 'cinema';
            $username = 'root';
            $password = '';
            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "y a une erreur de db : " . $e->getMessage();
            }
        }
        return $this->pdo;
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}
