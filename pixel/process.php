<?php
//$servername = "localhost";
//$username = "root";
//$password = "root";
//$dbname = "pixel";
//$conn = mysqli_connect($servername, $username, $password, $dbname);

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'pixel') or die(mysqli_error($mysqli));

if (isset($_POST['save'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$brand = $_POST['brand']; //ERROR ISSUE
	$description = $_POST['description'];

	//$_SESSION['message'] = "Successfully submitted your form!";
	//$_SESSION['msg_type'] = "success";

	header("location : dashboard.php");

	$mysqli->query("INSERT INTO data (firstname, lastname, address, email, brand, description) VALUES ('$firstname', '$lastname', '$address', '$email', '$brand', '$description')") or die($mysqli->error);
	}

if (isset($_GET['delete'])){
		$id=$_GET['delete'];
		$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

//		$_SESSION['message'] = "An order has been successfully cancelled!";
//		$_SESSION['msg_type'] = "danger";
//
	}
?>