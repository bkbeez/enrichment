<?php 
$basename_dirname_PHP_SELF =  basename(dirname($_SERVER['PHP_SELF']));
$substr_FILE = substr(basename(__FILE__),0,-4);
?>

<?php if ($basename_dirname_PHP_SELF == 'admin'){
  $subadmin = '../';
}


?>


<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <title>Mentoring</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="<?= $subadmin ?>/assets/img/edcmu/enrichment2_Crop50.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/css/bootstrap.min.css">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/plugins/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/plugins/fontawesome/css/all.min.css">

  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/css/owl.theme.default.min.css">

  <!-- Slick CSS -->
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/plugins/slick/slick.css">
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/plugins/slick/slick-theme.css">

  <!-- Aos CSS -->
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/plugins/aos/aos.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="<?= $subadmin ?>/assets/css/style.css">

  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">