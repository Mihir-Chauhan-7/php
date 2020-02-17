<?php

namespace App\Models;

use PDO;

class Category extends \Core\Model
{
    protected static $table = "categories";
    protected static $primaryKey = "cid";
    protected static $keyList=['Id','Parent','Name','Url','Image','Status','Description'
        ,'Created At'];
    protected static $discardList = ['id','submit'];
}

?>