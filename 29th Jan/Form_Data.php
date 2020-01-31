<?php
require_once 'connect.inc.php';

setSessionValue('account');
setSessionValue('address');
setSessionValue('other');

$data=$_SESSION;
saveData($data);

function getValue($section,$fieldName,$returnType = '')
{
	return isset($_GET[$section][$fieldName]) 
	? $_GET[$section][$fieldName] 
	: getSessionValue($section,$fieldName,$returnType);
}

function saveData($data)
{
	//For Customers Table
	insertData('customers',prepareCustomerData($data['account']));
	$cid=$_SESSION['last_id'];
	//For Address Table
	insertData('customer_address',prepareAddressData($data['address']));
	
	foreach(prepareOtherData($data['other']) as $otherSubData)
		insertData('customer_additional_info',$otherSubData);
	//For Additional Table
		

	load("customers",$cid);//To Display Last Inserted Data
	load("customer_address",$cid);
	//load("customer_additional_info",$_SESSION['last_id']);

}

function getValueFromDB($section,$fieldname)
{
	switch($section)
	{
		case 'account':
			$tablename='customers';break;
		case 'address':
			$tablename='customer_address';break;
		case 'other':
			$tablename='customer_additional_info';break;	
	}
	$resultArray=fetchData($tablename,$_SESSION['last_id']);
	echo $resultArray[0][$fieldname];
}

function prepareCustomerData($accountData)
{
	unset($accountData['confirmpassword']);
	return $accountData;
}

function prepareAddressData($addressData)
{
	$addressData['cid'] = $_SESSION['last_id'];
	return $addressData;	
}

function prepareOtherData($otherData)
{
	
	$otherData['hobbies'] = implode(",",$otherData['hobbies']);
	$otherData['contactType'] = implode(",",$otherData['contactType']);//To Convert SubArray into String 
	$cid=$_SESSION['last_id'];
	foreach($otherData as $key => $value)
	{
		$subArray['cid']=$cid;
		$subArray['field_key']=$key;
		$subArray['value']=$value;
		$newData[]=$subArray;
	}
	return $newData;
}

function setSessionValue($section)
{
	isset($_GET[$section]) ? $_SESSION[$section] = $_GET[$section] : [];
}

function getSessionValue($section,$fieldName,$returnType)
{
    return isset($_SESSION[$section][$fieldName]) ? $_SESSION[$section][$fieldName] : $returnType;
}

function validateField($section,$fieldName,$dataType)
{
	$value=getValue($section,$fieldName);
	switch ($dataType) {
		case 'text':
			return preg_match("/^[A-Za-z]+$/",$value);
			break;
		case 'no':
			return preg_match('/^[6-9][0-9]{9}$/',$value);
			break;
		case 'address':
			return preg_match('/^[A-Za-z0-9]+$/',$value);
			break;
		case 'email':
			return preg_match('/^([A-Za-z0-9\.]+)@([A-Za-z]).([a-z])([.a-z]{1,3})?$/', $value);
			break;
		case 'code':
			return preg_match('/^[0-9]{1,8}$/', $value);
		default:
			break;
	}
}

?>