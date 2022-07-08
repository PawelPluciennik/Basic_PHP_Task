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
        return Model::select(
            ['id', 'name', 'surname'],
            'parents', 
            '',
            'ORDER BY id'
        );
    }

    public function getParent(int $id): array{
        return Model::select(
            ['id', 'name', 'surname'],
            'parents',
            'WHERE id=' . $id
        );
    }

    public function updateParent(int $id, string $name, string $surname): void {
        Model::update(
            'parents',
            $id,
            'id',
            ['name' => $name, 'surname' => $surname]
        );
    }
}