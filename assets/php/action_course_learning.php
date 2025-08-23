<?php 
session_start();
require "connect.php";
date_default_timezone_set('Asia/bangkok');



if (isset($_POST['get_question'])) {

	$video_question_id = $_POST['video_question_id'];

	$query = "SELECT * FROM video_questions where video_question_uid = '$video_question_id' ";
	$result = $conn->query($query);

	$quizData = array();

	while ($row = $result->fetch_assoc()) {
		$quizData[] = array(
			'question' => $row['question'],
			'question_id' => $row['question_id'],
			'question_num' => $row['question_num'],
			'options' => array($row['option1'], $row['option2'], $row['option3'], $row['option4']),
			'correct_Answer' => $row['correctAnswer'],
			'time_show' => $row['time_show']
		);
	}

	$conn->close();

	echo json_encode($quizData);

}


if (isset($_POST['submitAnswers'])) {
	$cmuitaccount = $_POST['cmuitaccount'];
	$course_id = $_POST['course_id'];
	$video_question_id = $_POST['video_question_id'];
	$selectedAnswers = json_decode($_POST['selectedAnswers'], true);


	if ($cmuitaccount) {
		$stmt = $conn->prepare("SELECT * FROM video_questions_responses WHERE cmuitaccount_uid = ? AND video_question_uid = ?");
		$stmt->bind_param("ss", $cmuitaccount, $video_question_id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$stmt_delete = $conn->prepare("DELETE FROM video_questions_responses WHERE cmuitaccount_uid = ? AND video_question_uid = ?");
			$stmt_delete->bind_param("ss", $cmuitaccount, $video_question_id);
			$stmt_delete->execute();
			$stmt_delete->close();
		}
		$stmt->close();
	}


    // Your logic to process and store the submitted answers in the database
	foreach ($selectedAnswers as $answer) {
		$question_num = $answer['question_num'];
		$question_id = $answer['question_id'];
		$correctAnswer = $answer['correctAnswer'];
		$selected_answer_num = $answer['index_num'];
		$optionText = $answer['optionText'];
		$selectedAnswer = $conn->real_escape_string($answer['selectedAnswer']);

		if ($selectedAnswer == $correctAnswer) {
			$selected_answeer_result = 1;
		}else{
			$selected_answeer_result = 0;
		}

		$query = "INSERT INTO video_questions_responses (cmuitaccount_uid, video_question_uid, question_uid, question_num, selected_answer_num, selected_answer, selected_answer_true, selected_answer_text, selected_answeer_result) VALUES ('$cmuitaccount', '$video_question_id', '$question_id', '$question_num', '$selected_answer_num','$selectedAnswer', '$correctAnswer', '$optionText', '$selected_answeer_result')";
		$result = $conn->query($query);

		$selectedAnswerall[] = $selectedAnswer;
	}

    // Check for success and send a response back to the client
	if ($result) {
		echo json_encode(array('status' => 'success','selectedAnswerall' => $selectedAnswerall, 'course' => $course_id));
	} else {
		echo json_encode(array('status' => 'error', 'message' => 'Failed to submit answers.', 'question_id' => $question_uid, 'selectedAnswers' => $selectedAnswerall));
	}

    // Close the database connection
	$conn->close();
}



if (isset($_POST['get_video'])) {

	$course_id = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['course_id']), ENT_QUOTES, 'UTF-8'));
	$video_url = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['video_url']), ENT_QUOTES, 'UTF-8'));
	$cmuitaccount = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['cmuitaccount']), ENT_QUOTES, 'UTF-8'));


	$sql1 = "SELECT * FROM course where course_id = '$course_id'";
	$result1 = mysqli_query($conn, $sql1);


	if (mysqli_num_rows($result1) > 0) {

		while ($row1 = mysqli_fetch_assoc($result1)) { $c_pass_pt = $row1['course_pass_percent'] ?>

			<h4 class="bg-light p-1 rounded-2 fw-bold"><?= $row1['course_name'] ?></h4>

		<?php
	}
	?>

	<?php 
	$apiKey = 'AIzaSyBTadgnq5szgDxIE0D1i_oDixTJebJqnb4';

	$sql3 = "SELECT * FROM course_video where course_uid = '$course_id' ";
	$result3 = $conn->query($sql3);

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

	$x = 1;
	while ($row3 = $result3->fetch_assoc()) {
		$videoId = $row3['video_url'];
		$video_question_id = $row3['video_question_id'];

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

		$isActiveClass = ($video_url == $row3['video_url']) ? 'bg-warning text-dark' : '';
		$duration = $videoDetails['contentDetails']['duration'];
		$truncatedTitle = truncateText($videoDetails['snippet']['title'], 60);

		echo '<a href="course_learning?course=' . $row3['course_uid'] . '&video=' . $row3['id'] . '" class="" aria-current="true">';
		echo '<div class="card mb-1 ' . $isActiveClass . '">';
		echo '<div class="row g-0">';
		echo '<div class="col-md-4 position-relative">';
		echo '<img src="https://img.youtube.com/vi/' . $videoDetails['id'] . '/maxresdefault.jpg" class="img-fluid rounded-2" alt="Video Thumbnail">';
		echo '<div class="play-overlay"><i class="bi bi-play">'.$row3['video_head'].'</i></div>';
		echo '<div class="duration-overlay">' . formatDuration($duration) . '</div>';

		if ($_SESSION['user_type'] == 'admin') {
			echo '<div><button type="button" class="view_admin btn btn-sm btn-light m-0" data-href="course_learning" data-course="'.$row3['course_uid'].'" data-video="'.$row3['id'].'" data-user="'.$_SESSION['user_type'].'">Admin</button></div>';
		}

		echo '</div>';
		echo '<div class="col-md-8">';
		echo '<div class="card-body m-0 p-2">';
		echo '<small class="card-title m-0 p-0 li08">' . $truncatedTitle . '</small><br>';
		echo '<small class="m-0 p-0 fs-14">Views: ' . $videoDetails['statistics']['viewCount'] . '</small><br>';
		echo '</div>';
		echo '</div>';

		echo '<div class="col-md-12">';
		$sql_answer = "SELECT * FROM video_questions_responses where video_question_uid = '$video_question_id' AND cmuitaccount_uid = '$cmuitaccount' ";
		$result_answer = mysqli_query($conn, $sql_answer);
		$num_answer = mysqli_num_rows($result_answer);

		if ($num_answer > 0) {
			$num_answer = (100/$num_answer);

			$num_count1 = mysqli_num_rows(mysqli_query($conn,"SELECT selected_answeer_result FROM video_questions_responses WHERE video_question_uid = '$video_question_id' AND cmuitaccount_uid = '$cmuitaccount' AND selected_answeer_result = '1' ")); 
			$percent_answer = round($num_count1*$num_answer, 2);
			if ($percent_answer < $c_pass_pt) {
				echo '<span class="text-danger"><i class="bi bi-x-circle-fill"></i> ไม่ผ่าน</span>';
			}else{
				echo '<span class="text-success"><i class="bi bi-check-circle-fill"></i> ผ่าน</span>';
			}
			echo '<span class="small"> Correct '.$percent_answer; echo'%</span> ';

		}else{
			echo '<span class="text-danger"><i class="bi bi-play-circle-fill"></i> เข้าร่วมกิจกรรม</span>';
		}
		echo '</div>';

		echo '</div>';
		echo '</div>';
		echo '</a>';

		$x++; }
		?>

		<?php

	} else {
		echo "No video";
	}

	mysqli_close($conn);
}

















?>
