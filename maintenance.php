<?php 
session_unset();
session_destroy();
?>

<?php include 'head.php' ?>
<link rel="stylesheet" href="assets/css/style_admin.css">
</head>
<body class="error-page">
	
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<div class="error-box">
			<h1>500</h1>
			<h3 class="h2 mb-3"><i class="fa fa-warning"></i> Oops! Sorry Page maintenance</h3>
			<p class="h4 font-weight-normal">The page you requested was not found.</p>
			<a href="index" class="btn btn-primary">Back to Home</a>
		</div>
		
	</div>
	<!-- /Main Wrapper -->

	<?php include 'script.php' ?>

</body>
</html>