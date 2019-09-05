<?php 
include 'connect.php';
session_start();
ob_start();

$save=$database->prepare("SELECT * FROM passwords WHERE user=:user ORDER BY id DESC");
$save->execute(array(
	'user'=>$_SESSION['username']
));

?>

<!DOCTYPE html>
<html>	
<head>
	<title>Manage Panel</title>
	<link rel="icon" href="icon.png">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5" align="center">
		<div class="row">
			<div class="col-6 col-centered">
				<table class="table table-striped">
					<tr align="center">
						<th>Passwords</th>
						<th>Name</th>
						<th>Process</th>
					</tr>
					<?php while($show=$save->fetch(PDO::FETCH_ASSOC)) {?>
						<tr align="center">
							<td><?php echo $show['password'] ?></td>
							<td><?php echo $show['name'] ?></td>
							<td><a href="password-edit.php?id=<?php echo $show['id'] ?>" class="btn btn-sm btn-primary">Edit</a><a href="process.php?delete=ok&id=<?php echo $show['id'] ?>&token=<?php echo $_SESSION['token'] ?>" class="btn btn-sm btn-danger ml-2">Delete</a></td>
						</tr>
					<?php } ?>
				</table>
			</div>
			<div class="col-6 col-centered">
				<div align="center">
					<?php if ($_GET['save']=="success") {?>
						<font style="font-size: 24px; color: green;">Saved</font>
					<?php } ?>
					<?php if ($_GET['deleted']=="ok") {?>
						<font style="font-size: 24px; color: green;">Deleted</font>
					<?php } ?>
					<?php if ($_GET['deleted']=="no") {?>
						<font style="font-size: 24px; color: red;">Couldn't Delete</font>
					<?php } ?>
					<?php if ($_GET['edited']=="ok") {?>
						<font style="font-size: 24px; color: green;">Edited</font>
					<?php } ?>
					<?php if ($_GET['edited']=="no") {?>
						<font style="font-size: 24px; color: red;">Couldn't Edit</font>
					<?php } ?>
					<form action="process.php" method="POST">
						<input type="text" name="password" id="password" placeholder="Click Create Button..." class="form-control col-6 mt-3" required="">
						<input type="text" name="name" id="name" class="form-control col-6 mt-3" required="" placeholder="Name..">
						<input type="text" name="token" hidden="" value="<?php echo $_SESSION['token'] ?>">
						<button name="save" class="btn btn-primary mt-3">Save</button>
					</form>
					<button id="create" onclick="create()" class="btn btn-success mt-3">Create</button>
					<script type="text/javascript" src="create.js"></script>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
	</html>