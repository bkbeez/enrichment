<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');




if (isset($_GET['getdata1'])) {

	$sql = "SELECT `action`, timestamp FROM users_cmu_log WHERE `action` = 'login'";
	$result = $conn->query($sql);

	$data = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
        // Convert timestamp to date format (e.g., 'Y-m-d H:i:s')
			$timestamp = date("Y-m-d", strtotime($row["timestamp"]));

        // Count the number of logins for each timestamp
			if (isset($data[$timestamp])) {
				$data[$timestamp]++;
			} else {
				$data[$timestamp] = 1;
			}
		}
	}

	$conn->close();

	$chart_data = array();
	$chart_data[] = array('Date', 'Login Count');
	foreach ($data as $date => $count) {
		$chart_data[] = array($date, $count);
	}

	echo json_encode($chart_data);

}



if (isset($_GET['getdata2'])) {

	$sql = "SELECT c.course_id, c.course_code, c.course_name, COALESCE(cp.purchase_count, 0) AS purchase_count
	FROM course c
	LEFT JOIN (
		SELECT course_uid, COUNT(*) AS purchase_count
		FROM course_purchase
		GROUP BY course_uid
		) cp ON c.course_id = cp.course_uid
	WHERE c.course_delete = 0";

	$result = $conn->query($sql);

// Initialize an array to store the data
	$data = array();

// Fetch data and format it
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$data[] = array(
				'course_id' => $row['course_id'],
				'course_code' => $row['course_code'],
				'course_name' => $row['course_name'],
            'purchase_count' => intval($row['purchase_count']) // Convert to integer
        );
		}
	}

// Close database connection
	$conn->close();

// Send the data as JSON response
	header('Content-Type: application/json');
	echo json_encode($data);
}



if (isset($_GET['getdata3'])) {

	$sql = "SELECT
	COUNT(*) AS count,
	pass_count
	FROM (
		SELECT
		cmuitaccount_uid,
		COUNT(*) AS pass_count
		FROM
		course_purchase
		WHERE
		course_pass = 1
		GROUP BY
		cmuitaccount_uid
		) AS pass_counts
	GROUP BY
	pass_count
	HAVING
	pass_count >= 1 AND pass_count <= 8
	ORDER BY
	pass_count DESC;";

	$result = $conn->query($sql);

	$data = array();

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	} else {
		echo "0 results";
	}

	$conn->close();

	echo json_encode($data);



}






?>