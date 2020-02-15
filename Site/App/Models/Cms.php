<?php

namespace App\Models;

use PDO;

class Cms extends \Core\Model
{
    protected static $table = "cms_pages";
    protected static $primaryKey = "cm_id";
    protected static $keyList=['Id','Title','Url','Status','Content','Created At','Updated At'];
    protected static $discardList=['id','Add'];
}

?>