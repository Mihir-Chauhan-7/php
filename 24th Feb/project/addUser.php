<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <?php require_once 'userOperations.php';
    isset($_POST['add']) ? add($_POST) : "" ?>
</head>
<body>
  <form method="POST" class="form-horizontal">
    <fieldset>
    <!-- Form Name -->
    <legend style="margin-left: 15px;">User Details</legend>
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="fname">First Name</label>  
      <div class="col-md-4">
      <input id="fname" name="fname" type="text" class="form-control input-md">
      </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="lname">Last Name</label>  
      <div class="col-md-4">
      <input id="lname" name="lname" type="text" class="form-control input-md">
      </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email</label>  
      <div class="col-md-4">
      <input id="email" name="email" type="text" class="form-control input-md">
    
      </div>
    </div>
    
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="contact">Contact</label>  
      <div class="col-md-4">
      <input id="contact" name="contact" type="text" class="form-control input-md">
    
      </div>
    </div>
    
    <!-- Password input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Password</label>
      <div class="col-md-4">
        <input id="password" name="password" type="password" class="form-control input-md">
      </div>
    </div>
    
    <!-- Button -->
    <div class="form-group">
      <div class="col-md-4">
        <input name="add" type="submit" class="btn btn-primary" value="Add">
      </div>
    </div>
    
    </fieldset> 
    </form>
</body>
</html>
