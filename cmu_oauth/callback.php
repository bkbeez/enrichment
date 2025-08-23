<?php
session_start();
// provide your application id,secret and redirect uri
$appId = 'TQ8EVadB3CFFNxGr5etwa6tU7mre9xuwxkx7X3n0';
$appSecret = 'qzN6rE1YqkkPH7dWwrGJW9BFjjhC9JEb3DgMvxCC';
//$callbackUri[5] = 'http://localhost/php5/callback.php';
$callbackUri[7] = 'https://enrichment-program.edu.cmu.ac.th/cmu_oauth/index.php';//[8] == version PHP
$scope = 'cmuitaccount.basicinfo';

require('cmu.oauth.class.php');
// new CMU Oauth Instance.
$cmuOauth = new cmuOauth();
// set your application id,secret and redirect uri
$cmuOauth->setAppId($appId);
$cmuOauth->setAppSecret($appSecret);
$cmuOauth->setCallbackUri($callbackUri[PHP_MAJOR_VERSION]);
$cmuOauth->setScope($scope);

if (isset($_GET['error'])) {
	session_destroy();
	exit($_GET['error']);
} elseif(!isset($_GET['code'])){
	//set state
	$_SESSION['oauth2state'] = $cmuOauth->setState();

	// initial redirect to CMU Oauth login page.
	$cmuOauth->initOauth();

// Check given state against previously stored one to mitigate CSRF attack
} elseif(empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])){
	if (isset($_SESSION['oauth2state'])) {
		unset($_SESSION['oauth2state']);
	}
	exit('Invalid state');
} else {
	// code parse from CMU Oauth to your redirect uri.
	//echo '4';
	//echo '<br>';
	$code = $_GET['code'];
	// get access token from code.
	$accessToken = $cmuOauth->getAccessTokenAuthCode($code);
	

	$_SESSION['accessToken']=$accessToken->access_token;
	//echo '<br>';
	//echo $_SESSION['refresh_token']=$accessToken->access_token;
	//echo '<br>';
	//echo $_SESSION['id_token']=$accessToken->access_token;




	//echo "<pre>";
	var_dump($accessToken);
	//echo "</pre>";
	//echo "<a href=\"userInfo.php\">View User Info</a>";
	//echo "<br>";
	//echo "<a href=\"index.php\">Home</a>";


}
?>
