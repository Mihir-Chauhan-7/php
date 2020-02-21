<?php

namespace App\Models;

use PDO;

class Service extends \Core\Model
{
    protected static $table = "service_registrations";
    protected static $primaryKey = "service_id";
    protected static $discardList=["submit","service/register","status"];
    public static function checkAvailablity($date,$timeslot){
        if(sizeof(static::fetchData("date='".$date."' AND time_slot='".$timeslot."'")) >=3 ){
            return true;
        }
        else{
            return false;
        }
    }
    public static function checkNo($vehicle,$licence){
        if(sizeof(static::fetchData("vehicle_no='".$vehicle."' AND licence_no='".$licence."'")) >0 ){
            return true;
        }
        else{
            return false;
        }
    }
}

?>