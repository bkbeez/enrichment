<?php 
session_start();

?>

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

	<?php 
	$get_login = $_GET['login'];

	?>
	<input type="text" id="login" value="<?= $get_login ?>" readonly hidden>
	
	<div class="container">


		<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand">บริการวิชาการ</a>
				<form class="d-flex">
					<?php if (!empty($_SESSION['email_service'])){ ?>
						<button class="btn btn-lg btn-danger logout" type="submit">Logout</button>
					<?php }else{ ?>
						<button class="btn btn-lg btn-success card_click1" type="submit">Login</button>
					<?php } ?>
				</form>
			</div>
		</nav>



		<div class="card-group">
			<div id="" class="card_click1 card m-2 p-2 rounded-4">
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

		<div class="card-group">
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

	<div id="card_choose_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content"></div>
		</div>
	</div>


	<div id="card_click1_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content"></div>
		</div>
	</div>

	<div id="card_click_forget_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content"></div>
		</div>
	</div>



	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

	<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>




	<script>

		$(document).ready(function(){

			var login = $("#login").val();
			if (login == 1) {
				setTimeout(function() {
					$('.card_click1').trigger('click');
				}, 500);
				setTimeout(function() {
					$('#have_user').trigger('click');
				}, 1500);
			}

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

			$(document).on("click", ".card_click1", function (e) {
				e.preventDefault();

				$.ajax({
					url: 'assets/php/action_index.php',
					type: 'POST',
					data: { 
						'card_choose_modal' : true,
					},
					success: function (data) {
						$("#card_choose_modal .modal-content").html(data);
						$('#card_choose_modal').modal('show');
					}
				});
			});


			$(document).on("click", "#have_user", function (e) {
				e.preventDefault();
				$("#main_page").hide();	

				$.ajax({
					url: 'assets/php/action_index.php',
					type: 'POST',
					data: { 
						'card_click2' : true,
					},
					success: function (data) {
						$("#card_choose_modal .modal-content").html(data);
						$("#card_click2").show();
					}
				});
			});


			$(document).on("click", "#no_user", function (e) {
				e.preventDefault();
				$("#main_page").hide();	

				$.ajax({
					url: 'assets/php/action_index.php',
					type: 'POST',
					data: { 
						'card_click1' : true,
					},
					success: function (data) {
						$("#card_choose_modal .modal-content").html(data);
						$(".card_click1").show();
					}
				});
			});

			$(document).on("click", ".back_main", function (e) {
				e.preventDefault();

				$.ajax({
					url: 'assets/php/action_index.php',
					type: 'POST',
					data: { 
						'card_choose_modal' : true,
					},
					success: function (data) {
						$("#card_choose_modal .modal-content").html(data);
						$('#card_choose_modal').modal('show');
					}
				});
			});


			$(document).on("click", ".back_login", function (e) {
				e.preventDefault();

				$.ajax({
					url: 'assets/php/action_index.php',
					type: 'POST',
					data: { 
						'card_click2' : true,
					},
					success: function (data) {
						$('#card_click_forget_modal').modal('hide');
						$("#card_choose_modal .modal-content").html(data);
						$('#card_choose_modal').modal('show');
						$("#card_click2").show();
					}
				});
			});


			$(document).on("click", "#check_user_register", function (e) {
				e.preventDefault();
				console.log('register');

				var email = $("#create_email").val();
				var password = $("#create_password").val();
				var confirmPassword = $("#confirm_password").val();

				if (!email || !password || !confirmPassword) {
					$("#passError").text('*กรุณากรอกข้อมูลให้ครบ!');
					console.log('Please fill out all fields');
				} else if ($("#Register_Form")[0].checkValidity()) {
					e.preventDefault();
					$("#check_user_register").val('Please Wait...');

					if (!isValidEmail(email)) {
						$("#passError").text('*รูปแบบ Email ไม่ถูกต้อง');
						console.log('Invalid email format');
					} else if (password.length < 4) {
						$("#passError").text('*Password อย่างน้อย 4 ตัว');
						console.log('Password อย่างน้อย 4 ตัว');
					} else if (password != confirmPassword) {
						$("#passError").text('*Password ไม่ตรงกัน!');
						console.log('Password ไม่ตรงกัน!');
					} else {
						console.log('Password ตรงกัน ลงทะเบียน!');
						$("#passError").text('');
						$('#check_user_register').prop('disabled', true);
						$.ajax({
							type: 'POST',
							url: 'assets/php/action_index.php',
							data: $('#Register_Form').serialize() + '&action_Register=true',
							dataType: 'json',
							success: function(response) {

								if (response.status === 'error') {
									Swal.fire({
										icon: 'error',
										title: 'Oops...',
										text: response.message
									});
								} else if (response.status === 'success') {
									Swal.fire({
										icon: 'success',
										title: 'Success',
										text: response.message
									});

									$.ajax({
										url: 'assets/php/action_index.php',
										type: 'POST',
										data: { 
											'card_click2' : true,
										},
										success: function (data) {
											$("#card_choose_modal .modal-content").html(data);
											$("#card_click2").show();
										}
									});
								}
								$("#create_email").val('');
								$("#create_password").val('');
								$("#confirm_password").val('');
								$("#check_user_register").val('ลงทะเบียนสมาชิกใหม่');

							},
							error: function(xhr, status, error) {
								console.error(xhr.responseText);
							},
							complete: function() {
								$('#check_user_register').prop('disabled', false);
							}
						});
					}
				}
			});

			function isValidEmail(email) {
				var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				return emailRegex.test(email);
			}





			$(document).on("click", "#check_user_login", function (e) {
				e.preventDefault();
				console.log('login');

				var formData = $("#Login_Form").serialize()+ '&action_login=true';
				var email = $("#email").val();
				var password = $("#password").val();
				var remember_me = $("#remember_me").prop("checked");
				console.log(remember_me);

				$.ajax({
					type: 'POST',
					url: 'assets/php/action_index.php',
					data: formData,
					dataType: 'json',
					success: function(response) {
						if (response.status === 'error') {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: response.message
							});
						} else if (response.status === 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: response.message,
								timer: 2000,
								timerProgressBar: true,
								showConfirmButton: false
							}).then((result) => {
								
								window.location.href = 'home.php';
								
							});
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});
			});



			$(document).on("click", "#check_forget_password", function (e) {
				e.preventDefault();
				$('#card_choose_modal').modal('hide');

				$.ajax({
					url: 'assets/php/action_index.php',
					type: 'POST',
					data: { 
						'card_click3' : true,
					},
					success: function (data) {
						$("#card_click_forget_modal .modal-content").html(data);
						$('#card_click_forget_modal').modal('show');
						$(".card_click3").show();
					}
				});
			});



			$(document).on("click", "#sent_otp_new_password", function (e) {
				e.preventDefault();
				console.log('sent_otp');

				$("#sent_otp_new_password").val('Please Wait...');
				$('#sent_otp_new_password').prop('disabled', true);

				var formData = $("#Forget_otp_Form").serialize() + '&action_sent_otp_new_password=true';

				$.ajax({
					type: 'POST',
					url: 'assets/php/action_index.php',
					data: formData,
					dataType: 'json',
					success: function(response) {
						if (response.status === 'error') {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: response.message
							});
						} else if (response.status === 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: response.message
							});

							$.ajax({
								url: 'assets/php/action_index.php',
								type: 'POST',
								data: {
									'card_click4' : true,
									email : response.email
								},
								success: function (data) {
									$("#card_click_forget_modal .modal-content").html(data);
									$('#card_click_forget_modal').modal('show');
									$(".card_click4").show();
								}
							});

						}
						$("#sent_otp_new_password").val('ส่ง OTP');
						$('#sent_otp_new_password').prop('disabled', false);
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});

			});




			$(document).on("click", "#check_new_password", function(e) {
				e.preventDefault();
				console.log('Create new password');

				var formData = $("#Forget_Form").serialize() + '&action_create_new_password=true';

				$.ajax({
					type: 'POST',
					url: 'assets/php/action_index.php',
					data: formData,
					dataType: 'json',
					success: function(response) {
						if (response.status === 'error') {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: response.message
							});
						} else if (response.status === 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: response.message
							});
							$('#card_click_forget_modal').modal('hide');

							$.ajax({
								url: 'assets/php/action_index.php',
								type: 'POST',
								data: { 
									'card_click2' : true,
								},
								success: function (data) {
									$("#card_choose_modal .modal-content").html(data);
									$('#card_choose_modal').modal('show');
									$("#card_click2").show();
								}
							});
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
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