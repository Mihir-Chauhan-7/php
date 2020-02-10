<?php
    require_once 'C:\xampp\htdocs\Cybercom\php\29th Jan\connect.inc.php';

function getValue($section,$fieldname,$id){
    switch($section){
        case 'account':
            return fetchData('customers',$id)[0][$fieldname];
        break;
        case 'address':
            return fetchData('customer_address',$id)[0][$fieldname];
        case 'other':
            return getOther($id)[$fieldname];
                
    }
        
}

function updateData($data){

    $cid = $data['customerId'];
    unset($data['customerId']);
    
    executeQuery(prepareData('customers',$data['account'],$cid));
    executeQuery(prepareData('customer_address',$data['address'],$cid));
    foreach(prepareData('customer_additional_info',$data['other'],$cid) as $query)
        executeQuery($query);
    
    header('Location:update_form.php');
}

function prepareData($tablename,$data,$cid){
    $i = 0;
    $keys = "";
    if($tablename == 'customer_additional_info')
    {
        $data['contactType'] = implode(',',$data['contactType']);
        $data['hobbies'] = implode(',',$data['hobbies']);
        //print_r($data);
        foreach($data as $key => $value){

            $query = "UPDATE $tablename SET value='$value' Where field_key='$key' AND cid=$cid";
            $queries[] = $query;
        }
        return $queries;
    }
    else
    {
        foreach($data as $key => $value){

            $i > 0 ? $str = "," : $str = "";
            $keys .= $str.$key."='".$value."'";
            $i++;
        }
        $query = "UPDATE $tablename SET $keys Where cid=$cid";
        return $query;
    }
}

function getOther($id){

    $new = [];
    $otherInfo = mysqli_fetch_all(executeQuery("Select * From Customer_additional_info where cid=$id"),MYSQLI_ASSOC);
    foreach($otherInfo as $subArray){
        $new[$subArray['field_key']] = $subArray['value'];
    }
    $new['contactType'] = explode(',',$new['contactType']);
    $new['hobbies'] = explode(',',$new['hobbies']);
    return $new;
}
?>

