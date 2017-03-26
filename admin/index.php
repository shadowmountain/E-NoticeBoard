<?php
include "../config.php";
session_start();
if(!isset($_SESSION['admin'])){
    header("Location:admin_login.php");
}
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
                    <?php
                    $image="SELECT * FROM adminlogin WHERE admin_name='{$_SESSION['admin']}'";
                    $imagequery=mysqli_query($db,$image);
                    $imageresult=mysqli_fetch_array($imagequery);
                    $imagepath=$imageresult['admin_image'];
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">


                        <li>
                            <a href="admin_logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav side-nav">
                    <li style="border-bottom: 2px solid #34495e">
                        <img id= "profile_img" src="images/<?php echo $imagepath;?>" style="padding-left: 20px; padding-top: 20px; padding-bottom: 20px; border-radius: 50%  " frameborder="0" width="100%" height="567px"/>
                    </li>
                    <li class="active" style="border-bottom: 2px solid #34495e">
                        <a href="index.php"><i class="fa fa-fw fa-home"></i> Home </a>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
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
                            Home <small> Username </small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               
                <!-- /.row -->

                <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Website Overview</h3>
              </div>
              <div class="panel-body">
                  <?php
                  global $db;
                  $count="SELECT COUNT(*) FROM students";
                  $count_query=mysqli_query($db,$count);
                  $counter=mysqli_fetch_array($count_query);
                  $countall=$counter['COUNT(*)'];
                  ?>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $countall;?></h2>
                    <h4>Students</h4>
                  </div>
                </div>

                <div class="col-md-3">
                    <?php
                    $posts_count="SELECT COUNT(*) FROM posts";
                    $posts_count_query=mysqli_query($db,$posts_count);
                    $posts_counter=mysqli_fetch_array($posts_count_query);
                    $posts_countall=$posts_counter['COUNT(*)'];

                    ?>
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo $posts_countall;?></h2>
                    <h4>Posts</h4>
                  </div>
                </div>

              </div>
              </div>

                <!-- /.row -->

                
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
