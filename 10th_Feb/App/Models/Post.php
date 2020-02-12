<?php

namespace App\Models;

use PDO;

class Post extends \Core\Model
{
    public static function getAll(){
    
        $conn = static::getDB();
        $stmt = $conn->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function insert($data){
        unset($data['posts/new']);
        $keys = array_keys($data);
        $values = array_values($data);
        $conn = static::getDB();
        $conn->exec("INSERT INTO users (" . implode(', ', $keys) . ") "
            . "VALUES ('" . implode("', '", $values) . "')");
    }
    public static function delete($id){
        $conn = static::getDB();
        $conn->exec("DELETE FROM users WHERE id=$id");
    }
}

?>