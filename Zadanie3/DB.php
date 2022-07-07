<?php

namespace App;

use PDO;

/**
 * @mixin PDO
 */

class DB {
    
    public PDO $pdo;
    
    public function __construct(array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOptions
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }

    // private $conn;

    // private $host = 'zadanie.test';
    // private $user = 'root';
    // private $pass = '';
    // private $name = 'family'; //??? na pewno to potrzeba jak juz jest env?

    // private function __construct() {
    //     $this->conn = new PDO("mysql:host=".$_ENV['DB_HOST']."; dbname=".$_ENV['DB_DATABASE'],$_ENV['DB_USER'],$_ENV['DB_PASS']);
    // }

    // public function connect() {
    //     return $this->conn;
    // }

    // public function insertFamily(string $name, string $surname, array $children): void {
    //     $parentId = $this->insertParent($name, $surname);
    //     $this->insertChildren($parentId, $children);
    // }

    // private function insertParent(string $name, string $surname): int{
    //     $sql = "INSERT INTO parents (`name`, `surname`) VALUES ('" . Str::formatData($name) . "', '" . Str::formatData($surname) . "')"; 
    //     $this->conn->exec($sql);
    //     return $this->conn->lastInsertId();
    // }

    // private function insertChildren(int $parentId, array $children): void{
    //     $sql = "INSERT INTO parents (`name`, `surname`) VALUES";
    //     foreach($children as $child){
    //         $sql .= "('" . $parentId . "', '" . Str::formatData($child) . "'),";
    //     }
    //     $sql = substr($sql,0,-1);
    //     $this->conn->exec($sql);
    // }

    // public function getParents(): array {
    //     $query = 'SELECT id, name, surname FROM parents ORDER BY id ASC';
    //     $parents = [];

    //     foreach($this->conn->query($query) as $parent){
    //         $parents[] = $parent;
    //     }
    //     return $parents;
    // }

    // public function getChildren(): array {
    //     $query = 'SELECT parent_id, name FROM children ORDER BY parent_id ASC';
    //     $children = [];

    //     foreach($this->conn->query($query) as $child){
    //         $children[] = $child;
    //     }
    //     $allchildrens = [];
    //     foreach($children as $child){
    //         if(empty($allchildrens[$child["parent_id"]] )) {
    //             $allchildrens[$child["parent_id"]]  = [];
    //         }
    //         $allchildrens[$child["parent_id"]][] = $child;
    //     }
    //     return $allchildrens;
    // }
    

    //wyswietlanie
    // foreach($parents as $parent){
    //     echo "Name: " . $parent["name"] . "<br> Surname: " . $parent["surname"] . "<br><br>";
    //     foreach($allchildrens[$parent['id']] as $name){
    //         if(!empty($name['name'])) echo "Child name: " . $name['name'] . "<br>";
    //     }
    //     echo "<br>";
    // }    
}
