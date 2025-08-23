<?ob_start();?>
<?php 
session_start(); 
require '../assets/php/connect.php';
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>


  <div class="container">

<!-- <a href="home.php"><button class="btn btn-success my-1"><i class="fa fa-home"></i> Home</button></a><br>
<a href="callback.php?code=<?= $code ?>&state=<?= $state  ?>"><button class="btn btn-dark my-1">callback</button></a><br>
<a href="userInfo.php"><button class="btn btn-dark my-1">UserInfo</button></a><br> -->

<a href="logout"><button class="btn btn-danger my-1">Login again</button></a><br>
</div>



<?php include 'callback.php'; ?>

<?php
$accessToken = $_SESSION['accessToken'];



if (!isset($_SESSION['accessToken'])) {
  header("location:https://enrichment-program.edu.cmu.ac.th/home");
}




require('userinfo.class.php');

$userinfo = new UserInfo();
$user = $userinfo->getUserInfo($accessToken);



    //echo "<pre>";
//var_dump($user);
    //print_r($user);
    //echo "</pre>";

    //echo "<br>";
    //echo "<a href=\"index.php\">Home</a>";
    //echo "<br>";
?>


<?php 

'cmuitaccount_name : '.$cmuitaccount_name = $user->cmuitaccount_name; echo '<br>';
'cmuitaccount : '.$cmuitaccount = $user->cmuitaccount; echo '<br>';
'student_id : '.$student_id = $user->student_id; echo '<br>';
'prename_id : '.$prename_id = $user->prename_id; echo '<br>';
'prename_TH : '.$prename_TH = $user->prename_TH; echo '<br>';
'prename_EN : '.$prename_EN = $user->prename_EN; echo '<br>';
'firstname_TH : '.$firstname_TH = $user->firstname_TH; echo '<br>';
'firstname_EN : '.$firstname_EN = $user->firstname_EN; echo '<br>';
'lastname_TH : '.$lastname_TH = $user->lastname_TH; echo '<br>';
'lastname_EN : '.$lastname_EN = $user->lastname_EN; echo '<br>';
'organization_code : '.$organization_code = $user->organization_code; echo '<br>';
'organization_name_TH : '.$organization_name_TH = $user->organization_name_TH; echo '<br>';
'organization_name_EN : '.$organization_name_EN = $user->organization_name_EN; echo '<br>';
'itaccounttype_id : '.$itaccounttype_id = $user->itaccounttype_id; echo '<br>';
'itaccounttype_TH : '.$itaccounttype_TH = $user->itaccounttype_TH; echo '<br>';
'itaccounttype_EN : '.$itaccounttype_EN = $user->itaccounttype_EN; echo '<br>';

// $_SESSION['cmuitaccount_name'] = $cmuitaccount_name;
// $_SESSION['cmuitaccount'] = $cmuitaccount;
// $_SESSION['organization_name_EN'] = $organization_name_EN;
$_SESSION['student_id'] = $student_id;


$host = 'https://api.edu.cmu.ac.th/v1/student/'.$student_id.'';
$user_name = 'toptop';
$password = '@top$Bg6FqW';
$ch = curl_init($host);
$headers = array(
  'Content-Type: application/json',
  'Authorization: Basic '. base64_encode("$user_name:$password")
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
if(curl_errno($ch)){
  throw new Exception(curl_error($ch));
}
curl_close($ch);
$decodedResponse=json_decode($response);
      //echo json_encode($response);

      // $decodedResponse->student_id;
      // echo $decodedResponse->title;
      // echo $decodedResponse->firstname;
      // echo $decodedResponse->lastname;
      // echo $decodedResponse->gender;
$decodedResponse->major;
      // echo $decodedResponse->education_plan;
      // echo $decodedResponse->education_type_id;
      // echo $decodedResponse->education_type_name;
      // echo $decodedResponse->education_id;
      // echo $decodedResponse->education_name;
      // echo $decodedResponse->phone ;
      // echo $decodedResponse->email;
      // echo $decodedResponse->image;

function insertLog($conn, $cmuitaccount_name, $cmuitaccount, $student_id, $action)
{
  $sql = "SELECT MAX(id) AS max_log FROM users_cmu_log";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $max_log = $row['max_log'] + 1;
    $max_log = 'log_' . $max_log;
  } else {
    $max_log = 'log_' . '1';
  }

  $sql_log = "INSERT INTO users_cmu_log (log_id, cmuitaccount_name, cmuitaccount, student_id, action) 
  VALUES (?, ?, ?, ?, ?)";
  $stmt_log = mysqli_prepare($conn, $sql_log);
  mysqli_stmt_bind_param($stmt_log, "sssss", $max_log, $cmuitaccount_name, $cmuitaccount, $student_id, $action);
  mysqli_stmt_execute($stmt_log);
}


// $sql_admin = mysqli_query($conn, "SELECT academic_year FROM admin WHERE name = 'admin' ");
// $row1_admin = mysqli_fetch_array($sql_admin);
// $academic_year = $row1_admin['academic_year'];

$currentMonth = date('m');
$currentYear = date('Y');
$currentDay = date('d');

if ($currentMonth == '01') {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '02') {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '03') {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '04') {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '05') {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '06') {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '07' && $currentDay < 15) {
  $academic_year = (int)$currentYear + 542;
} elseif ($currentMonth == '07' && $currentDay >= 15) {
  $academic_year = (int)$currentYear + 543;
} elseif ($currentMonth == '08') {
  $academic_year = (int)$currentYear + 543;
} elseif ($currentMonth == '09') {
  $academic_year = (int)$currentYear + 543;
} elseif ($currentMonth == '10') {
  $academic_year = (int)$currentYear + 543;
} elseif ($currentMonth == '11') {
  $academic_year = (int)$currentYear + 543;
} elseif ($currentMonth == '12') {
  $academic_year = (int)$currentYear + 543;
} else {
  $academic_year = "Unknown";
}

?>



<?php if ($cmuitaccount != ''){
  date_default_timezone_set('Asia/bangkok'); 
  $date_now = date("Y-m-d H:i:s");

  $sql1 = "SELECT * FROM users_cmu WHERE cmuitaccount = '$cmuitaccount'";
  $result1 = mysqli_query($conn, $sql1);

  if (mysqli_num_rows($result1) > 0) {

    $userinfo = mysqli_fetch_assoc($result1);
    $users_cmu = $userinfo['users_cmu'];
    $user_type = $userinfo['user_type'];
    $organization_name_EN = $userinfo['organization_name_EN'];
    $student_id = $userinfo['student_id'];

    // $query_update_sign_in="UPDATE users_cmu SET cmu_timestamp = '$date_now' WHERE cmuitaccount = '{$_SESSION['cmuitaccount']}'";
    // $stmt = $conn->prepare($query_update_sign_in);
    // $stmt->execute();

    insertLog($conn, $cmuitaccount_name, $cmuitaccount, $student_id, 'login');

    $_SESSION['cmuitaccount_name'] = $cmuitaccount_name;
    $_SESSION['cmuitaccount'] = $cmuitaccount;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['organization_name_EN'] = $organization_name_EN;
    $_SESSION['student_id'] = $student_id;
    $_SESSION['academic_year'] = $academic_year;

    if (!empty($decodedResponse->major)) {
      $major = mysqli_real_escape_string($conn, $decodedResponse->major);

      $sql = "UPDATE users_cmu SET user_major = '$major' WHERE student_id = '$student_id'";
      if (mysqli_query($conn, $sql)) {
          //echo "Record updated successfully";
      } else {
          //echo "Error updating record: " . mysqli_error($conn);
      }
    } else {
        //echo "No need to update user_major because decodedResponse->major is empty";
    }

    header("location:https://enrichment-program.edu.cmu.ac.th/home");

  }else{

      //echo 'NO Account?';
      //echo '<br>';
      //echo $cmuitaccount;

            // user in not exists
    $sql2 = "INSERT INTO users_cmu (cmuitaccount_name,cmuitaccount,student_id,prename_id,prename_TH,prename_EN,firstname_TH,firstname_EN,lastname_TH,lastname_EN,organization_code,organization_name_TH,organization_name_EN,itaccounttype_id,itaccounttype_TH,itaccounttype_EN)
    VALUES ('$cmuitaccount_name','$cmuitaccount','$student_id','$prename_id','$prename_TH','$prename_EN','$firstname_TH','$firstname_EN','$lastname_TH','$lastname_EN','$organization_code','$organization_name_TH','$organization_name_EN','$itaccounttype_id','$itaccounttype_TH','$itaccounttype_EN')";
    $result2 = mysqli_query($conn,$sql2);
    if ($result2) {
        //echo "User is created";

      insertLog($conn, $cmuitaccount_name, $cmuitaccount, $student_id, 'new_user');

      $_SESSION['cmuitaccount_name'] = $cmuitaccount_name;
      $_SESSION['cmuitaccount'] = $cmuitaccount;
      $_SESSION['organization_name_EN'] = $organization_name_EN;
      $_SESSION['student_id'] = $student_id;
      $_SESSION['academic_year'] = $academic_year;

      if (!empty($decodedResponse->major)) {
        $major = mysqli_real_escape_string($conn, $decodedResponse->major);

        $sql = "UPDATE users_cmu SET user_major = '$major' WHERE student_id = '$student_id'";
        if (mysqli_query($conn, $sql)) {
          //echo "Record updated successfully";
        } else {
          //echo "Error updating record: " . mysqli_error($conn);
        }
      } else {
        //echo "No need to update user_major because decodedResponse->major is empty";
      }

      header("location:https://enrichment-program.edu.cmu.ac.th/home");
    }else{
        //echo "User is not created";
        //die();
      header('Location: ../error_login');
      exit();
    }

  }




}else{
  header('Location: ../error_login');
  exit();
}



?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>