<?php

namespace App\Models;

use PDO;

class Service extends \Core\Model
{
    protected static $table = "service_registrations";
    protected static $primaryKey = "service_id";
    protected static $discardList=["submit","service/register","status"];
    public static function checkAvailablity($date,$timeslot,$id=0){
        if(sizeof(static::fetchData("date='".$date."' AND time_slot='".$timeslot."' AND service_id!='".$id."'")) >=3 ){
            return true;
        }
        else{
            return false;
        }
    }
    public static function checkNo($vehicle,$licence,$id=0){
        if(sizeof(static::fetchData("vehicle_no='".$vehicle."' AND licence_no='".$licence."' AND user_id!='".$id."'")) > 0 ){
            return true;
        }
        else{
            return false;
        }
    }
}

?>