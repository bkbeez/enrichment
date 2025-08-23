<?php 
session_start();
require "../../../assets/php/connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/vendor/autoload.php';




if (isset($_POST['card_choose_modal'])) {
	?>

	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title"></h5>
			<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
		</div>
		<div class="modal-body">

			<div id="main_page">
				<div class="text-center my-5">
					<button class="btn btn-lg btn-primary w-100 py-4 mb-2 shadow fw-bold" id="have_user"><i class="bi bi-emoji-smile-fill"></i> เป็นสมาชิกแล้ว</button>	
					<button class="btn btn-lg btn-warning w-100 py-4 mb-2 shadow" id="no_user">ลงทะเบียนสมาชิกใหม่</button>	
				</div>
			</div>
			

		</div>
		<div class="modal-footer">

		</div>
	</div>

	<?php
}

if (isset($_POST['card_click1'])) {  

	?>


	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="btn btn-outline-secondary back_main py-0"><i class="bi bi-arrow-left-short"></i>เป็นสมาชิกแล้ว</button>	
		</div>
		<div class="modal-body my-4">

			<form id="Register_Form">

				<div class="form-floating mb-1">
					<input type="email" class="form-control" name="create_email" id="create_email">
					<label>Email address</label>
				</div>
				<div class="form-floating mb-1">
					<input type="password" class="form-control" name="create_password" id="create_password">
					<label>Password</label>
				</div>
				<div class="form-floating mb-1">
					<input type="password" class="form-control" name="confirm_password" id="confirm_password">
					<label>Confirm Password</label>
				</div>
				<div id="passError" class="text-danger font-weight-bold"></div>

			</form>

			<div class="text-center mt-3">
				<input type="submit" class="btn btn-lg btn-success" id="check_user_register" value="ลงทะเบียนสมาชิกใหม่">	
			</div>

		</div>
		<div class="modal-footer">
		</div>
	</div>

	<?php
}


if (isset($_POST['card_click2'])) {  

	?>

	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="btn btn-outline-secondary back_main py-1"><i class="bi bi-arrow-left-short"></i>ยังไม่ได้เป็นสมาชิก</button>	
		</div>
		<div class="modal-body my-4">

			<form id="Login_Form">
				<div class="form-floating mb-2">
					<input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email']; }  ?>">
					<label>Email address</label>
				</div>
				<div class="form-floating mb-2">
					<input type="password" class="form-control" name="password" id="password" placeholder="" value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password']; } ?>">
					<label>Password</label>
				</div>

				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" <?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?>>
					<label class="form-check-label">
						จำUSERใช้งาน
					</label>
				</div>
			</form>

			<div class="text-center mt-3">	
				<button type="button" class="btn btn-lg btn-primary w-100 rounded-4 shadow-lg mb-3 fw-bold" id="check_user_login">เข้าสู่ระบบ</button>
				<h6 class="" id="check_forget_password" >ลืมรหัสผ่านใช่หรือไม่</h6>
			</div>

		</div>
		<div class="modal-footer">
		</div>
	</div>

	<?php
}



if (isset($_POST['card_click3'])) {  

	?>

	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="btn btn-outline-secondary back_login py-0"><i class="bi bi-arrow-left-short"></i>กลับ</button>	
		</div>
		<div class="modal-body my-4">


			<form id="Forget_otp_Form">
				<div class="form-floating mb-2">
					<input type="email" class="form-control" name="check_otp_email" id="check_otp_email">
					<label>Email address</label>
				</div>
			</form>
			<input type="button" class="btn btn-lg btn-outline-primary w-100 rounded-4 shadow-lg mb-3 fw-bold" id="sent_otp_new_password" value="ส่ง OTP">

		</div>
		<div class="modal-footer">
		</div>
	</div>

	<?php
}


if (isset($_POST['card_click4'])) {  
	$email = $_POST['email'];
	?>

	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body my-4">


			<form id="Forget_Form">
				<div class="form-floating mb-2">
					<input type="email" class="form-control" name="email" id="email" value="<?= $email ?>" readonly>
					<label>Email address</label>
				</div>
				<div class="form-floating mb-2">
					<input type="password" class="form-control" name="new_password" id="new_password">
					<label>New Password</label>
				</div>
				<div class="form-floating mb-2">
					<input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password">
					<label>Confirm New Password</label>
				</div>
				<div class="form-floating mb-2">
					<input type="number" class="form-control" name="otp_new_password" id="otp_new_password">
					<label>OTP Form your Email</label>
				</div>
			</form>
			<button type="button" class="btn btn-lg btn-success w-100 rounded-4 shadow-lg mb-3 fw-bold" id="check_new_password">สร้างรหัสผ่านใหม่</button>

		</div>
		<div class="modal-footer">
		</div>
	</div>

	<?php
}



if (isset($_POST['action_Register']) && $_POST['action_Register'] == 'true') {
	$email = $_POST['create_email'];
	$password = $_POST['create_password'];

	$check_email_query = "SELECT * FROM users WHERE email = ?";
	$stmt_check = $conn->prepare($check_email_query);
	$stmt_check->bind_param("s", $email);
	$stmt_check->execute();
	$result_check = $stmt_check->get_result();

	if ($result_check->num_rows > 0) {
		$response = array("status" => "error", "message" => "email นี้ได้ลงทะเบียนแล้ว!");
		echo json_encode($response);
	} else {
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$otp_verify = rand(100000, 999999);

		$sql = "INSERT INTO users (email, password, otp_verify) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($sql);

		if ($stmt) {
			$stmt->bind_param("sss", $email, $hashedPassword, $otp_verify);

			if ($stmt->execute()) {

				$mail = new PHPMailer(true);
				$mail->SMTPDebug = 0;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'academic.service.edcmu@gmail.com';
				$mail->Password = 'cjibjslnlidmgbyj';
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;
				$mail->setFrom('academic.service.edcmu@gmail.com', 'academic.service.edcmu@gmail.com');
				$mail->addAddress($email, 'SERVICE');
				$mail->isHTML(true);

				$mail->Subject = 'Email verification';
				$mail->Body    = '<p>Your verification code is: <b style="font-size: 24px;">
				https://enrichment-program.edu.cmu.ac.th/Service/verify_email.php?email=' . $email . '&otp=' . $otp_verify . ' </b>';
				$mail->CharSet = "UTF-8";
				$mail->send();


				$response = array("status" => "success", "message" => "สมัครสำเร็จ กรุณายืนยัน Link ใน email ของท่าน");
				echo json_encode($response);
			} else {
				echo "Error: " . $stmt->error;
			}

			$stmt->close();
		} else {
			echo "Error: Unable to prepare statement";
		}
	}

	$stmt_check->close();
	$conn->close();
}





if (isset($_POST['action_login']) && $_POST['action_login'] == 'true') {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$remember_me = $_POST['remember_me'];

	$sql = "SELECT * FROM users WHERE email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$hashedPassword = $row['password'];

		if (password_verify($password, $hashedPassword)) {
			if ($row['users_status'] == 'inactive') {
				echo json_encode(array("status" => "error", "message" => "กรุณายืนยัน Link ใน email ของท่าน และ Login อีกครั้ง"));
			} elseif ($row['users_status'] == 'active') {
				if (!empty($remember_me)) {
					setcookie("email",$email, time()+(30*24*60*60), '/');
					setcookie("password",$password, time()+(30*24*60*60), '/');
				} else {
					setcookie("email","",1, '/');
					setcookie("password","",1, '/');
				}
				$_SESSION['email_service'] = $row['email'];
				$sql_update = "UPDATE users SET password_input = ? WHERE email = ?";
				$stmt_update = $conn->prepare($sql_update);
				$stmt_update->bind_param("ss", $password, $email);
				$stmt_update->execute();

				echo json_encode(array("status" => "success", "message" => "ยินดีต้อนรับ เข้าสู่ระบบสำเร็จ"));
			}
		} else {
			echo json_encode(array("status" => "error", "message" => "รหัสผ่านไม่ถูกต้อง"));
		}
	} else {
		echo json_encode(array("status" => "error", "message" => "email ของท่านไม่ถูกต้อง หรือ ยังไม่ได้ลงทะเบียน"));
	}

	$stmt->close();
	$conn->close();
}



if (isset($_POST['action_sent_otp_new_password']) && $_POST['action_sent_otp_new_password'] == 'true') {
	$check_otp_email = $_POST['check_otp_email'];

	if (empty($check_otp_email)) {
		echo json_encode(array("status" => "error", "message" => "กรุณากรอก Email"));
		exit;
	}

	$check_email_query = "SELECT * FROM users WHERE email = ?";
	$stmt_check = $conn->prepare($check_email_query);
	$stmt_check->bind_param("s", $check_otp_email);
	$stmt_check->execute();
	$result_check = $stmt_check->get_result();

	if ($result_check->num_rows == 0) {
		echo json_encode(array("status" => "error", "message" => "Email ไม่ถูกต้องหรือยังไม่มีในระบบ"));
		exit;
	}

	$otp_reset = rand(100000, 999999);

	$sql = "UPDATE users SET otp_reset = ?  WHERE email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $otp_reset, $check_otp_email);

	if ($stmt->execute()) {

		$mail = new PHPMailer(true);
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'academic.service.edcmu@gmail.com';
		$mail->Password = 'cjibjslnlidmgbyj';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;
		$mail->setFrom('academic.service.edcmu@gmail.com', 'Service OTP รีเซตรหัสผ่าน');
		$mail->addAddress($check_otp_email, 'SERVICE');
		$mail->isHTML(true);

		$mail->Subject = 'OTP รีเซตรหัสผ่าน';
		$mail->Body    = '<p>Your OTP code is: <b style="font-size: 30px;">' . $otp_reset . '</b><br>
		1.Copy your code <br> 2. Put OTP to reset Password <br>3.Verify by code!';
		$mail->CharSet = "UTF-8";
		$mail->send();


		echo json_encode(array("status" => "success", "message" => "OTP sent successfully", "email" => $check_otp_email, ));
	} else {
		echo json_encode(array("status" => "error", "message" => "Error OTP sent"));
	}
}






if (isset($_POST['action_create_new_password']) && $_POST['action_create_new_password'] == 'true') {
	$email = $_POST['email'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
	$otp = $_POST['otp_new_password'];

	if (empty($email)) {
		echo json_encode(array("status" => "error", "message" => "กรุณากรอก Email"));
		exit;
	}

	$check_email_query = "SELECT * FROM users WHERE email = ?";
	$stmt_check = $conn->prepare($check_email_query);
	$stmt_check->bind_param("s", $email);
	$stmt_check->execute();
	$result_check = $stmt_check->get_result();

	if ($result_check->num_rows == 0) {
		echo json_encode(array("status" => "error", "message" => "Email ไม่ถูกต้องหรือยังไม่มีในระบบ"));
		exit;
	}

	if (strlen($new_password) < 4 || strlen($confirm_new_password) < 4) {
		echo json_encode(array("status" => "error", "message" => "กรุณากรอกอย่างน้อย 4 ตัว"));
		exit;
	}

	if (empty($new_password) || empty($confirm_new_password)) {
		echo json_encode(array("status" => "error", "message" => "กรุณากรอก password"));
		exit;
	}

	if ($new_password !== $confirm_new_password) {
		echo json_encode(array("status" => "error", "message" => "กรุณากรอก password ให้ตรงกัน"));
		exit;
	}

	if (empty($otp)) {
		echo json_encode(array("status" => "error", "message" => "กรุณากรอก OTP"));
		exit;
	}

	$check_otp_query = "SELECT otp_reset FROM users WHERE email = ?";
	$stmt_otp = $conn->prepare($check_otp_query);
	$stmt_otp->bind_param("s", $email);
	$stmt_otp->execute();
	$result_otp = $stmt_otp->get_result();
	$row_otp = $result_otp->fetch_assoc();

	if (empty($row_otp['otp_reset'])) {
		echo json_encode(array("status" => "error", "message" => "โปรดกดส่ง OTP อีกครั้ง"));
		exit;
	}

	if ($otp != $row_otp['otp_reset']) {
		echo json_encode(array("status" => "error", "message" => "OTP ไม่ถูกต้องโปรดเช็คใน Email ของท่าน"));
		exit;
	}

	$sql = "UPDATE users SET password = ?, otp_reset = '' WHERE email = ?";
	$stmt = $conn->prepare($sql);
	$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
	$stmt->bind_param("ss", $hashed_password, $email);

	if ($stmt->execute()) {
		echo json_encode(array("status" => "success", "message" => "Password updated successfully"));
		setcookie("password","",1, '/');
	} else {
		echo json_encode(array("status" => "error", "message" => "Error updating password"));
	}

	$stmt->close();
	$conn->close();
}





if (isset($_POST['confirm_email']) && $_POST['confirm_email'] == 'true') {

	$email = $_POST['email'];
	$otp = $_POST['otp'];


	$check_otp_query = "SELECT otp_verify FROM users WHERE email = ? AND otp_verify = ?";
	$stmt_check_otp = $conn->prepare($check_otp_query);
	$stmt_check_otp->bind_param("si", $email, $otp);
	$stmt_check_otp->execute();
	$result_check_otp = $stmt_check_otp->get_result();

	if ($result_check_otp->num_rows == 0) {
		echo json_encode(array("status" => "error", "message" => "OTP ไม่ถูกต้อง"));
		exit;
	}

	$sql = "UPDATE users SET users_status = 'active' WHERE email = ? AND otp_verify = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", $email, $otp);

	if ($stmt->execute()) {
		setcookie("email",$email, time()+(30*24*60*60), '/');
		echo json_encode(array("status" => "success", "message" => "Email confirmed successfully"));
	} else {
		echo json_encode(array("status" => "error", "message" => "Error confirming email"));
	}

	$stmt_check_otp->close();
	$stmt->close();
	$conn->close();
}




if (isset($_POST['update_last_activity'])) {

	if (isset($_SESSION['email_service'])) {
		$email = $_SESSION['email_service'];
		$sql = "UPDATE users SET last_activity = NOW() WHERE email = '$email'";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $email);
		if ($stmt->execute()) {
			$response = [
				'success' => true,
				'message' => 'Last activity updated successfully',
			];
		} else {
			$response = [
				'success' => false,
				'message' => 'Failed to update last activity',
			];
		}
		echo json_encode($response);
	} 

	if (isset($_SESSION['email_service'])) {
		$email = $_SESSION['email_service'];
		$threshold = 300;
		$fiveMinutesAgo = date('Y-m-d H:i:s', time() - $threshold);

		$sql = "SELECT email, last_activity FROM users WHERE last_activity >= ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $fiveMinutesAgo);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$email = $row['email'];
				$lastActivity = strtotime($row['last_activity']);
				$isActive = ($lastActivity >= strtotime($fiveMinutesAgo)) ? 'alive' : 'not_alive';

				$updateSql = "UPDATE users SET active_status = ? WHERE email = ?";
				$updateStmt = $conn->prepare($updateSql);
				$updateStmt->bind_param("ss", $isActive, $email);
				$updateStmt->execute();
			}
		}

		$stmt->close();
		$updateStmt->close();
		$conn->close();
	} 






}


















?>