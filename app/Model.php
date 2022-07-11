<?php

namespace App;

abstract class Model{
    protected DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }
    
    public function insert(string $tableName, array $order, array $values): int {
        $sqlQuery = 'INSERT INTO ' . $tableName . ' (' . implode(',',$order) . ") 
                     VALUES ('" . implode("','", $values) . "')"; 
        
        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();
    
        return $this->db->lastInsertId();
    }

    public function select(array $columns, string $from, string $where = '', string $orderBy = ''): array {
        $sqlQuery = 'SELECT ' . implode(',',$columns) . 
                    ' FROM ' . $from .
                    ' ' . $where . 
                    ' ' . $orderBy;

        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function update(string $tableName, int $id, string $idType, array $values): void {
        $sqlQuery = 'UPDATE ' . $tableName . ' 
                    SET '; 
        $parsedValues = [];
        foreach($values as $key => $value)
        {
            $parsedValues[]=$key.'='."'$value'";
        }
        $sqlQuery.=implode(',',$parsedValues);
        $sqlQuery.=' WHERE '.$idType.' = '.$id;

        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();
    }

    public function delete(string $tableName, int $id, string $idType): void {
        $sqlQuery = 'DELETE FROM ' . $tableName . ' '; 
        $sqlQuery.= 'WHERE ' . $id . ' = ' . $idType;
        
        $stmt = $this->db->prepare($sqlQuery);

        $stmt->execute();
    }
}