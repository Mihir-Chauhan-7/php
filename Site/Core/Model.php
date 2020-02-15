<?php

namespace Core;
use App\Config;
use PDO;


abstract class Model{

    protected static $table;
    protected static $primaryKey;
    protected static $keyList;
    protected static $discardList;
    protected static $directory;
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
        
        foreach(static::$discardList as $key){
            unset($data[$key]);
        }

        $keys = array_keys($data);
        $values = array_values($data);
        
        $query = "INSERT INTO $tablename (" . implode(', ', $keys) . ") "
            . "VALUES ('" . implode("', '", $values) . "')";
        return $query;
    }
    public static function prepareUpdateData($data)
    {
        $id=$data['id'];
        $tablename = static::$table;
        $primaryKey = static::$primaryKey;
        
        $i = 0;
        $pre = '';
        $fields = '';

        foreach(static::$discardList as $key){
            unset($data[$key]);
        }

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
        //echo static::prepareData($data);
        $conn->exec(static::prepareData($data));
        return $conn->errorCode() == 00000 ? true : false;
    }
    public static function getKeys(){
        return static::$keyList;
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
        return $conn->errorCode() == 00000 ? true : false;
    }
    public static function deleteData($id)
    {
        $tablename = static::$table;
        $primaryKey = static::$primaryKey;
        $conn = static::getDB();
        $conn->exec("DELETE FROM $tablename WHERE $primaryKey=$id");
        return $conn->errorCode() == 00000 ? true : false;
    }
    public static function getData($id)
    {
        $tablename = static::$table;
        $primaryKey = static::$primaryKey;

        $conn = static::getDB();
        $stmt = $conn->query("SELECT * FROM $tablename WHERE $primaryKey=$id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function fetchData($where)
    {
        $tablename = static::$table;

        $conn = static::getDB();
        $stmt = $conn->query("SELECT * FROM $tablename WHERE $where");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function saveImage($file){
        print_r($file);
        $name = $file['image']['name'];
        $tmpname = $file['image']['tmp_name'];
        $extension = substr($name, strpos($name, '.') + 1);
        
        if (!empty($name) && $extension == 'jpg') {
            if (move_uploaded_file($tmpname, '../Resources/uploads/'.static::$table.'/' . $name)){
                //return "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) 
                //    . "/uploads/" . $name;
                return true;
            }
        }
        return false;
    }
}
?>