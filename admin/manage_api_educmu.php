<?php require '../session.php' ?>
<?php include '../head.php' ?>

<style>
  body{
    background-color: gray;
  }

  .loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    display: none; /* Initially hide the loader */
    margin-left: 40%;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .modal-content {
    border-radius: 20px; /* Adjust the value as needed */
  }

  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    border-radius: 20px;
  }

  .card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }
  
</style>

</head>

<body>
  <div class="content-wrapper">
    <?php include '../header.php' ?>


    <div class="container mt-5">


      <?php

      $student_id = '640210172';


      echo $host = 'https://api.edu.cmu.ac.th/v1/student/'.$student_id.'';
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
      ?>



      <?php

      // foreach ($decodedResponse as $key => $value) {
      //   echo $key . ': ' . $value . "\n";
      // }

      // echo '<table border="1" class="table-sm table-bordered">';
      // echo '<tr><th>Field</th><th>Value</th></tr>';

      // foreach ($decodedResponse as $key => $value) {
      //   echo '<tr>';
      //   echo '<td>' . $key . '</td>';
      //   echo '<td>' . $value . '</td>';
      //   echo '</tr>';
      // }

      // echo '</table>';


      // echo '<table border="1">';
      // echo '<tr>';

      // foreach ($decodedResponse as $key => $value) {
      //   echo '<th>' . $key . '</th>';
      // }
      // echo '</tr><tr>';

      // foreach ($decodedResponse as $value) {
      //   echo '<td>' . $value . '</td>';
      // }
      // echo '</tr>';

      // echo '</table>';

      echo $decodedResponse->student_id;
      // echo $decodedResponse->title;
      // echo $decodedResponse->firstname;
      // echo $decodedResponse->lastname;
      // echo $decodedResponse->gender;
      echo $decodedResponse->major;
      // echo $decodedResponse->education_plan;
      // echo $decodedResponse->education_type_id;
      // echo $decodedResponse->education_type_name;
      // echo $decodedResponse->education_id;
      // echo $decodedResponse->education_name;
      // echo $decodedResponse->phone ;
      // echo $decodedResponse->email;
      // echo $decodedResponse->image;



      if (!empty($decodedResponse->major)) {
    // Sanitize the major value to prevent SQL injection
        $major = mysqli_real_escape_string($conn, $decodedResponse->major);

        $sql = "UPDATE users_cmu SET user_major = '$major' WHERE student_id = '$student_id'";
        if (mysqli_query($conn, $sql)) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }
      } else {
        echo "No need to update user_major because decodedResponse->major is empty";
      }








      ?>





    </div>




  </div>
  <?php //include '../footer.php' ?>

  <?php include 'script.php' ?>


  <script>
    $(document).ready(function() {


    });
  </script>










</body>
</html>