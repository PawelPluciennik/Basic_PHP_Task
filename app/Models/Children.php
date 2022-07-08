<?php

namespace App\Models;

use App\Model;
use App\Str;

class Children extends Model
{
    public function create(array $children, int $parentId): void{
        foreach ($children as $child){               
            Model::insert('children', ['parent_id', 'name'], [$parentId, Str::formatData($child)]);
        }
    }

    public function getChildren(): array{
        $children = Model::select(
            ['parent_id', 'name'],
            'children', 
            '',
            'ORDER BY parent_id'
        );
        $allchildrens = [];
        foreach($children as $child){
            if(empty($allchildrens[$child["parent_id"]] )) {
                $allchildrens[$child["parent_id"]]  = [];
            }
            $allchildrens[$child["parent_id"]][] = $child;
        }
        return $allchildrens;
    }

    public function getChild(int $parent_id): array{
        $children = Model::select(
            ['parent_id', 'name'],
            'children', 
            'WHERE parent_id=' . $parent_id
        );
        return $children;
    }

    public function updateChildren(array $names, int $parent_id): void {
        Model::update(
        'children',
        $parent_id,
        'id && parent_id', //zle podazapytanie, trzeba zmienic na id dziekca = id
        ['name' => $names]
        );
    }
}