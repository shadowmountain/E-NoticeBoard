<?php 
session_start();
include '../config.php';
global $db;
if(isset($_POST['submit'])){
	$user = $_SESSION['username'];
	$message = mysqli_real_escape_string($db, $_POST['message']);




if(!isset($message) || $message == ''){
	$error = "Please Enter message";
	header("Location: index.php?error=".urlencode($error));
	exit();
}
else{
	$query = "INSERT INTO shouts (user, message, time)
				VALUES ('$user', '$message', now())";

	if(!mysqli_query($db, $query)){
		die('Error: '.mysqli_error($db));
	}
	else{
		header("Location: index.php");
		exit;
	}
}
}
?>