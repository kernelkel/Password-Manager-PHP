<?php 
include 'connect.php';
session_start();
ob_start();

$save=$database->prepare("SELECT * FROM passwords WHERE id=:id");
$save->execute(array(
	'id'=>$_GET['id']
));

$show=$save->fetch(PDO::FETCH_ASSOC);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Password Edit</title>
	<meta charset="utf-8">
	<link rel="icon" href="icon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<?php include 'nav.php' ?>
	<div class="container mt-5">
		<div class="row">
			<div class="col-12" align="center">
				<h1 class="display-4">Password Edit</h1>
				<div class="form-group mt-5">
					<form action="process.php?id=<?php echo $show['id'] ?>" method="POST">
						<input type="text" name="password" class="form-control col-3" value="<?php echo $show['password'] ?>">
						<input type="text" name="name" class="form-control col-3 mt-3" value="<?php echo $show['name'] ?>">
						<input type="text" name="token" hidden="" value="<?php echo $_SESSION['token'] ?>">
						<button name="edit" class="btn btn-success mt-3">Edit</button>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</body>
</html>