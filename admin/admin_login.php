

<?php include("../config.php");

session_start();

if(isset($_POST['login']))
{
// username and password sent from form

$adminusername=mysqli_real_escape_string($db,$_POST['admin_name']);
$adminpassword=mysqli_real_escape_string($db,$_POST['admin_pass']);



$sql="SELECT admin_id,admin_image FROM adminlogin WHERE admin_name='$adminusername' and admin_pass='$adminpassword'";
$result=mysqli_query($db,$sql);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$active=$row['active'];

$count=mysqli_num_rows($result);


// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{

$_SESSION['admin']=$adminusername;

header("location: index.php");
}
else
{
$error="Your Login Name or Password is invalid";
}
}
?>





<?php
if(isset($_POST['register']))
{
// username and password sent from form
global $db;
$newusername=mysqli_real_escape_string($db,$_POST['newname']);
$newpassword=mysqli_real_escape_string($db,$_POST['newpass']);
$newpassword2=mysqli_real_escape_string($db,$_POST['newpass2']);
$masterkey_int=mysqli_real_escape_string($db,$_POST['masterkey']);
if($newpassword==$newpassword2){
    $sql="SELECT * FROM adminlogin";
    $select_all_login = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($select_all_login)) {
        $masterkey = $row['master_key'];
        if ($masterkey == $masterkey_int) {

            $sql = "INSERT INTO adminlogin(admin_name,admin_pass) VALUES ('$newusername','$newpassword')";
            $result = mysqli_query($db, $sql);

        }
    }
    if($result)
    {

        echo "<script>alert('Registration Successful Now you can Login!');</script>";
    }
    else
    {
        echo "<script>alert('invalid masterkey');</script>";
    }
}else{
    echo "<script>alert('password don not match');</script>";
}
}



// If result matched $myusername and $mypassword, table row must be 1 row

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Account Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>


    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> ADMIN <small> LOGIN/SIGNUP</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-1">
              <h3> LOGIN </h3>
            <form id="login" action="" class="well" method="post">
                  <div class="form-group">
                    <label> Username </label>
                    <input type="text" class="form-control" placeholder="Enter Username" name="admin_name"required/>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="admin_pass" required/>
                  </div>
                  <button type="submit" name="login" class="btn btn-default btn-block">Login</button>
                <a style="margin-top: 20px;" class="pull-right" href="../index.php">Student's Login</a>
              </form>

          </div>

            <div class="col-md-4 col-md-offset-2">
                <h3> REGISTER </h3>
                <form id="login" action="" class="well" method="post">
                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" class="form-control" name="newname" placeholder="Enter Username" required/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="pass1" name="newpass" placeholder="Enter Password" required/>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="pass2" name="newpass2" placeholder="Confirm Password" required/>
                    </div>
                    <div class="form-group">
                        <label>Masterkey</label>
                        <input type="password" class="form-control" name="masterkey" placeholder="Enter Key" required/>
                    </div>
                    <button type="submit" name="register" class="btn btn-default btn-block">Register</button>
                </form>
            </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p> Copyright @2017 </p>
    </footer>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
