<?php 
session_start();
require "connect.php";
date_default_timezone_set('Asia/bangkok');


if (isset($_POST['course_add_modal'])) {
	$email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['sch_code']), ENT_QUOTES, 'UTF-8'));
	$method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method']), ENT_QUOTES, 'UTF-8'));
	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));

	if ($method == 'update') {
		$sql = "SELECT * FROM course WHERE id = '$id' ";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$course_code = $row['course_code'];
			$course_name = $row['course_name'];
			$course_level = $row['course_level'];
			$course_type = $row['course_type'];
			$course_adric = $row['course_adric'];
			$course_pass_percent = $row['course_pass_percent'];
			$course_status = $row['course_status'];
			$course_image_url = $row['course_image_url'];
		} 
	}

	?>

	<div class="modal-content">
		<div class="modal-header py-4">
			<h5 class="modal-title">เพิ่มหลักสูตรใหม่</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body m-0 py-0 my-0">

			<form id="course_Form">

				<input type="text" name="id" value="<?= $id ?>" readonly hidden>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="course_code" name="course_code" placeholder="" value="<?= $course_code ?>">
					<label for="">รหัสหลักสูตร</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="course_name" name="course_name" placeholder="" value="<?= $course_name ?>">
					<label for="">ชื่อหลักสูตร</label>
				</div>

				<div class="form-floating mb-3">
					<select class="form-select" id="course_level" name="course_level" aria-label="">
						<option value="" selected>เลือก</option>
						<option value="1" <?= ($course_level == 1)? 'selected':'' ; ?>>ชั้นปีที่ 1</option>
						<option value="2" <?= ($course_level == 2)? 'selected':'' ; ?>>ชั้นปีที่ 2</option>
						<option value="3" <?= ($course_level == 3)? 'selected':'' ; ?>>ชั้นปีที่ 3</option>
						<option value="4" <?= ($course_level == 4)? 'selected':'' ; ?>>ชั้นปีที่ 4</option>
						<option value="5" <?= ($course_level == 5)? 'selected':'' ; ?>>ยังไม่กำหนดชั้นปี</option>
					</select>
					<label for="">หลักสูตรสำหรับชั้นปี</label>
				</div>

				<div class="form-floating mb-3">
					<select class="form-select" id="course_type" name="course_type" aria-label="">
						<option value="" selected>เลือก</option>
						<option value="1" <?= ($course_type == 1)? 'selected':'' ; ?>>หลักสูตรกำหนด</option>
						<option value="2" <?= ($course_type == 2)? 'selected':'' ; ?>>หลักสูตรเลือก</option>
						<option value="3" <?= ($course_type == 3)? 'selected':'' ; ?>>ยังไม่กำหนด</option>	
					</select>
					<label for="">ประเภทหลักสูตร</label>
				</div>

				<div class="form-floating mb-3">
					<select class="form-select" id="course_adric" name="course_adric" aria-label="">
						<option value="" selected>เลือก</option>
						<option value="A" <?= ($course_adric == A)? 'selected':'' ; ?>>A</option>
						<option value="D" <?= ($course_adric == D)? 'selected':'' ; ?>>D</option>
						<option value="R" <?= ($course_adric == R)? 'selected':'' ; ?>>R</option>	
						<option value="I" <?= ($course_adric == I)? 'selected':'' ; ?>>I</option>	
						<option value="C" <?= ($course_adric == C)? 'selected':'' ; ?>>C</option>	
					</select>
					<label for="">ประเภท ADRIC</label>
				</div>

				<div class="form-floating mb-3">
					<select class="form-select" id="course_status" name="course_status" aria-label="">
						<option value="" selected>เลือก</option>
						<option value="1" <?= ($course_status == 1)? 'selected':'' ; ?>>แสดง นักศึกษา/Admin</option>
						<option value="2" <?= ($course_status == 2)? 'selected':'' ; ?>>แสดง Admin</option>
						<option value="3" <?= ($course_status == 3)? 'selected':'' ; ?>>ปิดแสดง</option>
					</select>
					<label for="">สถานะหลักสูตร</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="course_image_url" name="course_image_url" placeholder="" value="<?= $course_image_url ?>">
					<label for="">image_url หลักสูตร</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="course_pass_percent" name="course_pass_percent" placeholder="" value="<?= ($course_pass_percent == '') ? 80 : $course_pass_percent ?>" readonly>
					<label for="">% ผ่านหลักสูตร</label>
				</div>

			</form>


		</div>
		<div class="modal-footer">
			<?php if ($method == 'insert'): ?>
				<button type="button" class="btn btn-success" id="save_course"><i class="bi bi-pen"></i>บันทึก</button>
			<?php endif ?>
			<?php if ($method == 'update'): ?>
				<button type="button" class="btn btn-warning" id="update_course"><i class="bi bi-pencil-square"></i>แก้ไข</button>	
			<?php endif ?>
			<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
		</div>
	</div>

	<?php
}

if (isset($_POST['course_modal_trash'])) {

	?>

	<div class="modal-content">
		<div class="modal-header py-4">
			<h5 class="modal-title">หลักสูตร</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body m-0 py-0 my-0">

			<div id="table_course_trash"></div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
		</div>
	</div>

	<?php
}





if (isset($_POST['get_table_course'])) {
	$year = $_POST['year'];

	$sql = "SELECT * FROM course WHERE course_delete = '0' AND course_level = '$year' ORDER BY course_type DESC ";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo '<div class="row">';

		while ($row = mysqli_fetch_assoc($result)) {

			$rn = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_video WHERE course_uid = '".$row['course_id']."' "));

			$course_level_bg = '';
			switch ($row['course_level']) {
				case 1:
				$course_level_bg = 'style="background-color: #cfe2f3"';
				break;
				case 2:
				$course_level_bg = 'style="background-color: #ead1dc"';
				break;
				case 3:
				$course_level_bg = 'style="background-color: #fff2cc"';
				break;
				case 4:
				$course_level_bg = 'style="background-color: #d9ead3"';
				break;
				case 5:
				$course_level_bg = 'style="background-color: #b4a7d6"';
				break;
				default:
				$course_level_bg = 'style="background-color: #fce5cd"';
				$statusText2 = '';
			}

			$course_type_badge = '';
			$course_type_text = '';
			switch ($row['course_type']) {
				case 1:
				$course_type_badge = 'bg-danger';
				$course_type_text = 'กำหนด';
				break;
				case 2:
				$course_type_badge = 'bg-info';
				$course_type_text = 'เลือก';
				break;
				case 3:
				$course_type_badge = 'bg-dark';
				$course_type_text = 'ยังไม่กำหนด';
				break;
				default:
				$course_type_badge = 'bg-secondary';
				$course_type_text = '';
			}

			$course_status_bg = '';
			$course_status_text = '';
			switch ($row['course_status']) {
				case 1:
				$course_status_bg = 'bg-info';
				$course_status_text = 'นักศึกษา/Admin';
				break;
				case 2:
				$course_status_bg = 'bg-dark';
				$course_status_text = 'Admin only';
				break;
				case 3:
				$course_status_bg = 'bg-danger';
				$course_status_text = 'ปิดแสดง';
				break;
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

			echo '<div class="col-md-3 col-12 mb-3">';
			echo '<div class="course-box" style=" display: flex; flex-direction: column; height: 100%;">
			<div class="product" style=" display: flex; flex-direction: column; height: 100%;">
			<div class="course-sub-box" style=" display: flex; flex-direction: column; height: 100%;">
			<div class="product-img">
			<a>
			<img class="img-fluid" alt="" src="' . (($row['course_image_url'] == null or $row['course_image_url'] == '') ? 'assets/img/course/img-07.jpg' : $row['course_image_url']) . '" width="600" height="300">
			</a>
			<div class="book-mark">
			<i class="far fa-bookmark"></i>
			</div>
			</div>
			<div class="product-content">
			<div class="blog-view-list d-flex">
			<div class="blog-admin-view">
			<p><i class="fas fa-book"></i> <span>'.$rn.' Lessons</span></p>
			</div>
			<p><span class="badge '.$course_type_badge.'">'.$course_type_text.'</span></p>
			</div>
			<h3 class="title">
			<a href="">รหัสหลักสูตร: ' . $row['course_code'] . '</a>
			<p class="card-text flex-grow-1">หลักสูตร: ' . $row['course_name'] . '</p>
			</h3>
			<div class="course-info d-flex align-items-center">
			<div class="rating-img d-flex align-items-center">
			<img src="assets/img/user/user2.jpg" alt="">
			<h4>' . $course_level_text . '</h4>
			</div>
			<div class="course-view d-flex align-items-center">
			<div class="graduate-point">
			<span>10</span>
			</div>  
			<i class="fas fa-user-graduate"></i>
			</div>
			</div>
			</div>
			</div>
			<div class="author-join d-flex justify-content-between" '.$course_level_bg.'>
			<div class="course-price">
			-
			</div>
			<span class="badge ' . $course_status_bg . ' h6">' . $course_status_text . '</span>
			</div>
			<div class="author-join d-flex align-items-center">';

			echo '<div class="btn-group" role="group">';
			echo '<button class="btn_course_update btn btn-sm btn-warning text-dark" data-id='.$row['id'].' data-method="update"><i class="bi bi-pencil-square"></i> แก้ไข</button>';
			echo '<button class="btn_course_trash btn btn-sm btn-danger active" data-id='.$row['id'].'><i class="bi bi-trash2-fill"></i> ย้าย</button>';
			echo '<button class="btn_course_video btn btn-sm btn-primary" data-id='.$row['id'].' data-course_id='.$row['course_id'].'><i class="bi bi-camera-video-fill"></i>&nbsp;เพิ่ม Video</button>';
			echo '<button class="btn_course_certificate btn btn-sm" data-id='.$row['id'].' data-course_id='.$row['course_id'].' style="background-color: #a084ba ; color: #FFFFFF;"><i class="bi bi-award-fill"></i>&nbsp;certificate</button>';
			
			if ($_SESSION['cmuitaccount'] == 'atthaphan.j@cmu.ac.th') {
			}
			

			echo '</div>';
			
			echo '</div>
			</div>
			</div>';
			echo '</div>';
		}

        echo '</div>'; // Close the row
    } else {
    	echo "No course found";
    }

    mysqli_close($conn);
}


if (isset($_POST['get_table_course_trash'])) {
	$edu_id = $_POST['edu_id'];

	$sql = "SELECT * FROM course WHERE course_delete = '1' ";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo '<div class="row">';

		while ($row = mysqli_fetch_assoc($result)) {
			echo '<div class="col-md-6 col-12 mb-3">';
			echo '<div class="card h-100 d-flex flex-column bg-light shadow">';
			echo '<div class="card-body d-flex flex-column">';
			echo '<h5 class="card-title">รหัสหลักสูตร: ' . $row['course_code'] . '</h5>';
			echo '<p class="card-text flex-grow-1">หลักสูตร: ' . $row['course_name'] . '</p>';

			echo '<div class="btn-group" role="group" aria-label="Course Actions">';
			echo '<button class="btn_course_trash btn btn-sm btn-success p-0" data-id='.$row['id'].' data-method="back"><i class="bi bi-trash2-fill"></i> ย้ายกลับ</button>';
			echo '<button class="btn_course_delete btn btn-sm btn-danger p-0" data-id='.$row['id'].' data-method="delete"><i class="bi bi-trash3-fill"></i> ลบ</button>';
			echo '</div>';

			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

        echo '</div>'; // Close the row
    } else {
    	echo "No course found";
    }

    mysqli_close($conn);
}


if (isset($_POST['save_course'])) {

	$course_code = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_code']), ENT_QUOTES, 'UTF-8'));
	$course_name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_name']), ENT_QUOTES, 'UTF-8'));
	$course_level = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_level']), ENT_QUOTES, 'UTF-8'));
	$course_type = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_type']), ENT_QUOTES, 'UTF-8'));
	$course_adric = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_adric']), ENT_QUOTES, 'UTF-8'));
	$course_pass_percent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_pass_percent']), ENT_QUOTES, 'UTF-8'));
	$course_status = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_status']), ENT_QUOTES, 'UTF-8'));
	$course_image_url = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_image_url']), ENT_QUOTES, 'UTF-8'));


	$sql = "SELECT MAX(id) AS max_course_id FROM course";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$maxcourse = $row['max_course_id']+1;
	}else{
		$maxcourse = 1;
	}

	$date = date("YmdHis");
	$course_id = 'c'.$date.$maxcourse;


	$query = "INSERT INTO course (course_id, course_code, course_name, course_level, course_type, course_adric, course_image_url, course_status, course_pass_percent) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssssssss", $course_id, $course_code, $course_name, $course_level, $course_type, $course_adric, $course_image_url, $course_status, $course_pass_percent);
	$stmt->execute();


	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล inserted successfully'
		];
		echo json_encode($res);
		return;
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ insert ข้อมูล'
		];
		echo json_encode($res);
		return;
	}

	$stmt->close();
}




if (isset($_POST['update_course'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$course_code = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_code']), ENT_QUOTES, 'UTF-8'));
	$course_name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_name']), ENT_QUOTES, 'UTF-8'));
	$course_level = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_level']), ENT_QUOTES, 'UTF-8'));
	$course_type = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_type']), ENT_QUOTES, 'UTF-8'));
	$course_adric = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_adric']), ENT_QUOTES, 'UTF-8'));
	$course_pass_percent = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_pass_percent']), ENT_QUOTES, 'UTF-8'));
	$course_status = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_status']), ENT_QUOTES, 'UTF-8'));
	$course_image_url = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_image_url']), ENT_QUOTES, 'UTF-8'));

	$query = "UPDATE course SET course_code=?, course_name=?, course_level=?, course_type=?, course_adric=?, course_image_url=?, course_status=?, course_pass_percent=? WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssssssss", $course_code, $course_name, $course_level, $course_type, $course_adric, $course_image_url, $course_status, $course_pass_percent, $id);
	$stmt->execute();


	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล updated successfully',
			'id' => $id
		];
		echo json_encode($res);
		return;
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ update ข้อมูล'
		];
		echo json_encode($res);
		return;
	}

	$stmt->close();

}


if (isset($_POST['delete_course'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));

	$query = "DELETE FROM course WHERE id=?";
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


if (isset($_POST['trash_course'])) {
	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method']), ENT_QUOTES, 'UTF-8'));

	if ($method == 'back') {
		$course_delete = 0;
	}else{
		$course_delete = 1;
	}

	$query = "UPDATE course SET course_delete=? WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("is", $course_delete, $id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล deleted successfully',
			'id' => $id
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







if (isset($_POST['course_modal_video'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));


	$sql = "SELECT * FROM course WHERE id = '$id' ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		//echo "course found";
	} else {
		echo "No course found";
	}

	echo '<div class="row">';
	while ($row = mysqli_fetch_assoc($result)) {
		$course_id = $row['course_id'];
		echo '<div class="col-md-12 col-12">'.
		'<div class="card h-100 d-flex flex-column bg-light py-0">'.
		'<div class="card-body d-flex flex-column pb-0">'.
		'<h5 class="card-title py-0 my-0">รหัสหลักสูตร: ' . $row['course_code'] . ' หลักสูตร: ' . $row['course_name'] . '</h5>'.
		'</div>'.
		'</div>'.
		'</div>';
	}
	echo '</div>';

	echo '<div class="row mx-2">';
	echo '<div class="col-6">';
	echo '<button class="btn_video_add btn btn-sm btn-success mb-2" data-course_id='.$course_id.' data-method="insert"><i class="bi bi-plus-lg"></i>&nbsp;เพิ่ม Video</button>';

	echo '<div id="loader1" class="loader"></div>';
	echo '<div id="course_video"></div>';



	echo '</div>';
	echo '<div class="col-6">';
	echo 'Question';

	echo '<div id="loader2" class="loader"></div>';
	echo '<div id="video_question"></div>';




	echo '</div>';
	echo '</div>';

	mysqli_close($conn);
}





if (isset($_POST['get_course_video'])) {

	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));

	$apiKey = 'AIzaSyBTadgnq5szgDxIE0D1i_oDixTJebJqnb4';
	$sql3 = "SELECT * FROM course_video where course_uid = '$course_id' ORDER BY video_head ASC ";
	$result3 = $conn->query($sql3);

	if ($result3->num_rows > 0) {
		//echo $result3->num_rows;
	} else {
		echo 'ยังไม่มี video';
	}

	function formatDuration($duration) {
		$interval = new DateInterval($duration);
		return $interval->format('%I:%S');
	}

	function truncateText($text, $maxChars) {
		if (strlen($text) > $maxChars) {
			$truncatedText = mb_substr($text, 0, $maxChars - 3) . '...';
		} else {
			$truncatedText = $text;
		}
		return $truncatedText;
	}

	while ($row3 = $result3->fetch_assoc()) {
		$videoId = $row3['video_url'];

		$apiEndpoint = 'https://www.googleapis.com/youtube/v3/videos';
		$requestUrl = $apiEndpoint . '?part=snippet,contentDetails,statistics&id=' . $videoId . '&key=' . $apiKey;
		$apiResponse = file_get_contents($requestUrl);

		if ($apiResponse === false) {
			die('Failed to fetch data from YouTube API');
		}

		$apiData = json_decode($apiResponse, true);

		if (isset($apiData['error'])) {
			die('YouTube API error: ' . $apiData['error']['message']);
		}

		$videoDetails = $apiData['items'][0];

		$isActiveClass = ($id == $row3['id']) ? 'bg-warning text-dark' : '';
		$duration = $videoDetails['contentDetails']['duration'];
		$truncatedTitle = truncateText($videoDetails['snippet']['title'], 60);

		echo '<div class="card mb-1 ' . $isActiveClass . '">';
		echo '<div class="row g-0">';
		echo '<div class="col-md-4 position-relative">';
		echo '<img src="https://img.youtube.com/vi/' . $videoDetails['id'] . '/maxresdefault.jpg" class="img-fluid rounded-2" alt="Video Thumbnail">';
		echo '<div class="play-overlay"><i class="bi bi-play">'.$row3['video_head'].'</i></div>';
		echo '<div class="duration-overlay">' . formatDuration($duration) . '</div>';

		echo '</div>';
		echo '<div class="col-md-8">';
		echo '<div class="card-body m-0 p-2">';
		echo '<small class="card-title m-0 p-0 li08">' . $truncatedTitle . '</small><br>';
		echo '<small class="m-0 p-0 fs-14">Views: ' . $videoDetails['statistics']['viewCount'] . '</small><br>';
		echo '<div class="btn-group">';
		echo '<button class="btn_video_edit btn btn-sm btn-success p-1" data-id='.$row3['id'].' data-course_id='.$course_id.' data-method="update"><i class="bi bi-pencil-square"></i>&nbsp;แก้ไข</button>';
		echo '<button class="btn_video_delete btn btn-sm btn-danger p-1" data-id='.$row3['id'].' data-course_id='.$row3['course_uid'].'><i class="bi bi-trash3-fill"></i>&nbsp;ลบ</button>';
		echo '<button class="btn_video_question btn btn-sm btn-warning text-dark p-1" data-id='.$row3['id'].' data-course_id='.$row3['course_uid'].' data-video_question_id='.$row3['video_question_id'].'><i class="bi bi-pen"></i>&nbsp;จัดการคำถาม</button>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	mysqli_close($conn);
}






if (isset($_POST['modal_video_detail'])) {
	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method']), ENT_QUOTES, 'UTF-8'));

	if ($method == 'update') {
		$sql = "SELECT * FROM course_video WHERE id = '$id' ";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$id = $row['id'];
			$video_id = $row['video_id'];
			$video_url = $row['video_url'];
			$video_name = $row['video_name'];
			$video_head = $row['video_head'];
			$question_submit_time = $row['question_submit_time'];
		} 
	}

	function secondsToTimeFormat($seconds) {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds % 3600) / 60);
		return gmdate("H:i:s", $seconds);
	}

	?>

	<div class="modal-content">
		<div class="modal-header py-4">
			<h5 class="modal-title">เพิ่ม Video</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body m-0 py-0 my-0">

			<form id="video_Form">

				<input type="text" name="id" value="<?= $id ?>" readonly hidden>
				<input type="text" name="course_id" value="<?= $course_id ?>" readonly hidden>
				<input type="text" name="method" value="<?= $method ?>" readonly hidden>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="video_url" name="video_url" placeholder="" value="<?= $video_url ?>">
					<label for="">video_url</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="video_name" name="video_name" placeholder="" value="<?= $video_name ?>">
					<label for="">ชื่อ video</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="video_head" name="video_head" placeholder="" value="<?= $video_head ?>">
					<label for="">ลำดับ video</label>
				</div>

				<div class="form-floating">
					<input type="text" class="form-control" id="question_submit_time" name="question_submit_time" placeholder="" value="<?= secondsToTimeFormat($question_submit_time) ?>" <?= ($method == 'insert')? 'readonly':'' ; ?>>
					<label for="">เวลาสิ้นสุด (ชั่วโมง:นาที:วินาที)</label>
				</div>
			</form>


		</div>
		<div class="modal-footer">
			<?php if ($method == 'insert'): ?>
				<button type="button" class="btn btn-success" id="save_video"><i class="bi bi-pen"></i>บันทึก</button>
			<?php endif ?>
			<?php if ($method == 'update'): ?>
				<button type="button" class="btn btn-warning" id="update_video"><i class="bi bi-pencil-square"></i>แก้ไข</button>	
			<?php endif ?>
			<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
		</div>
	</div>

	<?php
}



if (isset($_POST['save_video'])) {

	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$video_url = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_url']), ENT_QUOTES, 'UTF-8'));
	$video_name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_name']), ENT_QUOTES, 'UTF-8'));
	$video_head = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_head']), ENT_QUOTES, 'UTF-8'));
	$question_submit_time = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['question_submit_time']), ENT_QUOTES, 'UTF-8'));

	$sql = "SELECT MAX(id) AS max_video_id FROM course_video";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$max_video_id = $row['max_video_id']+1;
	}else{
		$max_video_id = 1;
	}
	$date = date("YmdHis");
	$video_id = 'v'.$date.$max_video_id;



	$apiKey = 'AIzaSyBTadgnq5szgDxIE0D1i_oDixTJebJqnb4';

	function durationToSeconds($duration) {
		$interval = new DateInterval($duration);
		return $interval->s + $interval->i * 60 + $interval->h * 3600;
	}

	$videoId = $video_url;

	$apiEndpoint = 'https://www.googleapis.com/youtube/v3/videos';
	$requestUrl = $apiEndpoint . '?part=snippet,contentDetails,statistics&id=' . $videoId . '&key=' . $apiKey;
	$apiResponse = file_get_contents($requestUrl);

	if ($apiResponse === false) {
		die('Failed to fetch data from YouTube API');
	}

	$apiData = json_decode($apiResponse, true);

	if (isset($apiData['error'])) {
		die('YouTube API error: ' . $apiData['error']['message']);
	}
	$videoDetails = $apiData['items'][0];
	$duration = $videoDetails['contentDetails']['duration'];
	$duration = durationToSeconds($duration) - 10;

	$video_question_id = 'vq'.$date.$maxcourse;

	$query = "INSERT INTO course_video (course_uid, video_id, video_url, video_name, video_head, video_question_id, question_submit_time) VALUES (?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssssss",$course_id, $video_id, $video_url, $video_name, $video_head,$video_question_id, $duration);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล inserted successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ insert ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}




if (isset($_POST['update_video'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$video_url = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_url']), ENT_QUOTES, 'UTF-8'));
	$video_name = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_name']), ENT_QUOTES, 'UTF-8'));
	$video_head = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_head']), ENT_QUOTES, 'UTF-8'));
	$question_submit_time = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['question_submit_time']), ENT_QUOTES, 'UTF-8'));

	$timeString = $question_submit_time;
	$question_submit_time = strtotime($timeString) - strtotime('00:00:00');

	$query = "UPDATE course_video SET video_url=?, video_name=?, video_head=?, question_submit_time=? WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssss", $video_url, $video_name, $video_head, $question_submit_time, $id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล updated successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ update ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}



if (isset($_POST['delete_video'])) {
	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));

	$DeleteVideoQuestions = "DELETE FROM video_questions WHERE question_id IN (SELECT video_question_id FROM course_video WHERE id = ?)";
	$stmtDQuestions = $conn->prepare($DeleteVideoQuestions);
	$stmtDQuestions->bind_param("s", $id);
	$stmtDQuestions->execute();
	$stmtDQuestions->close();

	$query = "DELETE FROM course_video WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล deleted successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ delete ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}





if (isset($_POST['get_video_question'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$video_question_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_question_id']), ENT_QUOTES, 'UTF-8'));

	echo '<button class="btn_question_add btn btn-sm btn-success mb-2" 
	data-id='.$id.' data-course_id='.$course_id.' data-video_question_id="'.$video_question_id.'"
	data-method="insert"><i class="bi bi-plus-lg"></i>&nbsp;เพิ่มคำถาม</button>';


	$sql_video = "SELECT * FROM course_video WHERE video_question_id = '$video_question_id'";
	$result_video = $conn->query($sql_video);

	if ($result_video->num_rows == 1) {
		$row1 = $result_video->fetch_assoc();
		echo '<p>Video: '.$row1['video_head'].'</p>';
	}else{
		echo 'ไม่พบ Video';
	}

	function secondsToTimeFormat($seconds) {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds % 3600) / 60);
		return gmdate("H:i:s", $seconds);
	}

	$sql = "SELECT * FROM video_questions WHERE video_question_uid = '$video_question_id' ";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo '<div class="row"  style="margin-bottom: 100px;">';

		while ($row = mysqli_fetch_assoc($result)) {



			echo '<div class="col-md-12 col-12 mb-3">';
			echo '<div class="card h-100 d-flex flex-column">';
			echo '<div class="card-body d-flex flex-column p-1">';
			echo '<h6 class="">(' . secondsToTimeFormat($row['time_show'] ) . ')</h6>';
			echo '<h6 class="card-title">'.$row['question_num'].'. ' . $row['question'] . '</h6>';
			$cAnswer = $row{'option'.$row['correctAnswer']};
			echo '<h6 class="card-title text-success"> Answer: ' . trim(explode(',', $cAnswer)[1]). '</h6>';

			echo '<div class="btn-group mx-5" role="group">';
			echo '<button class="btn_question_edit btn btn-sm btn-success p-0" data-id='.$row['id'].' data-course_id="'.$course_id.'" data-question_id="'.$row['question_id'].'" data-video_question_id="'.$row['video_question_uid'].'" data-method="update"><i class="bi bi-pencil-square"></i>&nbsp;แก้ไข</button>';
			echo '<button class="btn_question_copy btn btn-sm btn-secondary p-0" data-id='.$row['id'].' data-course_id="'.$course_id.'" data-question_id="'.$row['question_id'].'" data-video_question_id="'.$row['video_question_uid'].'" data-method="copy"><i class="bi bi-pencil-square"></i>&nbsp;Copy</button>';
			echo '<button class="btn_question_delete btn btn-sm btn-danger p-0" data-id='.$row['id'].' data-course_id="'.$course_id.'" data-question_id="'.$row['question_id'].'" data-video_question_id="'.$row['video_question_uid'].'" data-method="delete"><i class="bi bi-trash3-fill"></i> ลบ</button>';
			echo '</div>';

			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		echo '</div>';
	} else {
		echo "<br> No questions found";
	}


	mysqli_close($conn);
}





if (isset($_POST['modal_question'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method']), ENT_QUOTES, 'UTF-8'));
	$video_question_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_question_id']), ENT_QUOTES, 'UTF-8'));

	if ($method == 'update') {
		$sql = "SELECT * FROM video_questions WHERE id = '$id' ";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$id = $row['id'];
			$question_id = $row['question_id'];
			$question_num = $row['question_num'];
			$question = $row['question'];
			$option1 = trim(explode(',', $row['option1'])[1]);
			$option2 = trim(explode(',', $row['option2'])[1]);
			$option3 = trim(explode(',', $row['option3'])[1]);
			$option4 = trim(explode(',', $row['option4'])[1]);
			$correctAnswer = $row['correctAnswer'];
			$time_show = $row['time_show'];
		} 
	}

	function secondsToTimeFormat($seconds) {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds % 3600) / 60);
		return gmdate("H:i:s", $seconds);
	}

	$seconds = $time_show;
	$time_show = secondsToTimeFormat($seconds);

	if ($method == 'insert') {
		$sql1 = "SELECT COUNT(*) + 1 AS next_row_count FROM video_questions WHERE video_question_uid = '$video_question_id' ";
		$result1 = mysqli_query($conn, $sql1);
		if ($result1) {
			$row1 = mysqli_fetch_assoc($result1);
			$question_num = $row1['next_row_count'];
		} else {
			$question_num = 1;
		}

	}

	?>

	<div class="modal-content">
		<div class="modal-header py-4">
			<h5 class="modal-title">คำถาม</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body py-0 my-0">

			<form id="question_Form">

				<input type="text" name="id" value="<?= $id ?>" readonly hidden >
				<input type="text" name="course_id" value="<?= $course_id ?>" readonly hidden>
				<input type="text" name="video_question_id" value="<?= $video_question_id ?>" readonly hidden>
				<input type="text" name="method" value="<?= $method ?>" readonly hidden>

				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="question_num" name="question_num" placeholder="" value="<?= $question_num ?>"><label for="">ลำดับคำถาม</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="question" name="question" placeholder="" value="<?= $question ?>">
					<label for="">คำถาม</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="option1" name="option1" placeholder="" value="<?= $option1 ?>">
					<label for="">คำตอบที่1</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="option2" name="option2" placeholder="" value="<?= $option2 ?>">
					<label for="">คำตอบที่2</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="option3" name="option3" placeholder="" value="<?= $option3 ?>">
					<label for="">คำตอบที่3</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="option4" name="option4" placeholder="" value="<?= $option4 ?>">
					<label for="">คำตอบที่4</label>
				</div>

				<div class="form-floating mb-3">
					<select class="form-select" id="correctAnswer" name="correctAnswer">
						<option value="" selected>เลือกคำตอบที่ถูกต้อง</option>
						<option value="1" <?= ($correctAnswer == 1)? 'selected':'' ; ?>>1</option>
						<option value="2" <?= ($correctAnswer == 2)? 'selected':'' ; ?>>2</option>
						<option value="3" <?= ($correctAnswer == 3)? 'selected':'' ; ?>>3</option>
						<option value="4" <?= ($correctAnswer == 4)? 'selected':'' ; ?>>4</option>
					</select>
					<label for="">คำตอบที่ถูกต้อง</label>
				</div>

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="time_show" name="time_show" placeholder="" value="<?= $time_show ?>">
					<label for="">เวลาที่แสดง (ชั่วโมง:นาที:วินาที)</label>
				</div>

			</form>


		</div>
		<div class="modal-footer">
			<?php if ($method == 'insert'): ?>
				<button type="button" class="btn btn-success" id="save_question"><i class="bi bi-pen"></i>บันทึก</button>
			<?php endif ?>
			<?php if ($method == 'update'): ?>
				<button type="button" class="btn btn-warning" id="update_question"><i class="bi bi-pencil-square"></i>แก้ไข</button>	
			<?php endif ?>
			<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
		</div>
	</div>

	<?php
}



if (isset($_POST['save_question'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method']), ENT_QUOTES, 'UTF-8'));
	$video_question_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_question_id']), ENT_QUOTES, 'UTF-8'));

	$question_num = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['question_num']), ENT_QUOTES, 'UTF-8'));
	$question = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['question']), ENT_QUOTES, 'UTF-8'));
	$option1 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option1']), ENT_QUOTES, 'UTF-8'));
	$option2 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option2']), ENT_QUOTES, 'UTF-8'));
	$option3 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option3']), ENT_QUOTES, 'UTF-8'));
	$option4 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option4']), ENT_QUOTES, 'UTF-8'));
	$correctAnswer = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['correctAnswer']), ENT_QUOTES, 'UTF-8'));
	$time_show = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['time_show']), ENT_QUOTES, 'UTF-8'));

	$timeString = $time_show;
	$time_show = strtotime($timeString) - strtotime('00.00');

	$option1 = '1,' . $option1;
	$option2 = '2,' . $option2;
	$option3 = '3,' . $option3;
	$option4 = '4,' . $option4;

	$sql = "SELECT MAX(id) AS max_question FROM video_questions";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		$max_question = $row['max_question']+1;
	}else{
		$max_question = 1;
	}
	$date = date("YmdHis");
	$question_id = 'q'.$date.$max_question;


	$query = "INSERT INTO video_questions (video_question_uid, question_id, question_num, question, option1, option2, option3, option4, correctAnswer, time_show) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ssssssssss", $video_question_id, $question_id, $question_num, $question, $option1, $option2, $option3, $option4, $correctAnswer, $time_show);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล inserted successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ insert ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}


if (isset($_POST['update_question'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));

	//$question_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_question_id']), ENT_QUOTES, 'UTF-8'));
	$question_num = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['question_num']), ENT_QUOTES, 'UTF-8'));
	$question = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['question']), ENT_QUOTES, 'UTF-8'));
	$option1 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option1']), ENT_QUOTES, 'UTF-8'));
	$option2 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option2']), ENT_QUOTES, 'UTF-8'));
	$option3 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option3']), ENT_QUOTES, 'UTF-8'));
	$option4 = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['option4']), ENT_QUOTES, 'UTF-8'));
	$correctAnswer = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['correctAnswer']), ENT_QUOTES, 'UTF-8'));
	$time_show = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['time_show']), ENT_QUOTES, 'UTF-8'));

	$option1 = '1,' . $option1;
	$option2 = '2,' . $option2;
	$option3 = '3,' . $option3;
	$option4 = '4,' . $option4;

	$timeString = $time_show;
	$time_show = strtotime($timeString) - strtotime('00:00');

	$query = "UPDATE video_questions SET question_num=?, question=?, option1=?, option2=?, option3=?, option4=?, correctAnswer=?, time_show=? WHERE id=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssssssss", $question_num, $question, $option1, $option2, $option3, $option4, $correctAnswer, $time_show, $id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล updated successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ update ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}






if (isset($_POST['delete_question'])) {
	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));

	$query = "DELETE FROM video_questions WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล deleted successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ delete ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}




if (isset($_POST['copy_question'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$method = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['method']), ENT_QUOTES, 'UTF-8'));
	$question_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_question_id']), ENT_QUOTES, 'UTF-8'));

	$sql1 = "SELECT COUNT(*) + 1 AS next_row_count FROM video_questions WHERE question_id = '$question_id' ";
	$result1 = mysqli_query($conn, $sql1);
	if ($result1) {
		$row1 = mysqli_fetch_assoc($result1);
		$question_num = $row1['next_row_count']+1;
	}

	$query = "INSERT INTO video_questions (video_question_uid, question_id, question_num, question, option1, option2, option3, option4, correctAnswer, time_show) 
	SELECT  video_question_uid, question_id, ? , question, option1, option2, option3, option4, correctAnswer, time_show
	FROM video_questions 
	WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss", $question_num, $id);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		$res = [
			'status' => 200,
			'message' => 'ข้อมูล inserted successfully'
		];
		echo json_encode($res);
	} else {
		$res = [
			'status' => 500,
			'message' => 'เกิดข้อผิดพลาดในการ insert ข้อมูล'
		];
		echo json_encode($res);
	}

	$stmt->close();
}







if (isset($_POST['modal_certificate'])) {

	$id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8'));
	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));

	$sql = "SELECT * FROM course WHERE id = '$id' ";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$course_id = $row['course_id'];
		$course_code = $row['course_code'];
		$course_name = $row['course_name'];
		$course_level = $row['course_level'];
		$course_type = $row['course_type'];
		$course_status = $row['course_status'];
		$course_image_url = $row['course_image_url'];
		$certificate_set_name_updown = $row['certificate_set_name_updown'];
		$certificate_set_name_leftright = $row['certificate_set_name_leftright'];
		$certificate_set_name_size = $row['certificate_set_name_size'];
		$certificate_set_date_updown = $row['certificate_set_date_updown'];
		$certificate_set_date_leftright = $row['certificate_set_date_leftright'];
		$certificate_set_date_size = $row['certificate_set_date_size'];
		$certificate_set_code_updown = $row['certificate_set_code_updown'];
		$certificate_set_code_leftright = $row['certificate_set_code_leftright'];
		$certificate_set_code_size = $row['certificate_set_code_size'];
	} 
	?>

	<div class="modal-content">
		<div class="modal-header py-4">
			<h5 class="modal-title">certificate (<?= $course_code ?>) <?= $course_name ?></h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body py-0 my-0">

			<div class="row">
				<div class="col-md-6">
					<div>

						<form id="uploadForm" enctype="multipart/form-data">
							<label for="formFileLg" class="form-label">แนบพื้นหลัง ใบประกาศ</label>
							<input class="form-control form-control-lg file" id="" name="file" type="file">
							<input type="text" id="course_id" name="course_id" value="<?= $course_id ?>" hidden>
						</form>

						<div id="uploadStatus"></div>

					</div>
				</div>
				<div class="col-md-6">

				</div>
			</div>
			
			<form id="form_certificate">

				<div class="row">
					<div class="col-md-6">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="name" name="name" value="นายสมมุติ นามสมมุติ">
							<label>ชื่อทดสอบ</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_name_updown" name="certificate_set_name_updown" value="<?= $certificate_set_name_updown ?>" min="0" max="300" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>บน-ล่าง</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_name_leftright" name="certificate_set_name_leftright" value="<?= $certificate_set_name_leftright ?>" min="0" max="500" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>ซ้าย-ขวา</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_name_size" name="certificate_set_name_size" value="<?= $certificate_set_name_size ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>ขนาดตัวอักษร</label>
						</div>
					</div>


				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-floating mb-3">
							<input type="date" class="form-control" id="certificate_date" name="certificate_date" value="<?= date('Y-m-d') ?>">
							<label>วันที่</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_date_updown" name="certificate_set_date_updown" value="<?= $certificate_set_date_updown ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>บน-ล่าง</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_date_leftright" name="certificate_set_date_leftright" value="<?= $certificate_set_date_leftright ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>ซ้าย-ขวา</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_date_size" name="certificate_set_date_size" value="<?= $certificate_set_date_size ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>ขนาดตัวอักษร</label>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="code" name="code" value="CR<?= $course_code ?>662102009999">
							<label>รหัสใบประกาศ</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_code_updown" name="certificate_set_code_updown" value="<?= $certificate_set_code_updown ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>บน-ล่าง</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_code_leftright" name="certificate_set_code_leftright" value="<?= $certificate_set_code_leftright ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>ซ้าย-ขวา</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-floating mb-3">
							<input type="number" class="form-control edit_certificate" id="certificate_set_code_size" name="certificate_set_code_size" value="<?= $certificate_set_code_size ?>" data-course_id="<?= $course_id ?>" style="text-align: center;">
							<label>ขนาดตัวอักษร</label>
						</div>
					</div>
				</div>

			</form>

			<div id="certificate_img"></div>

			<div class="text-center">
				<button class="btn_certificate btn btn-lg btn-outline-danger p-3 btn-rounded" 
				data-course_id="<?= $course_id ?>"
				><i class="bi bi-file-earmark-pdf-fill fa-lg"></i> ดู certificate</button>
			</div>


		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
		</div>
	</div>

	<?php
}



if (isset($_POST['upload_file'])) {
	$targetDir = "upload_img/";

    // Valid file extensions
	$allowedExtensions = array('png', 'jpg', 'jpeg');

    // Sanitize the file name
	$fileName = basename($_FILES["file"]["name"]);
	$fileName = preg_replace("/[^a-zA-Z0-9_.-]/", "", $fileName);

    // Get file extension
	$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Check if the file extension is allowed
	if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
		echo "Sorry, only PNG, JPG, and JPEG files are allowed.";
        exit; // Stop further execution
    }

    // Generate random number
    $randomNumber = rand(100000, 999999); // Generate a random 4-digit number

    // Remove unwanted characters from the file name
    $fileName = pathinfo($fileName, PATHINFO_FILENAME);

    // Append random number and file extension to file name
    $fileName = $fileName . "_" . $randomNumber . "." . $fileExtension;

    // Create the full path to the target file
    $targetFile = $targetDir . $fileName;
    $uploadOk = true;

    // Check if the directory exists, if not, create it with permissions 775
    if (!file_exists($targetDir)) {
    	mkdir($targetDir, 0775, true);
    }

    // If upload is successful, move the file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
    	echo "The file " . $fileName . " has been uploaded.";

        // Additional data from form inputs
    	$course_id = $_POST['course_id'];

        // Fetch previous certificate file name from the database
    	$stmt = $conn->prepare("SELECT course_certificate FROM course WHERE course_id = ?");
    	$stmt->bind_param("s", $course_id);
    	$stmt->execute();
    	$stmt->bind_result($previousCertificate);
    	$stmt->fetch();
    	$stmt->close();

        // Delete previous certificate file if exists
    	if ($previousCertificate && file_exists($targetDir . $previousCertificate)) {
    		unlink($targetDir . $previousCertificate);
    	}

        // Update database with new file information and additional data
    	$stmt = $conn->prepare("UPDATE course SET course_certificate=? WHERE course_id = ?");
    	$stmt->bind_param("ss", $fileName, $course_id);

    	if ($stmt->execute()) {
    		echo "File upload success";
    	} else {
    		echo "Error updating database: " . $conn->error;
    	}

        // Close statement
    	$stmt->close();
    } else {
    	echo "Sorry, there was an error uploading your file.";
    }
}



if(isset($_POST['edit_certificate'])) {

	$id = $_POST['id'];
	$value = $_POST['value'];
	$column_name = $_POST['column_name'];
	$db = $_POST['db'];

	$sql = "UPDATE $db SET $column_name = ? WHERE course_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $value, $id);

	if($stmt->execute()) {
        //echo "Update successful";
	} else {
        //echo "Update failed: " . $stmt->error;
	}
	$stmt->close();
}

if(isset($_POST['certificate_img'])) {
	$course_id = $_POST['course_id'];

	$sql_video = "SELECT * FROM course WHERE course_id = '$course_id'";
	$result_video = $conn->query($sql_video);

	if ($result_video->num_rows == 1) {
		$row1 = $result_video->fetch_assoc();
		echo '<div class="text-center"><img src="../assets/php/upload_img/'.$row1['course_certificate'].'" width="30%"></div>';
	}else{
		echo 'ไม่พบ Certificate';
	}

}



























?>







