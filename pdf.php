<?php

use Fpdf\Fpdf;

require('assets/php/fpdf/vendor/autoload.php');


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
	return "วันที่ $strDay $strMonthThai พ.ศ. $strYear";
}
$strDate = "2008-08-14";


$pdf = new Fpdf();

$pdf->AddPage('L');

// Add the certificate image
$pdf->Image('assets/certificate.png', 0, 0, 297, 210);

$logoPath = 'assets/img/edcmu/eduraw.png'; // Path to the logo image
list($logoWidth, $logoHeight) = getimagesize($logoPath);

// Set maximum width for the logo
$maxWidth = 35;

// Calculate height proportionally
$aspectRatio = $logoWidth / $logoHeight;
$logoHeight = $maxWidth / $aspectRatio;

// Calculate center position for the logo
$centerX = (297 - $maxWidth) / 2; // Assuming width of the page is 297 (landscape)
//$centerY = (210 - $logoHeight) / 2; // Assuming height of the page is 210 (landscape)
$centerY = 20;

// Add the logo image at the center
$pdf->Image($logoPath, $centerX, $centerY, $maxWidth, $logoHeight);

// Set font
$pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
$pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew_b.php');



$pdf->SetFont('THSarabunNew', 'B', 50);
$text = iconv('UTF-8', 'cp874', 'นายสมมุติ นามสมมุติ');
$textWidth = $pdf->GetStringWidth($text);
$centerX = (297 - $textWidth) / 2;
$pdf->Text($centerX, 80, $text);



$text = iconv('UTF-8', 'cp874', 'กิจกรรมเสริมความเป็นครู เพื่อพัฒนาทักษะชีวิตและวิชาชีพ' . "\n" . '(Soft Skill Of Pre-service Teacher)');
$pdf->SetFont('THSarabunNew', 'B', 30);

// Calculate the maximum width for the MultiCell based on the page width
$multiCellWidth = 297;

// Get the height of the MultiCell content
$multiCellHeight = $pdf->GetY();

// Calculate the center position
$centerX = $multiCellWidth / 2;
$centerY = 120 - $multiCellHeight / 2;

// Move to the calculated position
$pdf->SetXY((297 - $multiCellWidth) / 2, $centerY);

// Output the MultiCell content
$pdf->MultiCell($multiCellWidth, 10, $text, 0, 'C');



$text = iconv('UTF-8', 'cp874', 'คณะศึกษาศาสตร์ มหาวิทยาลัยเชียงใหม่');
$pdf->SetFont('THSarabunNew', 'B', 30);
$textWidth = $pdf->GetStringWidth($text);
$centerX = (297 - $textWidth) / 2;
$pdf->Text($centerX, 150, $text);


$text = iconv('UTF-8', 'cp874', DateThai($strDate));
$pdf->SetFont('THSarabunNew', 'B', 20);
$textWidth = $pdf->GetStringWidth($text);
$centerX = (297 - $textWidth) / 2;
//$centerX = 50;
$pdf->Text($centerX, 160, $text);













$pdf->Output();




?>