
<?php

include("config.php");
session_start();



if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from form

    $myusername=mysqli_real_escape_string($db,$_POST['Roll_No']);
    $mypassword=mysqli_real_escape_string($db,$_POST['PIN']);


    $sql="SELECT id FROM students WHERE roll_no='$myusername' and passcode='$mypassword'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active=$row['active'];

    $count=mysqli_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)
    {

        $_SESSION['username']=$myusername;

        header("location: students/index.php");
    }
    else
    {
        $error="Your Login Name or Password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="admin/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="admin/js/bootstrap.min.js"></script>
</head>
<body>
<header style="margin: auto; background-color: #2c3e50; width: 100%; height: 75px;" id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 style="color: white;" class="text-center"> Student <small> LOGIN </small></h1>

          </div>
        </div>
      </div>
    </header>
<div style="margin-top: 50px;" class="container">
  
  <form method="post" action="" class="col-sm-offset-4">
  <div class="row">
    <div class="form-group col-sm-6">
      <label for="text">Roll No:</label>
      <input type="text" class="form-control" name="Roll_No" placeholder="Enter Roll_No">
    </div>
    </div>
    <div class="row">
    <div class="form-group col-sm-6">
      <label for="pwd">Pin:</label>
      <input type="password" class="form-control" name="PIN" placeholder="Enter Pin">
    </div>
    </div>
    <div class="row">
    <div class="col-xs-6">
    <button type="submit" class="btn btn-block fa fa-paper-plane">Submit</button>
    </div>
    </div>
      <a href="admin/admin_login.php">Administrator's Login</a>
  </form>  
</div>


</body>
</html>