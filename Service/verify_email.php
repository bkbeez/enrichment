
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
	
	<?php 
	$get_email = $_GET['email'];
	$get_otp = $_GET['otp'];
	?>

	<div class="container">
		<div class="form-group">
			<input type="text" id="email" class="form-control form-control-sm" value="<?= $get_email ?>" readonly hidden>
			<input type="text" id="otp" class="form-control form-control-sm" value="<?= $get_otp ?>" readonly hidden>
			<input type="button" id="confirm_email" class="" value="ยืนยัน Email" hidden>
		</div>
	</div>




	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

	<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>



	<script>
		$(document).ready(function() {

			setTimeout(function() {
				$('#confirm_email').trigger('click');
			}, 500);

			$('#confirm_email').click(function() {
				var email = $('#email').val();
				var otp = $('#otp').val();
				// console.log(email);
				// console.log(otp);

				$.ajax({
					type: 'POST',
					url: 'assets/php/action_index.php',
					data: {
						'confirm_email': true,
						'email': email,
						'otp': otp
					},
					dataType: 'json',
					success: function(response) {
						if (response.status === 'success') {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: response.message,
								timer: 2000,
								timerProgressBar: true,
								showConfirmButton: false
							}).then((result) => {
								if (result.dismiss === Swal.DismissReason.timer) {

									window.location.href = 'index.php?login=1';
								}
							});
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: response.message
							});
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'An error occurred while processing your request. Please try again later.'
						});
					}
				});
			});
		});






	</script>








</body>
</html>