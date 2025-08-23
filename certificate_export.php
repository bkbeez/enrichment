<?php
session_start();
require 'session.php';
use Fpdf\Fpdf;

require('assets/php/fpdf/vendor/autoload.php');


$purchase_id = $_GET['purchase'];


if ($_SESSION['user_type'] != 'admin') {
	$sql_ck = "SELECT * FROM course_purchase WHERE purchase_id = '$purchase_id' AND cmuitaccount_uid = '".$_SESSION['cmuitaccount']."' ";
	$result_ck = $conn->query($sql_ck);

	if ($result_ck->num_rows == 1) {
		$row_ck = $result_ck->fetch_assoc();
		//$row_ck['purchase_id'];
	}else {
		echo 'Sorry page error!';
	}

	
}



$sql = "SELECT 
cp.id,
cp.purchase_id,
cp.course_uid,
cp.cmuitaccount_uid,
cp.student_uid,
cp.course_pass,
cp.course_pass_date,
cp.course_pass_datetime,
cp.code_pass,
cp.academic_year,
c.course_code,
c.course_name,
c.course_level,
c.course_type,
c.course_image_url,
c.course_detail,
c.course_status,
c.course_delete,
c.course_certificate
FROM 
course_purchase cp
JOIN 
course c ON cp.course_uid = c.course_id
WHERE 
cp.purchase_id = '$purchase_id'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$course_id = $row['course_uid'];
	$code_pass = $row['code_pass'];
	$course_pass_date = $row['course_pass_date'];
	$course_certificate = $row['course_certificate'];
	$cmuitaccount_uid = $row['cmuitaccount_uid'];
}

$code = $code_pass;
$date = $course_pass_date;

$sql2 = "SELECT * FROM users_cmu WHERE cmuitaccount = '$cmuitaccount_uid' ";
$result2 = $conn->query($sql2);

if ($result2->num_rows == 1) {
	$row2 = $result2->fetch_assoc();
	$firstname_TH = $row2['firstname_TH'];
	$lastname_TH = $row2['lastname_TH'];
}

$name = $firstname_TH." ".$lastname_TH;

function DateThai($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$strMonthThai=$strMonthCut[$strMonth];
	return "ให้ไว้ ณ วันที่ $strDay $strMonthThai พ.ศ. $strYear";
}
$strDate = $date;

$sql3 = "SELECT * FROM course WHERE course_id = '$course_id' ";
$result3 = $conn->query($sql3);

if ($result3->num_rows == 1) {
	$row3 = $result3->fetch_assoc();
	$course_id = $row3['course_id'];
	$course_certificate = $row3['course_certificate'];
	$certificate_set_name_updown = $row3['certificate_set_name_updown'];
	$certificate_set_name_leftright = $row3['certificate_set_name_leftright'];
	$certificate_set_name_size = $row3['certificate_set_name_size'];
	$certificate_set_date_updown = $row3['certificate_set_date_updown'];
	$certificate_set_date_leftright = $row3['certificate_set_date_leftright'];
	$certificate_set_date_size = $row3['certificate_set_date_size'];
	$certificate_set_code_updown = $row3['certificate_set_code_updown'];
	$certificate_set_code_leftright = $row3['certificate_set_code_leftright'];
	$certificate_set_code_size = $row3['certificate_set_code_size'];
}

$pdf = new Fpdf();

$pdf->AddPage('L');
$pdf->Image('assets/php/upload_img/'.$course_certificate, 0, 0, 297, 210);

// $logoPath = 'assets/img/edcmu/eduraw.png';
// list($logoWidth, $logoHeight) = getimagesize($logoPath);
// $maxWidth = 35;
// $aspectRatio = $logoWidth / $logoHeight;
// $logoHeight = $maxWidth / $aspectRatio;
// $centerX = (297 - $maxWidth) / 2; // Assuming width of the page is 297 (landscape)
// $centerY = (210 - $logoHeight) / 2; // Assuming height of the page is 210 (landscape)
// $centerY = 20;
// $pdf->Image($logoPath, $centerX, $centerY, $maxWidth, $logoHeight);

// Set font
$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew_b.php');

// $text = iconv('UTF-8', 'cp874', 'กิจกรรมเสริมความเป็นครู เพื่อพัฒนาทักษะชีวิตและวิชาชีพ' . "\n" . '(Soft Skill Of Pre-service Teacher)');
// $pdf->SetFont('THSarabunNew', 'B', 30);
// $multiCellWidth = 297;
// $multiCellHeight = $pdf->GetY();
// $centerX = $multiCellWidth / 2;
// $centerY = 120 - $multiCellHeight / 2;
// $pdf->SetXY((297 - $multiCellWidth) / 2, $centerY);
// $pdf->MultiCell($multiCellWidth, 10, $text, 0, 'C');

// $text = iconv('UTF-8', 'cp874', 'คณะศึกษาศาสตร์ มหาวิทยาลัยเชียงใหม่');
// $pdf->SetFont('THSarabunNew', 'B', 30);
// $textWidth = $pdf->GetStringWidth($text);
// $centerX = (297 - $textWidth) / 2;
// $pdf->Text($centerX, 150, $text);


$pdf->SetFont('THSarabunNew', 'B', $certificate_set_name_size);
$text = iconv('UTF-8', 'cp874', $name);
$textWidth = $pdf->GetStringWidth($text);
$centerX = ($certificate_set_name_leftright - $textWidth) / 2;
$pdf->Text($centerX, $certificate_set_name_updown, $text);


$text = iconv('UTF-8', 'cp874', DateThai($strDate));
$pdf->SetFont('THSarabunNew', 'B', $certificate_set_date_size);
$textWidth = $pdf->GetStringWidth($text);
$centerX = ($certificate_set_date_leftright - $textWidth) / 2;
$pdf->Text($centerX, $certificate_set_date_updown, $text);


$text = iconv('UTF-8', 'cp874', $code);
$pdf->SetFont('THSarabunNew', 'B', $certificate_set_code_size);
$textWidth = $pdf->GetStringWidth($text);
$centerX = ($certificate_set_code_leftright - $textWidth) / 2;
$pdf->Text($centerX, $certificate_set_code_updown, $text);











$pdf->Output();




?>