<?php 
require "connect.php";
date_default_timezone_set('Asia/bangkok');



if(isset($_POST['upload_file'])) {
    $targetDir = "upload_img/";

    // Sanitize the file name
    $fileName = basename($_FILES["file"]["name"]);
    $fileName = preg_replace("/[^a-zA-Z0-9_.-]/", "", $fileName);

    // Create the full path to the target file
    $targetFile = $targetDir . $fileName;
    $uploadOk = true;

    // Check if the directory exists, if not, create it with permissions 775
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0775, true);
    }

    // Check file extension
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
        echo "Sorry, only PNG, JPG, and JPEG files are allowed.";
        $uploadOk = false;
    }

    // If upload is successful, move the file to the target directory
    if ($uploadOk && move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "The file ". $fileName. " has been uploaded.";

        // Additional data from form inputs
        $name = $_POST['name'];
        $code = $_POST['code'];

        // Fetch previous certificate file name from the database
        $stmt = $conn->prepare("SELECT course_certificate FROM course WHERE id = 44");
        $stmt->execute();
        $stmt->bind_result($previousCertificate);
        $stmt->fetch();
        $stmt->close();

        // Delete previous certificate file if exists
        if ($previousCertificate && file_exists($targetDir . $previousCertificate)) {
            unlink($targetDir . $previousCertificate);
        }

        // Update database with new file information and additional data
        $stmt = $conn->prepare("UPDATE course SET course_certificate=? WHERE id = 44");
        $stmt->bind_param("s", $fileName);

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
} else {
    echo "No file uploaded or an error occurred during upload.";
}
?>
