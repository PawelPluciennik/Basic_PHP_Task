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
            'parent_id'
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
}