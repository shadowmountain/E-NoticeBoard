<?php

include "../config.php";
session_start();
?>


<?php
if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
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

    <title>Search Posts</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_SESSION['username'];?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="../chatbox/index.php">Chatbox</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-md-8">
            <?php
            if(isset($_POST['search'])){
                $input=$_POST['input'];
                $searchquery="SELECT * FROM posts WHERE post_tags LIKE =%$input%";
                $conn=mysqli_query($db,$searchquery);


            while($row = mysqli_fetch_assoc($conn)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];


                ?>
            <h1><?php echo $post_title; ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#"><?php echo $post_author; ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

            <hr>

            <!-- Post Content -->

            <p> <?php echo $post_content; ?> </p>

            <hr>
            <?php
            }}


            ?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="well">
                <h4>Wall Search</h4>
                <form method="post" action="">
                <div class="form-group">
                    <input type="text" class="form-control" name="input">
                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button" name="search">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                </div>
                </form>
                <!-- /.input-group -->
            </div>

        </div>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
