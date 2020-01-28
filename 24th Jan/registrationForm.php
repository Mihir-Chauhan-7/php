<?php
session_start();
$isAllSet=isset($_GET['prefix']) && isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['dob']) && isset($_GET['mobileno']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['confirmpassword']) && isset($_GET['addressline1']) && isset($_GET['addressline2']) && isset($_GET['companyname']) && isset($_GET['city']) && isset($_GET['country']) && isset($_GET['postalcode']);

$isAllNotEmpty=!empty($_GET['prefix']) && !empty($_GET['firstname']) && !empty($_GET['lastname']) && !empty($_GET['dob']) && !empty($_GET['mobileno']) && !empty($_GET['email']) && !empty($_GET['password']) && !empty($_GET['confirmpassword']) && !empty($_GET['addressline1']) && !empty($_GET['addressline2']) && !empty($_GET['companyname']) && !empty($_GET['city']) && !empty($_GET['country']) && !empty($_GET['postalcode']);

$isOtherSet=isset($_GET['aboutself']) && isset($_GET['image']) && isset($_GET['certificate']) && isset($_GET['businessyears']);
$isOtherNotEmpty=!empty($_GET['aboutself']) && !empty($_GET['image']) && !empty($_GET['certificate']) && !empty($_GET['businessyears']);

if($isAllSet)
{
    if($isAllNotEmpty)
    {
        if($_GET['password']==$_GET['confirmpassword'])
	    {
		    if($isOtherSet && $isOtherNotEmpty)
		    {
			    saveInformation();//echo "True";
		    }
		    else
		    {
			    echo "Only Personal And Address Information";
			    saveInformation();
		    }
	    }
	    else
	    {
		    echo "Password Not Match";
	    }
    }
    else
    {
        echo "Please Fill All Fields";
    }
}

function saveInformation()
{
	echo "<table>";
	$_SESSION['formData']=$_GET;
	 foreach ($_SESSION['formData'] as $key => $value) {
	 	echo "<tr><td>".$key."</td><td> : </td> <td>".$value."</td></tr>";
	 }
	 echo "</table>";
}
print_r($_SESSION);
?>
<script> 
function showOther(checkbox)
{
    var div=document.getElementById('otherInfo');
    var status=checkbox.checked ? div.setAttribute('style','display : block') : div.setAttribute('style','display : none') ;
}
</script>
<fieldset>
		<legend>Personal Information</legend>
		<form>
		<select name='prefix'>
			<option>Mr</option>
			<option>Miss</option>
			<option>Ms</option>
			<option>Mrs</option>
			<option>Dr</option>
		</select>
	<input type='text' name='firstname' placeholder='First Name' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['firstname'];} ?>"><br><br>
	<input type='text' name='lastname' placeholder='Last Name' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['lastname'];} ?>"><br><br>
	<input type='date' name='dob' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['dob'];} ?>"><br><br>
	<input type='text' name='mobileno' placeholder='Phone No' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['mobileno'];} ?>"><br><br>
	<input type='email' name='email' placeholder='Email' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['email'];} ?>"><br><br>
	<input type='password' name='password' placeholder='Password' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['password'];} ?>"><br><br>
	<input type='password' name='confirmpassword' placeholder='Confirm Password' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['confirmpassword'];} ?>"><br><br>
	</fieldset>
	<fieldset>
	<legend>Address Information</legend><br>
	
	<input type='text' name='addressline1' placeholder='Address Line 1' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['addressline1'];} ?>"><br><br>
	<input type='text' name='addressline2' placeholder='Address Line 2' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['addressline2'];} ?>"><br><br>
	<input type='text' name='companyname' placeholder='Company Name' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['companyname'];} ?>"><br><br>
	<input type='text' name='city' placeholder='City' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['city'];} ?>"><br><br>
	<select name='country' placeholder='Country'>
		<option value='India'>India</option>
		<option value='Sri-Lanka'>Sri-Lanka</option>
		<option value='China'>China</option>
	</select><br><br>
	<input type='text' name='postalcode' placeholder='Postal Code' value="<?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['postalcode'];} ?>"><br><br>
    <input type='checkbox' onclick='showOther(this)'>Other Information    
</fieldset>
    <div id="otherInfo" style="display: none">
    <fieldset >
	<legend>Other Information</legend>
	<textarea placeholder='Describe Yourself' name='aboutself' ><?php if(isset($_SESSION['formData'])) { echo $_SESSION['formData']['aboutself'];} ?></textarea><br><br>
	<input type='file' name='image'><br><br>
	<input type='file' name='certificate'><br><br>
	<input type='radio' id='underOne' name='businessyears' value='under 1'>Under 1<br><br> 
	<input type='radio' id='oneToTwo' name='businessyears' value='1 to 2'>1 To 2<br><br>
	<input type='radio' id='twoToFive' name='businessyears' value='2 to 5'>2 To 5<br><br>
	<input type='radio' id='fiveToTen' name='businessyears' value='5 to 10'>5 To 10<br><br>
	<input type='radio' id='overTen' name='businessyears' value='over 10'>Over 10<br><br>
    How Do You Like Us To Get in Touch with You ? 
    <input type="checkbox" name="post">Post 
    <input type="checkbox" name="email">Email
    <input type="checkbox" name="sms">SMS
    <input type="checkbox" name="phone">Phone<br><br>
    Hobbies    
</fieldset>
    </div>  
    <input type='submit' value='Submit'>
    <input type='reset' value='Clear'>
    </form>
