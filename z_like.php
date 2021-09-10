<?php
require 'facebook.php';


$host = "localhost";
$username = "root";
$password = "dieuchat";	
$dbname = "easyliker";

//database connect
mysql_connect($host,$username,$password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());


mysql_query("SET NAMES utf8");
 

//Create facebook application instance.
$facebook = new Facebook(array(
'appId'  => '72687635881',
));
$output = '';
//get users and try liking
$result = mysql_query("
SELECT
*
FROM
token_all Order By Rand() Limit 156
");



if($result){
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$m = $row['token'];
$facebook->setAccessToken ($m);
$id =$_POST['id'];
try {
$facebook->api("/".$id."/likes", 'POST');
$msg1 = "<font color='get'>Success!</font>";
}
catch (FacebookApiException $e) {
$output .= "<p>'". $row['name'] . "' failed to like.</p>";
$msg2 = "<font color='red'>Failed to Like!</font>";
}
}
}
mysql_close($connection);
?>
