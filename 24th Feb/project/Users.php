<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php require_once 'userOperations.php';
    isset($_GET['id']) && $_GET['action'] == "update" ? edit($_GET['id']) : "";
    isset($_GET['id']) && $_GET['action'] == "delete" ? delete($_GET['id']) : ""; ?>    
</head>
<body>
    <a class="btn btn-outline-dark" href="addUser.php">Add User</a>
    <table class="table">
        <tr>
            <th>Id</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Password</th>
            <th>Contact</th>
            <th colspan="2">Actions</th>
        </tr>
        <?php foreach(getUserList() as $key => $user) : ?>
        <tr>
            <?php foreach($user as $value) : ?>
            <td><?php print_r($value) ?></td>
            <?php endforeach; ?>
            <td><a href='Users.php?action=update&id=<?php echo $user['user_id'] ?>'>Edit</a></td>
            <td><a href='Users.php?action=delete&id=<?php echo $user['user_id'] ?>'>Delete</a></td>
            
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>