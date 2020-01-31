<?php

require_once 'C:\xampp\htdocs\Cybercom\php\29th Jan\connect.inc.php';

if(isset($_GET['action']) && isset($_GET['cid'])){

    if(!empty($_GET['action']) && !empty($_GET['cid'])){

        if($_GET['action'] == 'delete'){

            $query = "Delete From Customers Where cid=".$_GET['cid'];
            executeQuery($query);
        }
    }
}

if(isset($_GET['action']) && isset($_GET['cid'])){

    if(!empty($_GET['action']) && !empty($_GET['cid'])){

        if($_GET['action'] == 'update'){

            header("Location:update_form_data.php?id=".$_GET['cid']);
            exit;           
        }
    }
}


$query = "SELECT C.cid,C.fname,C.lname,CA.addressline1,CA.addressline2,COA.value,COB.value
From customers C LEFT JOIN customer_address CA ON C.cid=CA.cid
LEFT JOIN customer_additional_info COA ON C.cid=COA.cid AND COA.field_key='hobbies'
LEFT JOIN customer_additional_info COB ON C.cid=COB.cid AND COB.field_key='businessyears'";

if($customers = mysqli_fetch_all(executeQuery($query))){

    echo "<table border=1><tr><th>Id</th><th>First Name</th><th>Last Name</th>
    <th>Address Line 1</th><th>Address Line 2</th><th>About Self</th><th>Business Years</th>
    <th colspan=2>Actions</th></tr>";
    displayCustomer($customers);
    echo "</table>";
}
else{

    echo "No Records";
}


function displayCustomer($customers)
{
    for($i = 0;$i < sizeof($customers);$i++){
        echo "<tr>";
        foreach($customers[$i] as $value)
            echo "<td>".$value."</td>"; 
            echo "<td><a href='update_form.php?action=update&cid=".$customers[$i][0]."'>Edit</a>
            </td><td><a href='update_form.php?action=delete&cid=".$customers[$i][0]."'>Delete</a>
            </td></tr>";
    }    
}
?>