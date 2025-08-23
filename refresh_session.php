<?php
session_start();
  // if you have more session-vars that are needed for login, also check 
  // if they are set and refresh them as well
if (isset($_SESSION['cmuitaccount'])) { 
  $_SESSION['cmuitaccount_name'] = $_SESSION['cmuitaccount_name'];
  $_SESSION['cmuitaccount'] = $_SESSION['cmuitaccount'];
  $_SESSION['user_type'] = $_SESSION['user_type'];
  $_SESSION['organization_name_EN'] = $_SESSION['organization_name_EN'];
  $_SESSION['student_id'] = $_SESSION['student_id'];
}

?>