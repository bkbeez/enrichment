<?php
// provide your application id,secret and redirect uri
$appId = 'nW45KwzgEFu5gMvPQQuVgT9cubsPhVJpnd16WprT';
$appSecret = 'SBaQfmF83yKwfG9FX1NHeW8W6eTdVz3ByNdSTv6h';
$scope = 'cmuitaccount.all.basicinfo';

require('cmu.oauth.class.php');
$cmuOauth = new cmuOauth();
// set your application id,secret and redirect uri
$cmuOauth->setAppId($appId);
$cmuOauth->setAppSecret($appSecret);
$cmuOauth->setScope($scope);

$accessToken = $cmuOauth->getAccessTokenClientCred();
echo "<pre>";
var_dump($accessToken);
echo "</pre>";

if (isset($_GET['id'])) {
  # code...
  require('userinfo.class.php');
  $userinfo = new UserInfo();
  $student = $userinfo->getStudentBasicInfo($_GET['id'], $accessToken->access_token);
  echo "<pre>";
  var_dump($student);
  echo "</pre>";
}
echo "<a href=\"userInfo.php\">View User Info</a>";
echo "<br>";
echo "<a href=\"index.php\">Home</a>";
?>
