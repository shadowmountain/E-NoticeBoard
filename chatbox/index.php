<?php include '../config.php'; ?>
<?php
    session_start();
    global $db;
	$query = "SELECT * FROM shouts ORDER BY id DESC";
	$shouts = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title>ChatBOX</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="container">
		<header>
			<h1>ChatBOX</h1>
            <a href="../students/index.php">Back</a>

		</header>
		<div id="chats">
			<ul>
			<?php global $db;
			while($row = mysqli_fetch_assoc($shouts)) : ?>
				<li class="chat">
					<span> <?php echo $row['time'] ?> </span>
					<strong> <?php echo $_SESSION['username'] ?> </strong> : <?php echo $row['message'] ?>
				</li>
			<?php endwhile; ?>
			</ul>
		</div>
		<div id="input">

			<?php if(isset($_GET['error'])) : ?>
				<div class="error"><?php echo $_GET['error']; ?></div>
			<?php endif; ?>
			<form method="post" action="process.php">

				<input type="text" name="message" placeholder="Enter Message">
				<br />
				<input class="chat-btn" type="submit" name="submit" value="Send Text" placeholder="Enter Name">
			</form>
		</div>
	</div>
</body>
</html>