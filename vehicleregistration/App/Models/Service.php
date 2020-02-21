<?php

namespace App\Models;

use PDO;

class Service extends \Core\Model
{
    protected static $table = "service_registrations";
    protected static $primaryKey = "service_id";
    protected static $discardList=["submit","service/register"];
    public static function checkAvailablity($date,$timeslot){
        if(sizeof(static::fetchData("date='".$date."' AND time_slot='".$timeslot."'")) >=3 ){
            return true;
        }
        else{
            return false;
        }
    }
}

?>