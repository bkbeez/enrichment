<?php
require 'session.php';
use Fpdf\Fpdf;

require('assets/php/fpdf/vendor/autoload.php');




$course_id = $_GET['course_id'];
$name = $_GET['name'];
$date = $_GET['date'];
$code = $_GET['code'];

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

$sql = "SELECT * FROM course WHERE course_id = '$course_id' ";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$course_id = $row['course_id'];
	$course_certificate = $row['course_certificate'];
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