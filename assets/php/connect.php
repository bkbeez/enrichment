<?php 
exec('ssh -f -L 3306:10.178.127.179:3306 adminit Cmu$enr@edu sleep 10 > /dev/null');
$conn = new mysqli('localhost', 'enrpro', 'Edu$Db@enr', 'enrichment_edu', '3306');

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}else {
  //echo "Connected successfully";
}
$conn -> set_charset("utf8");
?>
