<?php require_once($_SERVER["DOCUMENT_ROOT"].'/login/lib/app.php'); ?>
<?php
    session_unset();
    session_destroy();
    header('Location: /login/index.php');
?>