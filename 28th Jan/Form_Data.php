<?php
session_start();
echo "Session<pre>";
print_r($_SESSION);
echo "</pre>";
function getValue($section,$fieldName,$returnType = '')
{
    return isset($_GET[$section][$fieldName]) ? $_GET[$section][$fieldName] : getSessionValue($section,$fieldName,$returnType);

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

setSessionValue('account');
setSessionValue('address');
setSessionValue('other');
?>