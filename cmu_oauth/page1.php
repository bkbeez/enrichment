<?php 
session_start(); 


// if (!isset($_SESSION['oauth2state'])) {
// 	header("location:index.php"); 
// }


?>



<!doctype html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap demo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/5c29023ff3.js" crossorigin="anonymous"></script>
	</head>
	<body>





		<div class="container">
			<label>SESSION_cmuitaccount : </label><?php echo $_SESSION['cmuitaccount']; ?>

			<br>
			<?php echo $_SESSION['cmuitaccount_name'];?>
			<a href="home.php"><button class="btn btn-dark my-1"><i class="fa fa-home"></i> Home</button></a><br>
			<a href="page1.php"><button class="btn btn-dark my-1"><i class="fa-solid fa-arrow-right"></i> page1</button></a><br>
			<a href="page2.php"><button class="btn btn-dark my-1"><i class="fa-solid fa-arrow-right"></i> page2</button></a><br>
		</div>





		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
	</body>
	</html>