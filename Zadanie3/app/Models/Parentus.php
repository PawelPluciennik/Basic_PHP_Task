<?php

namespace App\Model;

use App\Model;
use App\Str;

class Parentus extends Model
{

    public function crete(string $name, string $surname): int{
        $sqlQuery = 'INSERT INTO parents (`name`, `surname`) 
            VALUES (:name,:surname)'; 
        
        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute(['name' => Str::formatData($_SESSION["name"]), 
                        'surname' => Str::formatData($_SESSION["surname"])]);
        return $this->db->lastInsertedId();
    }

    public function getPrents(): array{
        $sqlQuery = 'SELECT name, surname FROM parents ORDER BY id ASC';
        
        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute([$sqlQuery]);

        $parents = $stmt->fetch();

        return $parents;
    }
}