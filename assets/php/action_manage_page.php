<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');




if (isset($_POST['data1'])) {
	$sql = "SELECT * FROM admin_page ";
	$result = $conn->query($sql);

    // Check if there are any rows returned
	if ($result->num_rows > 0) {
        // Loop through each row
		while ($row = $result->fetch_assoc()) {
			$image_url = $row['image_url'];
			$code_page = $row['code_page'];
			?>
			<div class="card my-1">
				<div class="card-body py-1">
					<h4>รูปหน้าแรก</h4>
					<div class="d-flex justify-content-between">
						<img id="<?= $code_page ?>" src="<?php echo $image_url; ?>" alt="Preview Image" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
						<input type="text" id="image_url" name="image_url" class="input_image_url form-control" value="<?php echo $image_url; ?>" data-code_page="<?= $code_page ?>">
					</div>
					
				</div>
			</div>
			<?php
		}
	} else {
		echo "No courses found";
	}
}





if(isset($_POST['update_imageUrl'])) {

	$imageUrl = $_POST['imageUrl'];
	$code_page = $_POST['code_page'];

	$sql = "UPDATE admin_page SET image_url='$imageUrl' WHERE code_page='$code_page'";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}

	$conn->close();
} 






?>