<?php
session_start();
echo $accessToken = $_SESSION['accessToken'];
$accessToken;

require('userinfo.class.php');

$userinfo = new UserInfo();
$user = $userinfo->getUserInfo($accessToken);



echo "<pre>";
//var_dump($user);
print_r($user);
echo "</pre>";

echo "<br>";
echo "<a href=\"index.php\">Home</a>";
echo "<br>";
?>







<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php 

	echo 'cmuitaccount_name : '.$x1 = $user->cmuitaccount_name; echo '<br>';
	echo 'cmuitaccount : '.$x2 = $user->cmuitaccount; echo '<br>';
	echo 'student_id : '.$x3 = $user->student_id; echo '<br>';
	echo 'prename_id : '.$x4 = $user->prename_id; echo '<br>';
	echo 'prename_TH : '.$x5 = $user->prename_TH; echo '<br>';
	echo 'prename_EN : '.$x6 = $user->prename_EN; echo '<br>';
	echo 'firstname_TH : '.$x7 = $user->firstname_TH; echo '<br>';
	echo 'firstname_EN : '.$x8 = $user->firstname_EN; echo '<br>';
	echo 'lastname_TH : '.$x9 = $user->lastname_TH; echo '<br>';
	echo 'lastname_EN : '.$x10 = $user->lastname_EN; echo '<br>';
	echo 'organization_code : '.$x11 = $user->organization_code; echo '<br>';
	echo 'organization_name_TH : '.$x12 = $user->organization_name_TH; echo '<br>';
	echo 'organization_name_EN : '.$x13 = $user->organization_name_EN; echo '<br>';
	echo 'itaccounttype_id : '.$x14 = $user->itaccounttype_id; echo '<br>';
	echo 'itaccounttype_TH : '.$x15 = $user->itaccounttype_TH; echo '<br>';
	echo 'itaccounttype_EN : '.$x16 = $user->itaccounttype_EN; echo '<br>';


	echo $_SESSION['cmuitaccount'] = $x2;


	?>

</body>
</html>