<?php 
session_start();
require "connect.php";
date_default_timezone_set('Asia/bangkok');




// if (isset($_POST['get_course'])) {
// 	$year = $_POST['year'];

// 	if ($year == 0) {
// 		$sql = "SELECT * FROM course WHERE course_delete = 0 ORDER BY course_level DESC";
// 	}else{
// 		$sql = "SELECT * FROM course WHERE course_delete = 0 AND course_level = '$year' ORDER BY course_level DESC";
// 	}
// 	$result = mysqli_query($conn, $sql);

// 	if (mysqli_num_rows($result) > 0) {
// 		echo '<div class="row">';

// 		while ($row = mysqli_fetch_assoc($result)) {
// 			echo '<div class="col-md-4 col-12 mb-3">';

// 			$badgeClass2 = '';
// 			$statusText2 = '';
// 			switch ($row['course_level']) {
// 				case 1:
// 				$badgeClass2 = 'style="background-color: #cfe2f3"';
// 				$statusText2 = '1';
// 				break;
// 				case 2:
// 				$badgeClass2 = 'style="background-color: #ead1dc"';
// 				$statusText2 = '2';
// 				break;
// 				case 3:
// 				$badgeClass2 = 'style="background-color: #fff2cc"';
// 				$statusText2 = '3';
// 				break;
// 				case 4:
// 				$badgeClass2 = 'style="background-color: #d9ead3"';
// 				$statusText2 = '4';
// 				break;
// 				case 5:
// 				$course_level_bg = 'style="background-color: #b4a7d6"';
// 				break;
// 				default:
// 				$badgeClass2 = 'style="background-color: #fce5cd"';
// 				$statusText2 = 'ไม่ทราบสถานะ';
// 			}

// 			echo '<div class="card h-100 d-flex flex-column card" ' . $badgeClass2 . '>';
// 			echo '<div class="card-body d-flex flex-column p-5">';
// 			echo '<h5 class="card-title">รหัสกิจกรรม: ' . $row['course_code'] . '</h5>';
// 			echo '<p class="card-text flex-grow-1">กิจกรรม: ' . $row['course_name'] . '</p>';

// 			echo '<div class="btn-group" role="group" aria-label="Course Actions">';
// 			$badgeClass1 = '';
// 			$statusText1 = '';
// 			switch ($row['course_status']) {
// 				case 1:
// 				$badgeClass1 = 'bg-success';
// 				$statusText1 = 'เปิด';
// 				break;
// 				case 2:
// 				$badgeClass1 = 'bg-danger';
// 				$statusText1 = 'ปิด';
// 				break;
// 				case 3:
// 				$badgeClass1 = 'bg-dark';
// 				$statusText1 = 'ยกเลิก';
// 				break;
// 				default:
// 				$badgeClass1 = 'bg-warning';
// 				$statusText1 = 'ไม่ทราบสถานะ';
// 			}
// 			echo '<span class="badge ' . $badgeClass1 . '">สถานะ: ' . $statusText1 . '</span>';
// 			echo '<span class="badge bg-secondary">ชั้นปีที่: ' . $statusText2 . '</span>';
// 			echo '</div>';
// 			echo '<div class="text-end"><button type="button" class="btn btn btn-light text-dark p-1 shadow-lg"><i class="bi bi-cart fa-lg"></i></button></div>';

// 			echo '</div>';
// 			echo '</div>';
// 			echo '</div>';
// 		}

//         echo '</div>'; // Close the row
//     } else {
//     	echo "No course found";
//     }

//     mysqli_close($conn);
// }




if (isset($_POST['get_course_Swiper'])) {
	$year = $_POST['year'];
	$cmuitaccount = $_POST['cmuitaccount'];

	if ($_SESSION['user_type'] == 'admin') {
		$sql = "SELECT * FROM course WHERE course_delete = '0' AND course_level = '$year' AND course_status IN ('1','2') ORDER BY course_type DESC ";
	}else{
		$sql = "SELECT * FROM course WHERE course_delete = '0' AND course_level = '$year' AND course_status IN ('1') ORDER BY course_type DESC ";
	}
	$result = mysqli_query($conn, $sql);

	echo '<div class="owl-carousel mentoring-course trending-course owl-theme aos " data-aos="fade-up">';
	if (mysqli_num_rows($result) > 0) {


		while ($row = mysqli_fetch_assoc($result)) {

			$rn = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_video WHERE course_uid = '".$row['course_id']."' "));

			$nump = mysqli_num_rows(mysqli_query($conn,"SELECT course_uid FROM course_purchase WHERE course_uid in ('".$row['course_id']."') AND cmuitaccount_uid = '$cmuitaccount' "));

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
					case 3:
					break;
					$course_type_badge = 'bg-secondary';
					$course_type_text = '';
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

				echo ' <div class="course-box">
				<div class="product">
				<div class="course-sub-box">
				<div class="product-img">
				<a href="" class="btn_view" data-id='.$row['id'].'>
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
				<a href="" class="btn_view" data-id='.$row['id'].'>รหัสกิจกรรม: ' . $row['course_code'] . '</a>
				<p class="card-text flex-grow-1">กิจกรรม: ' . $row['course_name'] . '</p>
				</h3>
				<div class="course-info d-flex align-items-center">
				<div class="rating-img d-flex align-items-center">
				<img src="assets/img/user/user2.jpg" alt="">
				<h4>' . $course_level_text . '</h4>
				</div>
				<div class="course-view d-flex align-items-center">
				<div class="graduate-point">
				<span>0</span>
				</div>  
				<i class="fas fa-user-graduate"></i>
				</div>
				</div>
				</div>
				</div>
				<div class="author-join d-flex justify-content-between">
				<div class="course-price">
				-
				</div>';
				if ($nump > 0) {
					echo '<button type="button" class="btn btn btn-success active"><i class="bi bi-cart-check-fill"></i> เพิ่มแล้ว</button>';
				} else {
					echo '<button type="button" class="btn join-now btn_purchase" data-course_id="'.$row['course_id'].'"><i class="bi bi-cart"></i> เพิ่ม</button>';
				}


				echo '</div>
				</div>
				</div>';
			}


			echo '</div>';
		} else {
			echo "No course";
		}

		mysqli_close($conn);
	}




	if (isset($_POST['purchase_modal'])) {
		$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
		$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));
		$student_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['student_id']), ENT_QUOTES, 'UTF-8'));
		$academic_year = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['academic_year']), ENT_QUOTES, 'UTF-8'));

		$sql = "SELECT * FROM course WHERE course_id = '$course_id' ";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			$course_id = $row['course_id'];
			$course_code = $row['course_code'];
			$course_name = $row['course_name'];
			$course_level = $row['course_level'];
			$course_type = $row['course_type'];
			$course_image_url = $row['course_image_url'];
			$course_detail = $row['course_detail'];
		} 

		$course_level_text = '';
		switch ($course_level) {
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
		?>

		<div class="modal-content">
			<div class="modal-header py-4">
				<h5 class="modal-title">กิจกรรม</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-0 py-0 my-0">

				<div class="card bg-secondary text-light">
					<div class="card-body">

						<div class="row">
							<div class="col-lg-7">
								<img class="img-fluid" alt="" src="<?= (($course_image_url == null or $course_image_url == '') ? 'assets/img/course/img-07.jpg' : $course_image_url) ?>" width="100%" height="">
							</div>
							<div class="col-lg-5">
								<p class="fw-bold">รหัสกิจกรรม : <?= $course_code ?></p>
								<p class="fw-bold h2">กิจกรรม : <?= $course_name ?></p>
								<p class="card-text">ระดับกิจกรรม: <?= $course_level_text ?></p>
								<p class="card-text"></p>
							</div>
						</div>
					</div>
				</div>

				<div class="text-center">
					<div class="btn-group" role="group">
						<button type="button" class="btn_free btn btn-lg btn-outline-primary" data-course_id="<?= $course_id ?>" data-cmuitaccount="<?= $cmuitaccount ?>" data-student_id="<?= $student_id ?>" data-academic_year="<?= $academic_year ?>"><i class="bi bi-cart fw-2x"></i> เพิ่ม Course</button>
					</div>
				</div>




			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Close</button>
			</div>
		</div>

		<?php
	}









	if (isset($_POST['course_purchase'])) {

		$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
		$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));
		$student_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['student_id']), ENT_QUOTES, 'UTF-8'));
		$academic_year = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['academic_year']), ENT_QUOTES, 'UTF-8'));

		$sql = "SELECT MAX(id) AS max_purchase FROM course_purchase";
		$result = mysqli_query($conn, $sql);
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$max_purchase = $row['max_purchase']+1;
		}else{
			$max_purchase = 1;
		}

		$date = date("YmdHis");
		$purchase_id = 'f'.$date.$max_purchase;

		$query = "INSERT INTO course_purchase (purchase_id, course_uid, cmuitaccount_uid, student_uid) VALUES (?, ?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ssss", $purchase_id, $course_id, $cmuitaccount, $student_id);
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



	if (isset($_POST['get_course_total'])) {

		$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));

		echo mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_purchase WHERE cmuitaccount_uid in ('".$cmuitaccount."') "));
	}





	if (isset($_POST['show_course_modal'])) {
		$id = $_POST['id'];

		$sql = "SELECT * FROM course WHERE id = '$id'";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();

			$course_id = $row['course_id'];
			$course_name = $row['course_name'];
			$course_code = $row['course_code'];
			$course_image_url = $row['course_image_url'];
			?>

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">กิจกรรม </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<img class="img-fluid" alt="" src=<?= (($row['course_image_url'] == null or $row['course_image_url'] == '') ? 'assets/img/course/img-07.jpg' : $row['course_image_url']) ?> width="100%" height="">

					<h4 class="fw-bold mt-2">รหัสกิจกรรม <?= $row['course_code']; ?></h4>
					<h5 class="card-text flex-grow-1">กิจกรรม: <?= $row['course_name'] ?></h5>


					<?php 
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
						$truncatedTitle = truncateText($videoDetails['snippet']['title'], 300);

						echo '<div class="card mb-1 ' . $isActiveClass . '">';
						echo '<div class="row g-0">';
						echo '<div class="col-md-3 position-relative">';
						echo '<img src="https://img.youtube.com/vi/' . $videoDetails['id'] . '/maxresdefault.jpg" class="img-fluid rounded-2" alt="Video Thumbnail">';
						// echo '<div class="play-overlay"><i class="bi bi-play">'.$row3['video_head'].'</i></div>';
						// echo '<div class="duration-overlay">' . formatDuration($duration) . '</div>';

						echo '</div>';
						echo '<div class="col-md-9">';
						echo '<div class="card-body m-0 p-2">';
						echo '<small class="card-title m-0 p-0 li08">' . $truncatedTitle . '</small><br>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '</div>';
					}









					?>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>


			<?php
		}
	}





	if (isset($_POST['manual_modal'])) {
		?>

		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">คู่มือการใช้งาน</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">

				<img src="https://webmaster.edu.cmu.ac.th/assets/upload/images/2024/07/27_20240711101125.jpg" width="50%" height="" class="shadow-lg"></img>


			</div>
			<div class="modal-footer text-center">
				<a href="https://cmu.to/w72sf" target="_blank"><button class="btn btn-primary">Download</button></a>
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>

		<?php
	}













?>