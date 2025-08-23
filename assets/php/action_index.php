<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');


if (isset($_POST['img1'])) {
	echo '<img src="../assets/img/edcmu/head_index1.jpg" alt="" style="width: 100%;">';
}


if (isset($_POST['img2'])) { ?>
	
	<div class="row">
		<div class="col-lg-4 col-md-6">
			<div class="large-team">
				<div class="large-team-space">
					<a href="">
						<div class="student-img">
							<a href=""><img src="assets/img/edcmu/file-004_0.jpg" alt=""></a>
							<div class="blog-read align-items-center d-flex justify-content-center">
								<a href="">Read More..</a>
							</div>
							<div class="rating-student-five">
								<div class="student-list-view">
									<h4></h4>
								</div>
								<div class="student-list-view">
									<ul>
										<li>14 กุมภาพันธ์ 2567</li>
										<li><i class="fas fa-calendar-week"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="large-team">
				<div class="large-team-space">
					<a href="">
						<div class="student-img">
							<a href=""><img src="assets/img/edcmu/file-003_0.jpg" alt=""></a>
							<div class="blog-read align-items-center d-flex justify-content-center">
								<a href="">Read More..</a>
							</div>
							<div class="rating-student-five">
								<div class="student-list-view">
									<h4></h4>
								</div>
								<div class="student-list-view">
									<ul>
										<li>14 กุมภาพันธ์ 2567</li>
										<li><i class="fas fa-calendar-week"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</a>  
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="large-team">
				<div class="large-team-space">
					<a href="">
						<div class="student-img">
							<a href=""><img src="assets/img/edcmu/file-002_0.jpg" alt=""></a>
							<div class="blog-read align-items-center d-flex justify-content-center">
								<a href="">Read More..</a>
							</div>
							<div class="rating-student-five">
								<div class="student-list-view">
									<h4></h4>
								</div>
								<div class="student-list-view">
									<ul>
										<li>14 กุมภาพันธ์ 2567</li>
										<li><i class="fas fa-calendar-week"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</a>  
				</div>
			</div>
		</div>
	</div>

<?php } 



if (isset($_POST['get_course_Swiper'])) {
	$year = isset($_POST['year']) ? $_POST['year'] : '';
	$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';
	$searchADRIC = isset($_POST['searchADRIC']) ? $_POST['searchADRIC'] : '';

	$sql = "SELECT * FROM course WHERE course_delete = '0' AND course_level = '$year' AND course_status = '1'";
	
	if (!empty($searchQuery)) {
		$searchQuery = mysqli_real_escape_string($conn, $searchQuery);
		$sql .= " AND (course_code LIKE '%$searchQuery%' OR course_name LIKE '%$searchQuery%')";
	}
	
	if (!empty($searchADRIC)) {
		$searchADRIC = mysqli_real_escape_string($conn, $searchADRIC);
		$sql .= " AND course_adric LIKE '%$searchADRIC%'";
	}
	
	$sql .= " ORDER BY id ASC";
	$result = mysqli_query($conn, $sql);

	echo '<div class="" >';
	if (mysqli_num_rows($result) > 0) {
		$count = 0;
		$totalItems = mysqli_num_rows($result);

        echo '<div class="item"><div class="row d-flex align-items-stretch">';  // Start the first row with flexbox

        while ($row = mysqli_fetch_assoc($result)) {
        	$rn = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM course_video WHERE course_uid = '" . $row['course_id'] . "' "));

        	$course_type_badge = '';
        	$course_type_text = '';
        	switch ($row['course_type']) {
        		case 1:
        		$course_type_badge = 'bg-info';
        		$course_type_text = 'กิจกรรมเลือก';
        		break;
        		case 2:
        		$course_type_badge = 'bg-danger';
        		$course_type_text = 'กิจกรรมกำหนด';
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

        	$text_course_adric = '';
        	switch ($row['course_adric']) {
        		case A:
        		$text_course_adric = 'green; shadow: rgb(38, 57, 77) 0px 20px 30px -10px;';
        		break;
        		case D:
        		$text_course_adric = 'yellowgreen; box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;';
        		break;
        		case R:
        		$text_course_adric = 'gold; box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;';
        		break;
        		case I:
        		$text_course_adric = 'orange; box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;';
        		break;
        		case C:
        		$text_course_adric = 'orangered; box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;';
        		break;
        		default:
        		$course_level_text = '';
        	}

        	echo '<div class="col-md-3 g-3 mb-2 d-flex align-items-stretch">
        	<div class="product d-flex flex-column m-0">
        	<div class="course-sub-box flex-grow-1 d-flex flex-column">
        	<div class="product-img2">
        	<a href="" class="btn_view" data-id=' . $row['id'] . '>
        	<img class="img-fluid" alt="" src="' . (($row['course_image_url'] == null or $row['course_image_url'] == '') ? 'assets/img/course/img-07.jpg' : $row['course_image_url']) . '" st>
        	</a>
        	<div class="book-mark">
        	<i class="h2 p-0" style="color: ' . $text_course_adric . ' ">' . $row['course_adric'] . '&nbsp;</i>
        	</div>
        	</div>
        	<div class="product-content h-100 d-flex flex-column">
        	<div class="blog-view-list d-flex">
        	<div class="blog-admin-view">
        	<p><i class="fas fa-book"></i> <span>' . $rn . ' Lessons</span></p>
        	</div>
        	<p><span class="badge ' . $course_type_badge . '">' . $course_type_text . '</span></p>
        	</div>
        	<h3 class="title">
        	<a href="" class="btn_view" data-id=' . $row['id'] . '>รหัสกิจกรรม: ' . $row['course_code'] . '</a>
        	<p class="card-text flex-grow-1">กิจกรรม: ' . $row['course_name'] . '</p>
        	</h3>
        	<div class="course-info d-flex align-items-center mt-auto">
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
        	<div class="author-join d-flex align-items-center mt-auto">
        	<div class="course-price">
        	-
        	</div>
        	<a href="" class="btn_view btn join-now" data-id=' . $row['id'] . '>ดูกิจกรรม</a>
        	</div>
        	</div>
        	</div>
        	</div>';


        	$count++;

        	// Close current row and item, start new row and item if count is a multiple of 4
        	if ($count % 4 == 0) {
                echo '</div>';  // Close the current row

                // If it's not the last item, start a new row
                if ($count < $totalItems) {
                	echo '</div><div class="item"><div class="row d-flex align-items-stretch">';
                }
            }
        }

        // If the last row is not closed (not a multiple of 4), close it now
        if ($count % 4 != 0) {
            echo '</div></div>';  // Close the last row and item
        }
    } else {
    	echo "ไม่พบกิจกรรม";
    }

    echo '</div>';  // Close the Owl Carousel div

    mysqli_close($conn);
}







if (isset($_POST['show_course_modal'])) {
	$id = $_POST['id'];

	$sql = "SELECT * FROM course WHERE id = '$id'";
	$result = $conn->query($sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();

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

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>


		<?php
	}
}






// if (isset($_POST['get_course_Swiper'])) {
// 	$year = $_POST['year'];


// 	$sql = "SELECT * FROM course WHERE course_delete = '0' AND course_level = '$year' AND course_status = '1' ORDER BY course_type DESC ";
// 	$result = mysqli_query($conn, $sql);

// 	echo '<div class="owl-carousel mentoring-course trending-course owl-theme aos " data-aos="fade-up">';
// 	if (mysqli_num_rows($result) > 0) {


// 		while ($row = mysqli_fetch_assoc($result)) {

// 			$rn = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM course_video WHERE course_uid = '".$row['course_id']."' "));

// 			$course_type_badge = '';
// 			$course_type_text = '';
// 			switch ($row['course_type']) {
// 				case 1:
// 				$course_type_badge = 'bg-info';
// 				$course_type_text = 'กิจกรรมเลือก';
// 				break;
// 				case 2:
// 				$course_type_badge = 'bg-danger';
// 				$course_type_text = 'กิจกรรมกำหนด';
// 				break;
// 				default:
// 				$course_type_badge = 'bg-secondary';
// 				$course_type_text = '';
// 			}

// 			$course_level_text = '';
// 			switch ($row['course_level']) {
// 				case 1:
// 				$course_level_text = 'ชั้นปีที่1';
// 				break;
// 				case 2:
// 				$course_level_text = 'ชั้นปีที่2';
// 				break;
// 				case 3:
// 				$course_level_text = 'ชั้นปีที่3';
// 				break;
// 				case 4:
// 				$course_level_text = 'ชั้นปีที่4';
// 				break;
// 				case 5:
// 				$course_level_text = 'ทุกชั้นปี';
// 				break;
// 				default:
// 				$course_level_text = '';
// 			}

// 			echo ' <div class="course-box">
// 			<div class="product">
// 			<div class="course-sub-box">
// 			<div class="product-img">
// 			<a href="" class="btn_view" data-id='.$row['id'].'>
// 			<img class="img-fluid" alt="" src="' . (($row['course_image_url'] == null or $row['course_image_url'] == '') ? 'assets/img/course/img-07.jpg' : $row['course_image_url']) . '" width="600" height="300">
// 			</a>
// 			<div class="book-mark">
// 			<i class="far fa-bookmark"></i>
// 			</div>
// 			</div>
// 			<div class="product-content">
// 			<div class="blog-view-list d-flex">
// 			<div class="blog-admin-view">
// 			<p><i class="fas fa-book"></i> <span>'.$rn.' Lessons</span></p>
// 			</div>
// 			<p><span class="badge '.$course_type_badge.'">'.$course_type_text.'</span></p>
// 			</div>
// 			<h3 class="title">
// 			<a href="" class="btn_view" data-id='.$row['id'].'>รหัสกิจกรรม: ' . $row['course_code'] . '</a>
// 			<p class="card-text flex-grow-1">กิจกรรม: ' . $row['course_name'] . '</p>
// 			</h3>
// 			<div class="course-info d-flex align-items-center">
// 			<div class="rating-img d-flex align-items-center">
// 			<img src="assets/img/user/user2.jpg" alt="">
// 			<h4>' . $course_level_text . '</h4>
// 			</div>
// 			<div class="course-view d-flex align-items-center">
// 			<div class="graduate-point">
// 			<span>0</span>
// 			</div>  
// 			<i class="fas fa-user-graduate"></i>
// 			</div>
// 			</div>
// 			</div>
// 			</div>
// 			<div class="author-join d-flex align-items-center">
// 			<div class="course-price">
// 			-
// 			</div>
// 			<a href="" class="btn_view btn join-now" data-id='.$row['id'].'>ดูข้อมูล</a>
// 			</div>
// 			</div>
// 			</div>';
// 		}


// 		echo '</div>';
// 	} else {
// 		echo "No course";
// 	}

// 	mysqli_close($conn);
// }


















?>