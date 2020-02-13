<?php

namespace Core;
use App\Config;
use PDO;


abstract class Model{

    protected static $table;
    protected static $primaryKey;

    public static function getDB()
    {
        static $db = null;
        if($db === null){
            $dsn = 'mysql:host=' . Config::HOST_NAME . ';dbname=' . Config::DB_NAME 
            . ';charset=utf8';
            $conn= new PDO($dsn,Config::USER_NAME,Config::PASSWORD);
            //$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        return $conn;
    }
    public static function prepareData($data)
    {
        $tablename = static::$table;
        unset($data['posts/new']);
        unset($data['id']);
        $keys = array_keys($data);
        $values = array_values($data);

        $query = "INSERT INTO $tablename (" . implode(', ', $keys) . ") "
            . "VALUES ('" . implode("', '", $values) . "')";
        return $query;
    }
    public static function prepareUpdateData($data)
    {

        $tablename = static::$table;
        $primaryKey = static::$primaryKey;

        $id=$data['id'];
        unset($data['id']);
        unset($data['posts/save']);

        $i = 0;
        $pre = '';
        $fields = '';
        foreach($data as $key => $value){
            $i>0 ? $pre = "," : "";
            $fields .= $pre.$key."='".$value."'";
            $i++;
        }

        $query = "Update $tablename SET $fields Where $primaryKey=$id";
        return $query;
    }
    public static function insertData($data)
    {
        $conn = static::getDB();
        $conn->exec(static::prepareData($data));
        return $conn->errorCode();
    }
    public static function getAll()
    {
        $tablename = static::$table;
        $conn = static::getDB();
        $stmt = $conn->query("SELECT * FROM $tablename");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function updateData($data)
    {
        $conn = static::getDB();
        $conn->exec(static::prepareUpdateData($data));
        return $conn->errorCode();
    }
    public static function deleteData($id)
    {
        $tablename = static::$table;
        $primaryKey = static::$primaryKey;
        $conn = static::getDB();
        $conn->exec("DELETE FROM $tablename WHERE $primaryKey=$id");
        return $conn->errorCode();
    }
    public static function getData($id)
    {
        $tablename = static::$table;
        $primaryKey = static::$primaryKey;

        $conn = static::getDB();
        $stmt = $conn->query("SELECT * FROM $tablename WHERE $primaryKey=$id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>