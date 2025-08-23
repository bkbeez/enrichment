<?php 
session_start();
require '../assets/php/connect.php';

function insertLog($conn, $cmuitaccount_name, $cmuitaccount, $student_id, $action)
{
	$sql = "SELECT MAX(id) AS max_log FROM users_cmu_log";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$max_log = $row['max_log'] + 1;
		$max_log = 'log_' . $max_log;
	} else {
		$max_log = 'log_' . '1';
	}

	$sql_log = "INSERT INTO users_cmu_log (log_id, cmuitaccount_name, cmuitaccount, student_id, action) 
	VALUES (?, ?, ?, ?, ?)";
	$stmt_log = mysqli_prepare($conn, $sql_log);
	mysqli_stmt_bind_param($stmt_log, "sssss", $max_log, $_SESSION['cmuitaccount_name'], $_SESSION['cmuitaccount'], $_SESSION['student_id'], $action);
	mysqli_stmt_execute($stmt_log);
}

insertLog($conn, $cmuitaccount_name, $cmuitaccount, $student_id, 'logout');


unset($_SESSION['cmuitaccount_name']);
unset($_SESSION['cmuitaccount']);
unset($_SESSION['user_type']);
unset($_SESSION['student_id']);

session_unset();
session_destroy();
header('Location: ../index');
exit();
?>