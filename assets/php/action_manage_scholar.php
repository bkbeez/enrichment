<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');




if (isset($_POST['search_scholar'])) {
	$searchText1 = isset($_POST['search1']) ? $_POST['search1'] : '';
	$searchText2 = isset($_POST['search2']) ? $_POST['search2'] : '';
	$searchText3 = isset($_POST['search3']) ? $_POST['search3'] : '';
	$searchText4 = isset($_POST['search4']) ? $_POST['search4'] : '';

	$results = '';

	if (!empty($searchText1) || !empty($searchText2) || !empty($searchText3) || !empty($searchText4)) {
		$sql = "SELECT * FROM users_cmu WHERE student_id LIKE '%$searchText1%' AND user_major LIKE '%$searchText2%' AND CONCAT(firstname_TH, lastname_TH) LIKE '%$searchText3%' AND user_type = 'user' ORDER BY student_id ASC";
	} else {
		$sql = "SELECT * FROM users_cmu WHERE user_type = 'user' ORDER BY student_id DESC LIMIT 10";
	}

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$x = 1 ;
		while ($row = $result->fetch_assoc()) {
			$num_total_course = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_purchase WHERE cmuitaccount_uid = '".$row['cmuitaccount']."' AND academic_year = '$searchText4' "));
			$num_success_course = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_purchase WHERE cmuitaccount_uid = '".$row['cmuitaccount']."' AND course_pass = 1 AND academic_year = '$searchText4' "));
			$num_wait_course = $num_total_course - $num_success_course;
			
			$results .= '<div class="card pb-0 mb-0">
			<div class="card-body p-0">
			<div class="d-flex justify-content-between">
			<span>
			' .'<b>'.$x.'</b> '. $row['student_id'] . ' <b>สาขาวิชา</b> ' . $row['user_major'] . ' <b>ชื่อ</b> ' . $row['firstname_TH'] .' '. $row['lastname_TH'] . '<br>
			</span>
			<div>
			<span class="total_course badge '.($num_total_course > 0 ? 'btn-primary':'btn-light' ).'" 
			data-id="' . $row['id'] . '" data-student_id="' . $row['student_id'] . '" data-cmuitaccount="' . $row['cmuitaccount'] . '" >'.$num_total_course.'</span>
			<span class="wait_course badge '.($num_wait_course > 0 ? 'btn-danger':'btn-light' ).'" 
			data-id="' . $row['id'] . '" data-student_id="' . $row['student_id'] . '" data-cmuitaccount="' . $row['cmuitaccount'] . '" >'.$num_wait_course.'</span>
			<span class="success_course badge '.($num_success_course > 0 ? 'btn-success':'btn-light' ).' " 
			data-id="' . $row['id'] . '" data-student_id="' . $row['student_id'] . '" data-cmuitaccount="' . $row['cmuitaccount'] . '" >'.$num_success_course.'</span>
			<button class="show_user btn btn-sm btn-dark" data-id="' . $row['id'] . '" data-cmuitaccount="' . $row['cmuitaccount'] . '" data-year="' . $searchText4 . '" >ดูข้อมูล</button>
			</div>
			</div>';
			$x++;
			$results .= '</div></div></div>';
		}
	} else {
		$results = "No results found.";
	} 

	echo $results;

	$conn->close();
}



if (isset($_POST['get_user_course_detail'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));
	$year = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['year']), ENT_QUOTES, 'UTF-8'));



	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

	$sql = "SELECT * FROM course_purchase WHERE cmuitaccount_uid = ? AND academic_year = '$year' ORDER BY timecreate ASC";

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

				echo '<div class="col-md-12 col-12 mb-1">';
				echo '<div class="card bg-light text-dark mb-0 h-100">
				<div class="card-body p-0 m-0">
				<div class="row">

				<div class="col-12">

				<div class="">
				<span>'.$x.'. '.$row['course_name'].' '.$row['course_code'].'</span>
				</div>

				<ul class="list-group list-group-flush">';

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


							if ($num_count2 >= 60) {
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

					echo '<li class="list-group-item d-flex justify-content-between"><span></span>';

					echo '<div class="btn-group w-100">';
					if ($percent_s == 100) {
						echo '<button class="certificate_export btn btn-sm btn-outline-success" data-purchase_id="'.$row_purchase['purchase_id'].'"><i class="bi bi-eye"></i> ดูใบประกาศ '.DateThai($row_purchase['course_pass_date']).'</button>';
					}else{
						echo '<button class="btn btn-sm btn-outline-danger"><i class="bi bi-eye-slash-fill"></i> ใบประกาศ</button>';
					}
					echo '<button class="admin_view btn btn-sm btn-outline-secondary"  data-student_id="' . $row_purchase['student_uid'] . '">ดูข้อมูล</button>';
					echo '</div>';

					echo '</li>';
					echo '</ul>';

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


		mysqli_close($conn);
	}





















?>