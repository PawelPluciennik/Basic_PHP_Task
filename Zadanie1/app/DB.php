<?php
include_once 'dd.php';
include_once 'Str.php';

class DB {
    private $conn;

    private $host = 'zadanie.test';
    private $user = 'root';
    private $pass = '';
    private $name = 'family'; //??? na pewno to potrzeba?
   
    private function __construct() {
        $this->conn = new PDO("mysql:host=".$_ENV['DB_HOST']."; dbname=".$_ENV['DB_DATABASE'],$_ENV['DB_USER'],$_ENV['DB_PASS']);
    }

    public function connect() {
        return $this->conn;
    }

    public function insertFamily(string $name, string $surname, array $children): void {
        $parentId = $this->insertParent($name, $surname);
        $this->insertChildren($parentId, $children);
    }

    private function insertParent(string $name, string $surname): int{
        $sql = "INSERT INTO parents (`name`, `surname`) VALUES ('" . Str::formatData($name) . "', '" . Str::formatData($surname) . "')"; 
        $conn->exec($sql);
        return $conn->lastInsertId();
    }

    private function insertChildren(int $parentId, array $children): void{
        $sql = "INSERT INTO parents (`name`, `surname`) VALUES";
        foreach($children as $child){
            $sql .= "('" . $parentId . "', '" . Str::formatData($child) . "'),";
        }
        $sql = substr($sqlQuery,0,-1);
        $conn->exec($sql);
    }

    public function getParents(): array {
        $query = 'SELECT id, name, surname FROM parents ORDER BY id ASC';
        $parents = [];

        foreach($conn->query($query) as $parent){
            $parents[] = $parent;
        }
        return $parents;
    }

    public function getChildren(): array {
        $query = 'SELECT parent_id, name FROM children ORDER BY parent_id ASC';
        $children = [];

        foreach($conn->query($query) as $child){
            $children[] = $child;
        }
        $allchildrens = [];
        foreach($children as $child){
            if(empty($allchildrens[$child["parent_id"]] )) {
                $allchildrens[$child["parent_id"]]  = [];
            }
            $allchildrens[$child["parent_id"]][] = $child;
        }
        return $allchildrens;
    }
    
    // foreach($parents as $parent){
    //     echo "Name: " . $parent["name"] . "<br> Surname: " . $parent["surname"] . "<br><br>";
    //     foreach($allchildrens[$parent['id']] as $name){
    //         if(!empty($name['name'])) echo "Child name: " . $name['name'] . "<br>";
    //     }
    //     echo "<br>";
    // }    
}
