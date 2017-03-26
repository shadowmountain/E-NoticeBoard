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

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

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
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="pingenerator.php"><i class="fa fa-fw fa-key"></i> Pin Generator </a>
                    </li>
                    <li class="active" style="border-bottom: 2px solid #34495e">
                        <a href="newpost.php"><i class="fa fa-fw fa-tag"></i> New Post </a>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="studentslist.php"><i class="fa fa-fw fa-table"></i> Student List </a>
                    </li>
                    <li style="border-bottom: 2px solid #34495e">
                        <a href="posted_list.php"><i class="fa fa-fw fa-table"></i> Posted List </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <?php
                if(isset($_POST['add_post'])){
                    $post_title=$_POST['post_title'];
                    $post_author=$_POST['post_author'];
                    $post_image=$_FILES['post_image']['name'];
                    $post_image_temp=$_FILES['post_image']['tmp_name'];
                    $post_tags=$_POST['post_tags'];
                    $post_content=$_POST['post_content'];
                    $post_date=date('d-m-y');

                    move_uploaded_file($post_image_temp,"images/$post_image");

                    $post_query="INSERT INTO posts(post_title,post_author,post_date,post_image,post_content,post_tags) VALUES ('$post_title','$post_author',now(),'$post_image','$post_content','$post_tags') ";


                    $conn=mysqli_query($db,$post_query);
                    if(!$conn){
                        die("Error".mysqli_error($conn));
                    }else{
                        echo "<script> alert('post added successfully');</script>";
                    }
                }


                ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Write Post
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="index.html"> Home </a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> New Posts
                            </li>
                        </ol>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        NEW POST
                    </div>
                    <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Post Title </label>
                                    <input type="text" name="post_title" class="form-control" placeholder="Page Title">
                                </div>
                            </div>  
                        </div>
                        <div class="row">    
                            <div class="col-md-12">
                                 <div class="form-group">
                                    <label> Post Body </label>
                                    <textarea name="post_content" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>  
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image"> Image </label>
                                    <input id="image" name="post_image" type="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Post Author </label>
                                    <input type="text" name="post_author" class="form-control" placeholder="Page Title">
                                </div>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Meta Tags </label>
                                    <input type="text" name="post_tags"class="form-control" placeholder="Add Some Tags...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button style="margin-top: 10px;" type="submit" name="add_post" class="btn btn-primary fa-newspaper-o"> Publish </button>
                            </div>                          
                        </div>
                    </form>
                </div>
            </div>
                <!-- /.row -->

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

</body>

</html>
