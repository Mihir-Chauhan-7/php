<?php

namespace Core;
use App\Config;
use PDO;


abstract class Model{

    protected static $table;
    protected static $primaryKey;
    protected static $urlField;
    protected static $lastId;
    protected static $keyList;
    protected static $discardList;
    protected static $directory;
    protected static $mainUrl;
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
    public static function executeSQL($query){
        $conn = static::getDB();
        $stmt = $conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $data['url'] = static::generateUrl($data[static::$urlField]);
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
        static::$lastId=$conn->lastInsertId();
        return $conn->errorCode() == 00000 ? true : false;
    }
    public static function getLastId(){
        return static::$lastId;
    }
    public static function getKeys(){
        return static::$keyList;
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
    public static function getAll()
    {
        $tablename = static::$table;
        $conn = static::getDB();
        $stmt = $conn->query("SELECT * FROM $tablename");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public static function join($join='LEFT',$fields1=[],$fields2=[],$secondTable,$onField1,$onField2,$where=1){
        $conn = static::getDB();
        $firstTable = static::$table;

        $fieldNames1 = "A.".implode(", A.", $fields1);
        $fieldNames2 = "B.".implode(", B.", $fields2);
        //echo "SELECT $fieldNames1,$fieldNames2 FROM $firstTable AS A $join JOIN $secondTable AS B ON A.$onField1=B.$onField2 WHERE $where";
        $stmt = $conn->query("SELECT $fieldNames1,$fieldNames2 FROM $firstTable AS A $join JOIN $secondTable AS B ON A.$onField1=B.$onField2 WHERE $where");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function joinThree($join='LEFT',$fields1=[],$fields2=[],$fields3=[],$secondTable,$thirdTable,$onFields1=[],$onFields2=[],$where=1){
        $conn = static::getDB();
        $firstTable = static::$table;

        $fieldNames1 = sizeof($fields1)>0 ? "A.".implode(", A.", $fields1)."," : "";
        $fieldNames2 = sizeof($fields2)>0 ? "B.".implode(", B.", $fields2)."," : "";
        $fieldNames3 = sizeof($fields3)>0 ?"C.".implode(", C.", $fields3) : "";
        $query = "SELECT $fieldNames1 $fieldNames2 $fieldNames3 FROM $firstTable AS A $join JOIN $secondTable AS B ON A.$onFields1[0]=B.$onFields1[1] $join JOIN $thirdTable AS C ON B.$onFields2[0]=C.$onFields2[1] WHERE $where";
        $stmt = $conn->query($query);
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
    public static function generateUrl($name){
        return strtolower(preg_replace(['/\s+/','/\W/'],'_',$name));

    }
    public static function redirect($url){
        echo "Location: " . Config::HOME . static::$mainUrl . $url;
        header("Location: " . Config::HOME . static::$mainUrl . $url);   
    }
}
?>