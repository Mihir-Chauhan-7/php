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
}

?>