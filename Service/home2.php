<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
	<style>
		body{
			background-color: grey;
		}
	</style>
</head>
<body>
	
	<div class="container">


		<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand">บริการวิชาการ</a>
				<form class="d-flex">
					<button class="btn btn-lg btn-danger logout" type="submit">Logout</button>
				</form>
			</div>
		</nav>

		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?= $_SESSION['email_service']  ?></h4>
				<h4 class="card-title"><?= $_COOKIE['email']  ?></h4>
				<h4 class="card-title"><?= $_COOKIE['password']  ?></h4>
			</div>
		</div>

		<div class="card-group">
			<div id="card_click1" class="card m-2 p-2 rounded-4">
				<img src="https://images.pexels.com/photos/296302/pexels-photo-296302.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">กิจกรรม1</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			</div>
			<div class="card m-2 p-2 rounded-4">
				<img src="https://images.pexels.com/photos/296302/pexels-photo-296302.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">กิจกรรม1</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			</div>
			<div class="card m-2 p-2 rounded-4">
				<img src="https://images.pexels.com/photos/296302/pexels-photo-296302.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="...">
				<div class="card-body">
					<h5 class="card-title">กิจกรรม1</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			</div>
		</div>




















	</div>




	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

	<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>

	


	<script>
		$(document).ready(function(){
			$(document).on("click", ".logout", function (e) {
				e.preventDefault();

				Swal.fire({
					icon: 'question',
					title: 'Logout',
					text: 'Are you sure you want to log out?',
					showCancelButton: true,
					confirmButtonText: 'Yes',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire({
							icon: 'success',
							title: 'Logged Out',
							text: 'You have been successfully logged out!',
							timer: 2000,
							timerProgressBar: true,
							showConfirmButton: false,
							didClose: () => {
								window.location.href = 'logout.php';
							}
						});
					}
				});
			});


			function updateLastActivity() {
				$.ajax({
					url: 'assets/php/action_index.php',
					method: 'POST',
					data: { update_last_activity: true },
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							//sconsole.log('Last activity updated successfully');
							//console.log('Response message:', response.message);
						} else {
							//console.error('Failed to update last activity');
							//console.error('Response message:', response.message);
						}
					},
					error: function(xhr, status, error) {
						console.error('Error updating last activity:', error);
					}
				});
			}
			updateLastActivity();



		});
	</script> 








</body>
</html>