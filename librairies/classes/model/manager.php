<?php
namespace Model ;

use PDO;
use PDOException;

class Manager
{
    protected function dbConnect()
    {
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];        
        try {
            $db = new PDO('mysql:host=localhost;dbname=urtube;charset=utf8', 'khalil', 'root',$options);
            return $db;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAll($condition = null, $tableModel=null){
        $db = $this->dbConnect();
        if(is_null($tableModel)){
            $tableModel = $this->table;
        }
        $query = "SELECT * FROM {$tableModel} " . $condition;
        $querySql = $db->prepare($query);
        $querySql->execute();
        return $querySql->fetchAll();
    }

    public function insert($data){
        $db = $this->dbConnect();
        $query = "INSERT INTO {$this->table} (";
        $field = array_keys($data);
        $query .= implode(",",$field) . ") VALUES (";
        $params = array_map(function($field){
            return ":$field";
        },$field);
        $query .= implode(", ", $params) . ")";
        $querySql = $db->prepare($query);
        $querySql->execute($data);
    }

    public function update($data,$idArticle){
        $db = $this->dbConnect();
        $query = "UPDATE {$this->table} SET ";
        $field = array_keys($data);
        $query .= implode(",",$field)." = ?";
        $myArray = array_map(function($value){
            return $value;
        },array_values($data));
        $query .= " WHERE idArticle ={$idArticle}";
        $querySql = $db->prepare($query);
        return $querySql->execute($myArray);
    }
}
