<?php

namespace App\Models;

use App\Model;
use App\Str;

class Parentus extends Model
{
    public function create(string $name, string $surname): int{
        return Model::insert(
            'parents', 
            ['name', 'surname'], 
            [Str::formatData($name), Str::formatData($surname)]
        );
    }

    public function getParents(): array{
        // $sqlQuery = 'SELECT id, name, surname FROM parents ORDER BY id ASC';
        
        // $stmt = $this->db->prepare($sqlQuery);

        // $stmt->execute();

        // $parents = $stmt->fetchAll();

        return Model::select(
            ['id', 'name', 'surname'],
            'parents', 
            'id'
        );
    }
}