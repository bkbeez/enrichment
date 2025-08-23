<?ob_start();?>
<?php 
session_start(); 
include 'assets/php/connect.php';

if (!isset($_SESSION['oauth2state']) || !isset($_SESSION['cmuitaccount'])) {
	header("location:index.php"); 
}


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
		<!-- <label>SESSION_oauth2state : </label><?php echo $_SESSION['oauth2state']; ?> <br>-->
		<!-- <label class="text-light">cmu_account : <?php echo $_SESSION['cmuitaccount']; ?></label>  -->


		<?php 
		$basename_server = basename($_SERVER['PHP_SELF']);



		?>







		<br>
		<?php echo $_SESSION['cmuitaccount_name'];

		$query_cmu = "SELECT * FROM users_cmu where cmuitaccount = '{$_SESSION['cmuitaccount']}' ";
		$stmt_cmu = $conn->prepare($query_cmu);
		$stmt_cmu->execute();
		$result_cmu=$stmt_cmu->get_result();                       
		foreach ($result_cmu as $row_cmu){
			$cmuitaccount_name = $row_cmu['cmuitaccount_name'];
			$cmuitaccount = $row_cmu['cmuitaccount'];
			$student_id = $row_cmu['student_id'];
			$prename_id = $row_cmu['prename_id'];
			$prename_THprename_EN = $row_cmu['prename_THprename_EN'];
			$firstname_TH = $row_cmu['firstname_TH'];
			$firstname_EN = $row_cmu['firstname_EN'];
			$lastname_TH = $row_cmu['lastname_TH'];
			$lastname_EN = $row_cmu['lastname_EN'];
			$organization_code = $row_cmu['organization_code'];
			$organization_name_TH = $row_cmu['organization_name_TH'];
			$organization_name_EN = $row_cmu['organization_name_EN'];
			$itaccounttype_id = $row_cmu['itaccounttype_id'];
			$itaccounttype_TH = $row_cmu['itaccounttype_TH'];
			$itaccounttype_EN = $row_cmu['itaccounttype_EN'];
			$cmu_timestamp = $row_cmu['cmu_timestamp'];
			$cmu_date_add = $row_cmu['cmu_date_add'];
		}

		?>

		<div class="row bg-secondary p-4" style="border-radius: 25px;">
			<span class="text-light"> cmu_account : <?= $_SESSION['cmuitaccount']; ?></span>
			<span class="text-light"> system_account : <?= $_SESSION['user']; ?></span>

			<div class="form-inline text-light">
				<span><?= $firstname_TH ?></span>
				<span><?= $lastname_TH ?></span>
				<span><?= $student_id ?></span>
			</div>



<!-- 				<a href="index.php"><button class="btn btn-dark my-1"><i class="fa fa-home"></i> index</button></a><br>
				<a href="page1.php"><button class="btn btn-dark my-1"><i class="fa-solid fa-arrow-right"></i> page1</button></a><br>
				<a href="page2.php"><button class="btn btn-dark my-1"><i class="fa-solid fa-arrow-right"></i> page2</button></a><br> -->

				<a href="logout.php"><button class="btn btn-danger my-1"><i class="fa-solid fa-right-from-bracket"></i> logout</button></a><br>
			</div>



			<div class="row bg-secondary p-4 my-2" style="border-radius: 25px;">
				

				<?php 
				$query_system = "SELECT * FROM users where edu_id = '$student_id' ";
				$stmt_system = $conn->prepare($query_system);
				$stmt_system->execute();
				$result_system=$stmt_system->get_result(); 
				$edu_id_system_row = mysqli_num_rows($result_system);                 
				foreach ($result_system as $row_system){
					$edu_id_system = $row_system['edu_id'];
					$edu_email_system = $row_system['email'];
					$edu_password_system = $row_system['password'];
				}

				?>


				<?php if ($edu_id_system_row > 0){ ?>

					<div class="row text-light text-center h6">
						<span><?= $edu_id_system ?></span>
						<span><?= $edu_email_system ?></span>

					</div>
					
					<div class="row text-light my-2">


						<?php
						if (isset($_POST['login'])) {
							$email = $_POST['email'];
							$_SESSION['user'] = $email;

							header('refresh: 0; url=/'.$basename_server.'');
						}
						?>


						<form action="<?= $basename_server ?>" method="POST" enctype="multipart/form-data">
							<input type="email" name="email" id="email" class="form-control rounded-0" value="<?= $edu_email_system ?>" hidden>

							<div class="text-center">
								<button type="submit" name="login" id="login" class="btn btn-primary p-3 w-50 shadow-lg"><i class="fa-solid fa-arrow-pointer fa-2x"></i> เข้าสู่ระบบ</button>
							</div>


						</form>


						



					</div>

				<?php }else { ?>
					<em class="h4 text-light">ยังไม่มีข้อมูลในระบบโปรดแจ้งเจ้าหน้าที่</em>
				<?php } ?>




			</div>


			<input id="check_email" class="form-control rounded-0" value="<?= $edu_email_system ?>" hidden>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


		<script>
			$(document).ready(function() {

				setTimeout(function() {
					$('#check_email').click();
				}, 500);

				$('#check_email').click(function() {
					var email = $('#check_email').val();

					if (email !== '' && email !== null) {
						//console.log('Login successful for email: ' + email);

						Swal.fire({
							icon: 'success',
							title: 'Login successful!',
							text: 'Email: ' + email,
							timer: 2000,
							showConfirmButton: false,
							timerProgressBar: true
						}).then(() => {
							setTimeout(function() {
								$('#login').click();
							}, 500);
						});

					} else {
						console.log('Email is empty or null. Cannot login.');
					}
				});


			});
		</script>

	</body>
	</html>