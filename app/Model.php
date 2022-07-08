<?php

namespace App;

abstract class Model{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }
    
    public function insert(string $tableName, array $order ,array $values): int {
        $sqlQuery = 'INSERT INTO ' . $tableName . ' (' . implode(',',$order) . ") 
                     VALUES ('" . implode("','", $values) . "')"; 
        
        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();
    
        return $this->db->lastInsertId();
    }

    public function select(array $columns, string $from, $orderBy): array {
        $sqlQuery = 'SELECT ' . implode(',',$columns) . ' FROM ' . $from .' ORDER BY ' . $orderBy . ' ASC';

        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}