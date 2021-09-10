<?php
require 'facebook.php';


include('config.php');


//database connect
mysql_connect($host,$username,$password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET NAMES utf8");
 
//Create facebook application instance.
$facebook = new Facebook(array(
  'appId'  => $fb_app_id,
  'secret' => $fb_secret
));
 
$output = '';
 
 
 
 
 
//get users and try liking
$result = mysql_query("
SELECT
*
FROM
token_all Order By Rand() Limit 50
");
   if($result){
      while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                        $m = $row['token'];
                        $facebook->setAccessToken ($m);
                        $id = trim($_POST ['id']);
                try {
$ayat1  = $_POST["komen1"];
$ayat2  = $_POST["komen2"];
$ayat3  = $_POST["komen3"];
$ayat4  = $_POST["komen4"];
$ayat5  = $_POST["komen5"];
$ayat6  = $_POST["komen6"];
$ayat7  = $_POST["komen7"];
 
 
 
 $taz = array("ghaint piczz",
"att krti veere",
"ayye oh babe sirrraaaaa :*",
"lub u veer :)",
"att aa 22",
"ghaint lagda bro :)",
":O koka pic",
";) hun bni gal 22",
"END 3:)",
"100/100 att aa veer",
"Galbaat 22 :)",
"Nhi reesan 22",
" ^_^ ",
"hehe :P",
"A-CLASS :D",
"Patola :*",
":( Inbox reply krde yar",
"Sohna ho gya :D",
"buuuuuuurrraaaaaaaahh",
"attzzz :3",
"No words :)",
"<3 <3",
"vdia vdia",
"chakki jao kamm :D",
"sala att krai janda",
"kal peg loun chaliye?",
"ENDDDD",
"att aa bro :)",
"nice pic veera",
"lagda ishq hogya <3 ",
"nhi reesan teriya :D",
"Inbox ch ayi yar",
"pehchan ch e ni aounda 22",
"sirrraaaaa",
"haha sirraa",
"munda shonki hogya nee..",
"request accept krla 22",
"ghaint look ;)");
$sinta = $taz[array_rand($taz)];
 
 
 
  
 
 
 
 
 
 
 
 
 
 
                        $facebook->api("/".$id."/comments",'post',array('message' => $sinta));
      }
           catch (FacebookApiException $e) {
            $output .= "<p>'". $row['name'] . "' failed to like.</p>";
         }
}
}
 
 
 
 
 
 
 
 
?>
<!DOCTYPE html 
   PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et" lang="en">
   <head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
     <title>Done</title>
<link rel="shortcut icon" href="http://Tsm48.tk/indonesia" />

      
     <link rel='stylesheet' href='style.css' type='text/css' />
   </head>
   <body>
<div align="center"><h2>Done! </h2><br/><br/>

</center>
</div>
   </body>
</html>