<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');
$date = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");




if (isset($_POST['check_pass'])) {
	$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));
	$academic_year = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['academic_year']), ENT_QUOTES, 'UTF-8'));

	$x4 = 1;
	//$sql1 = "SELECT * FROM course_purchase WHERE cmuitaccount_uid = ?";
	$sql1 = "SELECT
	cp.purchase_id,
	cp.course_uid,
	cp.cmuitaccount_uid,
	cp.student_uid,
	cp.course_pass,
	cp.course_pass_date,
	cp.course_pass_datetime,
	cp.code_pass,
	cp.academic_year,
	c.course_id,
	c.course_code,
	c.course_name,
	c.course_level,
	c.course_type,
	c.course_pass_percent,
	c.course_image_url,
	c.course_detail,
	c.course_status,
	c.course_delete,
	c.course_certificate,
	c.certificate_set_name_updown,
	c.certificate_set_name_leftright,
	c.certificate_set_name_size,
	c.certificate_set_date_updown,
	c.certificate_set_date_leftright,
	c.certificate_set_date_size,
	c.certificate_set_code_updown,
	c.certificate_set_code_leftright,
	c.certificate_set_code_size
	FROM
	course_purchase AS cp
	LEFT JOIN
	course AS c ON cp.course_uid = c.course_id
	WHERE
	cp.cmuitaccount_uid = ?";
	if ($stmt = mysqli_prepare($conn, $sql1)) {
		mysqli_stmt_bind_param($stmt, "s", $cmuitaccount);
		mysqli_stmt_execute($stmt);
		$result_purchase = mysqli_stmt_get_result($stmt);

		if (mysqli_num_rows($result_purchase) > 0) {
			$x4 = 1;
			while ($row_purchase = mysqli_fetch_assoc($result_purchase)) {
                //echo $row_purchase['course_uid'];
                //echo '<br>';

				$sql2 = "SELECT * FROM course_video WHERE course_uid = '".$row_purchase['course_uid']."' ";
				$result2 = $conn->query($sql2);
				$num_result2 = mysqli_num_rows($result2);
				//echo '<br>';

				while ($row2 = $result2->fetch_assoc()) {
                    //echo $row2['video_id'];

					if ($num_result2 > 0) {

						$sql3 = "SELECT distinct video_question_uid FROM video_questions WHERE video_question_uid = '".$row2['video_question_id']."' ";
						$result3 = $conn->query($sql3);
						$num_result3 = mysqli_num_rows($result3);

						while ($row3 = $result3->fetch_assoc()) {

							if ($num_result3 > 0) {
                                //echo $row3['question_id'].'<br>';

								$sql4 = "SELECT distinct video_question_uid FROM video_questions_responses WHERE video_question_uid = '".$row3['video_question_uid']."' AND cmuitaccount_uid = '$cmuitaccount' ";
								$result4 = $conn->query($sql4);
								$num_result4 = mysqli_num_rows($result4);

								
								while ($row4 = $result4->fetch_assoc()) {

									if ($num_result4 > 0) {
                                        //echo $row4['video_question_uid'].'<br>';

										$sql5 = "SELECT COUNT(*) AS video_questions FROM video_questions WHERE video_question_uid = '".$row4['video_question_uid']."'";
										$result5 = $conn->query($sql5);
										$row5 = $result5->fetch_assoc();
										$num_video_questions = $row5['video_questions'];
										$per_num_video_questions = 100/$num_video_questions;


										$sql6 = "SELECT COUNT(*) AS video_questions_responses FROM video_questions_responses WHERE video_question_uid = '".$row4['video_question_uid']."' AND cmuitaccount_uid = '$cmuitaccount' AND selected_answeer_result = '1' ";
										$result6 = $conn->query($sql6);
										$row6 = $result6->fetch_assoc();
										$num_video_questions_responses = $row6['video_questions_responses'];
										$per_video_questions_responses = $num_video_questions_responses * $per_num_video_questions;

										
										if ($per_video_questions_responses >= $row_purchase['course_pass_percent']) {
											${'sumpass'.$x4} += 1;
										}
										//echo ${'sumpass'.$x4};

										if ($num_result2 == ${'sumpass'.$x4}) {
											//echo 'Pass';
											//echo $row_purchase['course_uid'];

											$c_purchase .= '","'.$row_purchase['course_uid'];
											$c_purchase_new =  $c_purchase.'"';
											$c_purchase_new =  substr($c_purchase_new,2);

											//echo $c_purchase = '"c2024012317113024","c2024012321452826","c2024012321452826"';

										}



										//echo $x4;
										//echo '<br>';
									}

								}


							}

						}
					}        
				}//echo '<br>';
				$x4++ ;
			}

			$c_purchase_new;
			if ($c_purchase_new == '') {
				$sql_reset = "UPDATE course_purchase SET course_pass = 0, course_pass_date = NULL, course_pass_datetime = NULL, academic_year = NULL, code_pass = NULL WHERE cmuitaccount_uid = ?";
				if ($stmt_reset = mysqli_prepare($conn, $sql_reset)) {
					mysqli_stmt_bind_param($stmt_reset, "s", $cmuitaccount);
					mysqli_stmt_execute($stmt_reset);
				//echo 'reset success';
				}
			}

			$sql_update = "UPDATE course_purchase SET course_pass = 1, course_pass_date = '$date', course_pass_datetime = '$datetime', academic_year = '$academic_year' WHERE course_uid IN ($c_purchase_new) AND cmuitaccount_uid = ? AND NOT course_pass = '1' ";
			if ($stmt_update = mysqli_prepare($conn, $sql_update)) {
				mysqli_stmt_bind_param($stmt_update, "s", $cmuitaccount);
				mysqli_stmt_execute($stmt_update);
				//echo 'succss';

				
				$c_purchase_code_pass = $c_purchase_new;
				$c_purchase_array = explode(",", $c_purchase_code_pass);

				foreach ($c_purchase_array as $course_uid) {
					$randomLetters = chr(rand(65, 90)) . chr(rand(65, 90));
					$randomNumber = rand(1000, 9999);

					$sql_update2 = "UPDATE course_purchase cp
					JOIN course c ON cp.course_uid = c.course_id
					SET cp.code_pass = CONCAT(c.course_code,cp.student_uid,'$randomLetters', '$randomNumber')
					WHERE cp.course_uid in ($course_uid) 
					AND cp.cmuitaccount_uid = ? AND (cp.code_pass IS NULL OR cp.code_pass = '')";

					if ($stmt_update2 = mysqli_prepare($conn, $sql_update2)) {
						mysqli_stmt_bind_param($stmt_update2, "s", $cmuitaccount);
						mysqli_stmt_execute($stmt_update2);
						//echo 'code_pass success';
					}
				}
			}


			$sql_reset = "UPDATE course_purchase SET course_pass = 0, course_pass_date = NULL, course_pass_datetime = NULL, academic_year = NULL , code_pass = NULL WHERE course_uid NOT IN ($c_purchase_new) AND cmuitaccount_uid = ?";
			if ($stmt_reset = mysqli_prepare($conn, $sql_reset)) {
				mysqli_stmt_bind_param($stmt_reset, "s", $cmuitaccount);
				mysqli_stmt_execute($stmt_reset);
				//echo 'reset success';
			}


		} else {
            // No course purchases found for the user
		}

		mysqli_stmt_close($stmt);
	}

	mysqli_close($conn);
}











?>