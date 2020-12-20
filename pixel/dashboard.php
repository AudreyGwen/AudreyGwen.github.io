<!DOCTYPE html>
<html>

<header>
	<title>Pixel net</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	  <link href="external/index.css" type="text/css" rel="stylesheet" />

	  <style type="text/css">
td, th { 
  padding: 6px; 
  border: 1px solid #ccc; 
  text-align: center; 
}

th{
	background-color: #ccc;
}

@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		font-weight: bold;
	}
	
	/*
	Label the data
	*/
	td:nth-of-type(1):before { content: "Full Name"; }
	td:nth-of-type(2):before { content: "Brand"; }
	td:nth-of-type(3):before { content: "Problem"; }
	td:nth-of-type(4):before { content: "Status"; }
	td:nth-of-type(5):before { content: "Date Issue"; }
}
	  </style>
</header>

<body>
<head>
<nav class="main-nav">
	<img src="images/logo.png">
</nav>
</head>

<a href="index.php"><img src="images/return2.png" style="width:200px; height:24px; margin-left: 22px;"><br><br></a>

<?php require_once 'process.php'; ?>


<?php 
	$mysqli = new mysqli('localhost', 'root', 'root', 'pixel') or die(mysqli_error($mysqli));
	$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
	//pre_r($result);
	//pre_r($result->fetch_assoc());


?>

	<div class="row justify-content-center">
		<h4>ORDER STATUS</h4>
	<table class="table">
			<thead>
				<tr>
					<th>Full Name</th>
					<th>Brand</th>
					<th>Problem</th>
					<th>Status</th>
					<th>Date Issue</th>
					<th></th>
				</tr>
			</thead>

	<?php
		while($row = $result->fetch_assoc()): 

			if (strtotime(date('Y/m/d') < '2020/12/05')) {
					$row['status'] = 'Pending';
				} else {
					$row['status'] = 'Solved';
				}//
	?>
			<tr>
				<td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
				<td><?php echo $row['brand']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td><?php echo $row['status']; ?></td>
				<td><?php echo date("Y/m/d"); ?></td>
				<td><a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Cancel Order</a></td>
			</tr>
		<?php endwhile; ?>
	
	</table>
	</div>

<?php

	function pre_r($array) {
		echo '<pre>';
		print_r($array);
		echo'</pre>';
		}

?>

<div class="row justify-content-center" style="margin: 0 auto; background-color: #2e6ce8;">
<form action="process.php" method="POST" style="margin: 28px auto; color: white;">
	<h2>REGISTER</h2>
	<div class="form-group">
	<label>First Name</label>
	<input type="text" name="firstname" class="form-control" placeholder="Enter your first name">
	</div>
	<div class="form-group">
	<label>Last Name</label>
	<input type="text" name="lastname" class="form-control" placeholder="Enter your last name">
	</div>
	<div class="form-group">
	<label>Address</label>
	<input type="text" name="address" class="form-control" placeholder="Enter your location address with city">
	</div>
	<div class="form-group">
	<label>Email</label>
	<input type="email" name="email" class="form-control" placeholder="Enter your email address for contact">
	</div>
	<div class="form-group">
	<label>Tech Brand</label>
	<input type="text" name="brand" class="form-control" placeholder="Enter your tech brand name">
	</div>
	<div class="form-group">
	<label>What's your tech problem?</label>
	<textarea type="text" name="description" class="form-control" rows="8"></textarea>
	</div>
	<div class="form-group">
	<a href="dashboard.php"><button type="submit" name="save" class="btn btn-md" style="background-color: white; color: #2e6ce8; font-weight: bold; width: 270px;">SUBMIT</button></a>
	</div>
</form>
</div>




<footer>
<p>© 2020 pixel.net. All Rights Reserved.</p>
</footer>




</body>
</html>