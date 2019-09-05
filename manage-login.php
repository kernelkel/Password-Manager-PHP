<?php 
session_start();
ob_start();
if (isset($_SESSION['username'])) {
	header("Location: manage.php");
	exit;
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" href="icon.png">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body class="container">
	<div class="row" align="center">
		<div class="col-sm-12 col-md-12 col-lg-12 p-5">
			<h1 class="display-4">Login</h1>
			<form action="process.php" method="POST">
				<br>
				<br>
				<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<input type="text" name="username" class="form-control" required="" placeholder="Username...">
					<br>
					<input type="password" name="password" class="form-control" required="" placeholder="Password...">
					<br>
					<button class="btn btn-outline-success" name="login">Login</button>
					<?php 
						if ($_GET["login"]=="error") {?>
							<br>
							<br>
							<font class="lead">Wrong Username Or Password</font>
					<?	} ?>
				</div>
			</form>
		</div>
	</div>
</body>
</html>