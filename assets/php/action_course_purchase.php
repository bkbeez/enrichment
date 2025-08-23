<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');



if (isset($_POST['get_course_purchase'])) {
	$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));
	$get_student_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['get_student_id']), ENT_QUOTES, 'UTF-8'));


	if ($get_student_id == '') { }else{
		$sql_student_id = "SELECT cmuitaccount FROM users_cmu WHERE student_id = ?";
		$stmt = $conn->prepare($sql_student_id);
		$stmt->bind_param("s", $get_student_id);
		$stmt->execute();
		$result_student_id = $stmt->get_result();

		if ($result_student_id->num_rows == 1) {
			$row_student_id = $result_student_id->fetch_assoc();
			$cmuitaccount = $row_student_id['cmuitaccount'];
		}
	}

	$sql = "SELECT * FROM course_purchase WHERE cmuitaccount_uid = ? ORDER BY timecreate ASC";
	if ($stmt = mysqli_prepare($conn, $sql)) {
		mysqli_stmt_bind_param($stmt, "s", $cmuitaccount);
		mysqli_stmt_execute($stmt);
		$result_purchase = mysqli_stmt_get_result($stmt);


		if (mysqli_num_rows($result_purchase) > 0) {
			echo '<div class="row">';
			$x = 1;
			while ($row_purchase = mysqli_fetch_assoc($result_purchase)) {

				$sql = "SELECT * FROM course WHERE course_id = '".$row_purchase['course_uid']."' ";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();

				$course_type_badge = '';
				$course_type_text = '';
				switch ($row['course_type']) {
					case 1:
					$course_type_badge = 'bg-info';
					$course_type_text = 'เลือก';
					break;
					case 2:
					$course_type_badge = 'bg-danger';
					$course_type_text = 'กำหนด';
					break;
					default:
					$course_type_badge = 'bg-secondary';
					$course_type_text = '';
				}

				$course_level_text = '';
				switch ($row['course_level']) {
					case 1:
					$course_level_text = 'ชั้นปีที่1';
					break;
					case 2:
					$course_level_text = 'ชั้นปีที่2';
					break;
					case 3:
					$course_level_text = 'ชั้นปีที่3';
					break;
					case 4:
					$course_level_text = 'ชั้นปีที่4';
					break;
					case 5:
					$course_level_text = 'ทุกชั้นปี';
					break;
					default:
					$course_level_text = '';
				}


				echo '<div class="col-md-12 col-12">';
				echo '<div class="card bg-light text-dark mb-2">
				<div class="card-body p-2">
				<div class="row">

				<div class="col-8">

				<div class="d-flex justify-content-between">
				<h5 class="">กิจกรรม</h5>
				<h5>' . $course_level_text . '</h5>
				</div>
				<div class="">
				<span class="">'.$x.'. '.$row['course_name'].'</span>
				</div>

				<ul class="list-group list-group-flush">
				<li class="list-group-item">ประเภทกิจกรรม <span class="badge '.$course_type_badge.'">'.$course_type_text.'</span> </li>';

				$nc1 = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_video WHERE course_uid = '".$row_purchase['course_uid']."'"));
				if ($nc1 > 0) {
					$sql_v = "SELECT video_question_id FROM course_video WHERE video_question_id in (select distinct video_question_uid FROM video_questions_responses WHERE course_uid = '".$row_purchase['course_uid']."' ) ";
						$result_v = $conn->query($sql_v);
						//$nv1 = $result_v->num_rows;

						while ($row_v = mysqli_fetch_assoc($result_v)) {
							$video_question_id = $row_v['video_question_id'];

							$num_count1 = mysqli_num_rows(mysqli_query($conn,"SELECT selected_answeer_result FROM video_questions_responses WHERE video_question_uid = '".$row_v['video_question_id']."' AND cmuitaccount_uid = '$cmuitaccount' "));

							$num_count2 = mysqli_num_rows(mysqli_query($conn,"SELECT selected_answeer_result FROM video_questions_responses WHERE video_question_uid = '".$row_v['video_question_id']."' AND cmuitaccount_uid = '$cmuitaccount' AND selected_answeer_result = '1' "));

							$num_count1 = round((100/$num_count1));
							$num_count2 = $num_count2*$num_count1;


							if ($num_count2 >= $row['course_pass_percent']) {
								${'$numx'.$x} +=1;
							}
						}

						$numx = ${'$numx'.$x};
						$percent_s = ($numx/$nc1)*100;

						switch (true) {
							case $percent_s >= 0 && $percent_s < 75:
							$class = "bg-danger";
							break;
							case $percent_s >= 75 && $percent_s <= 99:
							$class = "bg-warning";
							break;
							case $percent_s >= 100 && $percent_s <= 100:
							$class = "bg-success";
							break;
							default:
							$class = "";
							break;
						}
					}else{
						$percent_s = 0;
					}

					$x++;

					echo '<li class="list-group-item">สถานะ<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated ' . $class . '" style="width: ' . ($percent_s == 0 ? '10' : $percent_s) . '%"><strong>' . $percent_s . '%</strong></div>
					</div></li>';


					$course_pass_badge = '';
					$course_pass_text = '';
					switch ($row_purchase['course_pass']) {
						case 1:
						$course_pass_badge = 'bg-success';
						$course_pass_text = 'ผ่าน';
						break;
						case 2:
						$course_pass_badge = 'bg-danger';
						$course_pass_text = 'ไม่ผ่าน';
						break;
						default:
						$course_pass_badge = 'bg-secondary';
						$course_pass_text = '';
					}

					if (!empty($row_purchase['course_pass_date']) && $row_purchase['course_pass_date'] !== '0000-00-00') {
						$course_pass_date = date('d-m-Y', strtotime($row_purchase['course_pass_date']));
					} else {
						$course_pass_date = 'ใบประกาศ <span>รอเข้าเรียน</span>';
					}

					echo '<li class="list-group-item d-flex justify-content-between"><span><span class="badge '.$course_pass_badge.'">'.$course_pass_text.'</span> <small>'.$course_pass_date.'</small></span>';

					if ($percent_s == 100) {
						echo '<button class="certificate_export btn btn-sm btn-outline-secondary" 
						data-purchase_id='.$row_purchase['purchase_id'].'>
						<i class="bi bi-download"></i> ใบประกาศ</button></li>';
					}

					echo '
					</ul>
					</div>
					<div class="col-4">
					<img class="img img-fluid" alt="" src="' . (($row['course_image_url'] == null or $row['course_image_url'] == '') ? 'assets/img/course/img-07.jpg' : $row['course_image_url']) . '">
					<div class="btn-group w-100">
					<button type="button" class="delete_purchase btn btn btn-outline-secondary btn-rounded" data-id='.$row_purchase['id'].' data-cmuitaccount='.$cmuitaccount.'>ลบ</button>
					<button type="button" class="course_learning btn btn btn-primary btn-rounded" data-course_uid='.$row_purchase['course_uid'].'>เข้าสู่กิจกรรม<i class="bi bi-arrow-right-short fa-lg"></i></button>
					</div>
					</div>
					';

					echo '</div>';
					echo '</div>'; 
					echo '</div>';
					echo '</div>'; 
					echo '</div>'; 
				}



				echo '</div>'; 
			} else {
				echo "No course found";
			}

			mysqli_stmt_close($stmt);
		}

		mysqli_close($conn);
	}




	if (isset($_POST['delete_purchase'])) {

		$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
		$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));



		$sql2 = "SELECT * FROM course_purchase WHERE id = '$id' ";
		$result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()) {
					//echo $row2['course_uid'];

			$sql3 = "SELECT * FROM course_video WHERE course_uid = '".$row2['course_uid']."' ";
			$result3 = $conn->query($sql3);
			$num_result3 = mysqli_num_rows($result3);
			while ($row3 = $result3->fetch_assoc()) {
						//echo $row3['video_question_id'];

				$sql4 = "SELECT * FROM video_questions_responses WHERE video_question_uid = '".$row3['video_question_id']."' AND cmuitaccount_uid = '$cmuitaccount'  ";
				$result4 = $conn->query($sql4);
				$num_result4 = mysqli_num_rows($result4);
				while ($row4 = $result4->fetch_assoc()) {
						//echo $row4['video_question_uid'];

					$query2 = "DELETE FROM video_questions_responses WHERE video_question_uid=? AND cmuitaccount_uid = '$cmuitaccount' ";
					$stmt2 = $conn->prepare($query2);
					$stmt2->bind_param("s", $row4['video_question_uid']);
					$stmt2->execute();

				}

			}

		}


		$query = "DELETE FROM course_purchase WHERE id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $id);
		$stmt->execute();



		if ($stmt->affected_rows > 0) {
			$res = [
				'status' => 200,
				'message' => 'ข้อมูล deleted successfully'
			];
			echo json_encode($res);
			return;
		} else {
			$res = [
				'status' => 500,
				'message' => 'เกิดข้อผิดพลาดในการ delete ข้อมูล'
			];
			echo json_encode($res);
			return;
		}

		$stmt->close();

	}



	if (isset($_POST['get_user_detail'])) {
		$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));

		$sql = "SELECT * FROM users_cmu WHERE cmuitaccount = ?";
		if ($stmt = mysqli_prepare($conn, $sql)) {
			mysqli_stmt_bind_param($stmt, "s", $cmuitaccount);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);


			if (mysqli_num_rows($result) == 1) {
				echo '<div class="row">';
				while ($row = mysqli_fetch_assoc($result)) {

					echo '<div class="col-md-12 col-12">';
					echo '<div class="card mb-2">
					<div class="card-body">
					<div class="row">
					<h5 class="text-dark"><i class="bi bi-person-circle"></i> '.$row['cmuitaccount'].'<h5>
					<h5 class="text-dark"> '.$row['firstname_TH'].' '.$row['lastname_TH'].'<h5>
					<h5 class="text-dark"> '.$row['student_id'].'<h5>
					<div class="d-flex justify-content-between">

					</div>


					</div>'; 
					echo '</div>';
					echo '</div>'; 
					echo '</div>';
					echo '</div>'; 
				}



				echo '</div>'; 
			} else {
				echo "No data found";
			}

			echo '<div class="col-md-12 col-12">';
			echo '<div class="card border-primary mb-2">
			<div class="card-body">
			<div class="d-flex justify-content-between text-primary fw-bold">

			<span class=""><i class="bi bi-stack"></i> จำนวนกิจกรรมทั้งหมด</span>	
			<span>' . ($num_course_purchase = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_purchase WHERE cmuitaccount_uid = '$cmuitaccount' "))) . '</span>	

			</div>'; 
			echo '</div>';
			echo '</div>'; 
			echo '</div>';
			echo '</div>';

			echo '<div class="col-md-12 col-12">';
			echo '<div class="card bg-warning mb-2">
			<div class="card-body">
			<div class="d-flex justify-content-between text-dark fw-bold">
			<span><i class="bi bi-star"></i> กิจกรรมที่รอการเรียน</span>	
			<span>' . ($num_course_purchase = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_purchase WHERE cmuitaccount_uid = '$cmuitaccount' AND course_pass = '0' "))) . '</span>	
			</div>
			</div>'; 
			echo '</div>'; 
			echo '</div>';
			echo '</div>';


			echo '<div class="col-md-12 col-12">';
			echo '<div class="card bg-success mb-2">
			<div class="card-body">
			<div class="d-flex justify-content-between text-dark fw-bold">
			<span><i class="bi bi-award"></i> กิจกรรมที่ผ่าน</span>	
			<span>' . ($num_course_purchase = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_purchase WHERE cmuitaccount_uid = '$cmuitaccount' AND course_pass = '1' "))) . '</span>

			</div>'; 
			echo '</div>';
			echo '</div>'; 
			echo '</div>';
			echo '</div>'; 




			mysqli_stmt_close($stmt);
		}

		mysqli_close($conn);
	}









?>