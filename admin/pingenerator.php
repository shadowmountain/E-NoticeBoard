<?php
include "../config.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:admin_login.php");
}
?>
<?php
$random_pass = "";
$chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
$chararray = str_split($chars);
for($i = 0; $i < 8; $i++){
    $random = array_rand($chararray);
    $random_pass .= "".$chararray[$random];
}
echo $random_pass;
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">


                        <li>
                            <a href="admin_logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php
                $image="SELECT * FROM adminlogin WHERE admin_name='{$_SESSION['admin']}'";
                $imagequery=mysqli_query($db,$image);
                $imageresult=mysqli_fetch_array($imagequery);
                $imagepath=$imageresult['admin_image'];
                ?>
                <ul class="nav navbar-nav side-nav">
                    <li style="border-bottom: 2px solid #34495e">
                        <img id= "profile_img" src="images/<?php echo $imagepath;?>" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; border-radius: 50%  " frameborder="0" width="100%" height="567px"/>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home </a>
                    </li>
                    <li class="active" style="border-bottom: 2px solid #34495e">
                        <a href="pingenerator.php"><i class="fa fa-fw fa-key"></i> Pin Generator </a>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="newpost.php"><i class="fa fa-fw fa-tag"></i> New Post </a>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="studentslist.php"><i class="fa fa-fw fa-table"></i> Student List </a>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="posted_list.php"><i class="fa fa-fw fa-table"></i> Posts List </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Pin Generator
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="index.html"> Home </a>
                            </li>
                            <li class="active">
                                <i class="fa fa-key"></i> Pin Generator
                            </li>
                        </ol>

                    </div>
                </div>
                <!-- /.row -->
                <script>
                    function pingeneration() {
                       var sample =  document.getElementById('gp').value = "<?php echo $random_pass
                       ?>";
                    }
                    function fetchpin() {
                      var sample1 =  document.getElementById('fp').innerHTML =  "";

                    }

                </script>
                <!-- Flot Charts -->
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <h3> NEW ENTRY </h3>
                        <?php

                        if(isset($_POST['generate2'])) {
                            $insertname = $_POST['newname'];
                            $insertspn = $_POST['newrollno'];
                            $enterpasscode = $_POST['newpin'];

                            $query = "INSERT INTO students(roll_no,passcode,student_name) VALUES ('$insertspn','$enterpasscode','$insertname')";
                            $result = mysqli_query($db, $query);
                            if ($result) {
                                echo"<script>alert('Student Added Successfully!');</script>";
                            } else {
                                echo "<script>alert('query failed');</script>";
                            }
                        }


                        ?>

                        <form action="" class="well" method="post">
                            <div class="form-group">

                                <label> Pin <small style="color: #cc0000">*Generate PIN First</small></label>
                                <input id="gp" value="" class="form-control" name="newpin" placeholder="Generated Pin" />



                                <button onclick="return pingeneration()" style="margin-top: 5px;" class="btn btn-default fa fa-key" name="generate">
                                    Generate Pin
                                </button></div>
                            <div class="form-group">
                                <label> Roll No </label>
                                <input type="text" class="form-control" name="newrollno" placeholder="Enter Roll No" required/>
                            </div>
                            <div class="form-group">
                                <label> Student Name </label>
                                <input type="text" class="form-control" name="newname" placeholder="Enter Name" required/>
                            </div>

                                <div class="form-group">
                                    <button type="submit" style="margin-top: 5px;" class="pull-right btn btn-primary fa fa-paper-plane" name="generate2">
                                    Submit
                                    </button>
                                </div>

                        </form>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <?php
                        $passcodefetched="";
                        if(isset($_POST['Fetch'])) {
                            $fetchpin = $_POST['newrollno2'];

                            $fetch_query = "SELECT passcode FROM students WHERE roll_no='$fetchpin'";
                            $fetchresult = mysqli_query($db, $fetch_query);
                            $row=mysqli_fetch_array($fetchresult);
                            $passcodefetched=$row['passcode'];

                        }
                        ?>
                        <script>
                            function fetchpin() {
                        var sample1 =  document.getElementById('fp').innerHTML ="";

                        }</script>

                        <h3> FETCH PIN </h3>
                        <form id="fetchp" action="" class="well" method="post">
                            <div class="form-group">
                                <label> Roll No </label>
                                <input type="text" class="form-control" name="newrollno2" placeholder="Enter Roll No" required/>



                                <button  onclick="fetchpin()" style="margin-top: 5px;" class="btn btn-default fa fa-key" name="Fetch">
                                    Fetch Pin
                                </button>
                                <h3 id="fp" ><?php echo $passcodefetched?></h3>
                            </div>

                        </form>
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
