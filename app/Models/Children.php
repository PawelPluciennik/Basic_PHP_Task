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
            ['parent_id', 'name', 'id'],
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
            ['parent_id', 'name', 'id'],
            'children', 
            'WHERE parent_id=' . $parent_id
        );
        return $children;
    }

    public function updateChildren(array $children, int $parent_id): void {
        foreach ($children as $id => $child) {
            Model::update(
                'children',
                $parent_id,
                'id = ' . $id . ' AND parent_id',
                ['name' => $child]
            );
        }
    }

    public function deleteChildren(int $parent_id): void {
        Model::delete(
            'children',
            $parent_id,
            'parent_id'
        );
    }

    public function deleteChild(int $id): void {
        Model::delete(
            'children',
            $id,
            'id'
        );
    }
    
}