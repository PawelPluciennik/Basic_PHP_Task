<?php

namespace App\Models;

use App\Model;
use App\Str;

class Children extends Model
{
    public function create(array $children, int $parentId): void{
        foreach ($children as $child){
            $sqlQuery = 'INSERT INTO children (`parent_id`, `name`) 
            VALUES (:parent_id,:name)'; 
        
            $stmt = $this->db->prepare($sqlQuery);

            $stmt->execute(['parent_id' => $parentId, 
                            'name' => Str::formatData($child)]);
        }
    }
    public function getChildren(): array{
        $sqlQuery = 'SELECT parent_id, name FROM children ORDER BY parent_id ASC';
        
        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();

        $children = $stmt->fetchAll();
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