<?php 

include 'connect.php';
session_start();
ob_start();

function login_control(){
	if (!isset($_SESSION['username'])) {
		header("Location: index.php");
		exit;
	}
}

function token_control(){
	if (!isset($_POST['token']) OR $_SESSION['token']!=$_POST['token']) {
		header("Location: manage.php");
		exit;
	}
}

function token_get_control(){
	if (!isset($_GET['token']) OR $_SESSION['token']!=$_GET['token']) {
		header("Location: manage.php");
		exit;
	}
}

#Login to Manage Panel
if (isset($_POST['login'])) {

	$token=md5(uniqid());

	$save=$database->prepare("SELECT username,password FROM users WHERE username=:username AND password=:password");
	$save->execute(array(
		'username'=>$_POST['username'],
		'password'=>$_POST['password']
	));

	$result=$save->rowCount();
	if ($result) {
		$_SESSION['token']=$token;
		$_SESSION['username']=$_POST['username'];
		header("Location: manage.php");
		exit;
	}
	else {
		header("Location: manage-login.php?login=error");
		exit;
	}
}

#Save Passwords that created
if (isset($_POST['save'])) {

	token_control();
	login_control();

	echo $_POST['password'];
	echo $_POST['name'];
	$save=$database->prepare("INSERT INTO passwords SET password=:password,name=:name,user=:user");
	$result=$save->execute(array(
		'password'=>htmlentities($_POST['password']),
		'name'=>htmlentities($_POST['name']),
		'user'=>htmlentities($_SESSION['username'])
	));

	if ($result) {
		header("Location: manage.php?save=success");
		exit;
	}
	else {
		header("Location: manage.php?save=error");
		exit;
	}
}


#Delete Password
if ($_GET['delete']) {

	login_control();
	token_get_control();

	
	$save=$database->prepare("DELETE FROM passwords where id=:id");
	$result=$save->execute(array(
		'id'=>$_GET['id']
	));

	if ($result) {
		header("Location: manage.php?deleted=ok");
		exit;
	}
	else{
		header("Location: manage.php?deleted=no");
		exit;
	}
}


#Edit Password
if (isset($_POST['edit'])) {

	token_control();
	login_control();

	$save=$database->prepare('UPDATE passwords SET password=:password,name=:name WHERE id=:id');
	$result=$save->execute(array(
		'password'=>htmlentities($_POST['password']),
		'name'=>htmlentities($_POST['name']),
		'id'=>$_GET['id']
	));

	if ($result) {
		header("Location: manage.php?edited=ok");
		exit;
	}
	else{
		header("Location: manage.php?edited=no");
		exit;
	}

}
?>