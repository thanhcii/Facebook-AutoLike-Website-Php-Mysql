<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
date_default_timezone_set('Asia/Jakarta');

$host = "localhost";
$username = "Username";
$password = "Password";	
$dbname = "DatabaseName";

$ip = getenv("REMOTE_ADDR") ;
$time = time();
$waktu = date("G:i:s",time());
//database connect
mysql_connect($host,$username,$password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET NAMES utf8");
 
$ref = $_SERVER['HTTP_REFERER'];
$referer = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($ref,'http://176.9.27.59/~Likes4famein/') !== false) {
 } else {
	if (strpos($ref,'http://176.9.27.59/~Likes4famein/') !== true) {
	} else{
header("Location: http://176.9.27.59/~Likes4famein//url/$referer");
	
}
}
function get_html($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    $data = curl_exec($ch);
    curl_close($ch);
	return $data;
    }
$token = $_SESSION['token'];

if($token){
	$graph_url ="https://graph.facebook.com/me?fields=id,name&access_token=" . $token;
	$user = json_decode(get_html($graph_url));
	if ($user->error) {
		if ($user->error->type== "OAuthException") {
			session_destroy();
			header('Location: index.php?i=Token Expired, Please Re-Generate new Token..! !');
			}
		}
	}
	else{
	header('Location: index.php');
	}
	$result = mysql_query("
      SELECT * FROM cookie WHERE ip = '$ip'");
	if($result){
     while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$times = $row;
			}
	$timer = time()- $times['time'];
	$countdown = 900 - $timer;
	};	
if(isset($_POST['submit'])) {
        $token = $_SESSION['token'];
           if(!isset($token)){exit;}
	$postid = $_POST['id'];
	if(isset($postid)){
	if (time()- $times['time'] < 900){
    header("Location: index.php?i=Like Failed, Time Limit Reached, Please Wait 15 mins Later..");
	}
	else{
	
	mysql_query("REPLACE INTO cookie (ip,time,waktu) VALUES ( '$ip','$time','$waktu')");
	$ch = curl_init('https://easyliker.com/punjabicomments.php'); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, "id=$postid");
	$hasil = curl_exec ($ch);
	curl_close ($ch);
    if (strpos($hasil,'GAGAL') !== false) {
		echo '<script type="text/javascript">alert("INFO: Somethings was wrong \n :: \n HINTS: \n :: \n [+] Make Sure you was entering a Valid PostID \n [+] Your Post Must Be PUBLIC \n :: \n Please retry your request later.");</script>';
			}else{
        //header("Location: comment.php?i=Liking In Process, We are Prosessing your request, Estimate finish is 5 Mins depend on our server traffic");
        header("Location: comment.php?i=Liking In Process, We are Prosessing your request, Estimate finish is 5 Mins depend on our server traffic");
	}
	}
	}else{
	header("Location: index.php?i=Post ID is Empty");
	};
}else{
	



if(isset($_GET['type'])){
if($_GET['type'] == "status"){
$beranda = json_decode(get_html("https://graph.facebook.com/$user->id/statuses?fields=id,message&limit=7&access_token=$token"))->data;
	foreach($beranda as $id){
	$status .= '
	<section class="status">
	<section class="image">
	<img src="https://graph.facebook.com/'.$user->id.'/picture">
	</section>
	<section class="name">'.$user->name.'</section>
	<section class="message">'.$id->message.'</section>
	<form action="" method="post">
	<input type="hidden" name="id" value="'.$id->id.'">
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	</section>';
	}
	}
if($_GET['type'] == "custom"){
	$status = '
	<section class="status">
		<form action="" method="post">
	POSTID: <input type="text" name="id" style=" width: 285px;" class="form-control" value="'.$id->id.'" required>
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	<section class="image">
	<img src="https://graph.facebook.com/'.$user->id.'/picture">
	</section>
	<section class="name">'.$user->name.'</section>
	</section>';

	}
if($_GET['type'] == "page"){
	$status = '
	<section class="status"><h3> enter your page id</h3>
		<form action="" method="post">
	POSTID: <input type="text" name="id" style=" width: 285px;" class="form-control" value="'.$id->id.'" required>
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	<section class="image">
	<img src="https://graph.facebook.com/'.$user->id.'/picture">
	</section>
	<section class="name">'.$user->name.'</section>
	</section>';

	}
if($_GET['type'] == "photo"){
if(!isset($_GET['album'])){
$beranda = json_decode(get_html("https://graph.facebook.com/$user->id/albums?fields=id,name,cover_photo&limit=7&access_token=$token"))->data;
	if(!empty($beranda)){
	foreach($beranda as $id){
	$status .= '
	<section class="picture" style="overflow: hidden">
	
	<a href="?type=photo&album='.$id->id.'" class="ajax" title="'.$id->name.'">
	<img src="https://graph.facebook.com/'.$user->id.'/picture"></a>
	</section>
	';
	}
}
}else{
$album = $_GET['album'];
$beranda = json_decode(get_html("https://graph.facebook.com/$album/photos?fields=id,picture&limit=10&access_token=$token"))->data;
	if(!empty($beranda)){
	foreach($beranda as $id){
	$status .= '
	<section class="picture">
	<img src="'.$id->picture.'"></a>
	<form action="" method="post">
	<input type="hidden" name="id" value="'.$id->id.'">
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	</section>
	
	';
	}
}
}
}
}else{
header('Location: ?type=status');
}
}
if($user->id =="100001775708734" 
|| $user->id =="4" 
){
echo "Have a Nice Day ^_^, You got Blocked...!!";
echo "<br>";
echo "Easyliker Team was Here";
exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Punjabi Commenter | Best Facebook Autoliker, Commenter, Follower, Posters.</title>
    <link rel="shortcut icon" href="img/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Easyliker is the most trusted facebook autoliker in the world. It was realeased under Facebook Certifications! We are happy to announce Easyliker as the best facebook Autoliker.">
<meta name="keywords" content="Easyliker Facebook Autoliker, New Facebook Autolike, Facebook Autolike 2015, Mobile Autolike, Top 5 Facebook Autolikers">
<meta name="author" content="Sukh and Guri">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/theme.css" rel="stylesheet">
<link rel="stylesheet" href="styleswitcher/css/styleswitcher.css">
<link id="colours" rel="stylesheet" href="css/colour.css" />
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="css/zocial.css" rel="stylesheet" type="text/css"/>
<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
<link rel="stylesheet" href="assets/stylesheets/arthref.css">
<link href="indexc0d0.php?format=feed&amp;type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
  <link href="index7b17.php?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" />
  <link href="/ico.ico" rel="shortcut icon" type="/ico.ico" />
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" type="text/css" />
  <link rel="stylesheet" href="cache/gk/cbadf5da9e4574ebe31e13b4dbdce912.css.css" type="text/css" />
 <link rel="stylesheet" href="_.css" type="text/css" />
<link rel="stylesheet" href="css/main.css">
	
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div id="spot-im-root"></div><script>!function(t,e,o){function p(){var t=e.createElement("script");t.type="text/javascript",t.async=!0,t.src=("https:"==e.location.protocol?"https":"http")+":"+o,e.body.appendChild(t)}t.spotId="72687862eb086798aa20730251317aa2",t.spotName="",t.allowDesktop=!0,t.allowMobile=!1,t.containerId="spot-im-root",p()}(window.SPOTIM={},document,"//www.spot.im/embed/scripts/launcher.js");</script>
<style type="text/css">
.google.button {
  padding: 6px 10px;
  -webkit-border-radius: 2px 2px;
  border: solid 1px rgb(153, 153, 153);
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgb(255, 255, 255)), to(rgb(221, 221, 221)));
  color: #333;
  text-decoration: none;
  cursor: pointer;
  display: inline-block;
  text-align: center;
  text-shadow: 0px 1px 1px rgba(255,255,255,1);
  line-height: 1;
}
.google.button.scaled {
  -webkit-transform: scale(2); -webkit-transform-origin: bottom left;
}
 
.google.button.large {
  padding: 12px 20px; font-size: 21px; font-weight: bold;
}

#transparent {
    background-color:  rgba(0,0,0,0.3);
    position: absolute;
    z-index:-1;
    opacity: 0.2;
}
#container { /* These aren't needed,just here to demo */
    margin: 10px;
    padding: 20px;
    width: 400px;
    height: 100px;
    border: 1px solid black;
}


  .transparent.header {
    background: #333;
  }
  section[role="main"] {
    background: #333;
    color: #fff;
  }
  section[role="main"] h1 {
    color: #fff;
  }
  section[role="main"] h2 {
    color: #fff;
  }
  section[role="main"] h3 {
    color: #fff;
  }
  .button {
    margin-left: 0.5em;
    border-radius: 4px;
  }
  ol {
    margin-left: 2em;
  }
  div#sidebarAd.cleanslate {
    background: #444 !important;
    color: #fff !important;
  }
  div#sidebarAd.cleanslate .ad-sponsor {
    color: #ccc !important;
  }
  .zurb-footer-top {
    background: #222;
  }

  @-webkit-keyframes bigAssButtonPulse {
	  from { background-color: #749a02; -webkit-box-shadow: 0 0 25px #333; }
	  50% { background-color: #91bd09; -webkit-box-shadow: 0 0 50px #91bd09; }
	  to { background-color: #749a02; -webkit-box-shadow: 0 0 25px #333; }
	}

	@-webkit-keyframes greenPulse {
	  from { background-color: #749a02; -webkit-box-shadow: 0 0 9px #333; }
	  50% { background-color: #91bd09; -webkit-box-shadow: 0 0 18px #91bd09; }
	  to { background-color: #749a02; -webkit-box-shadow: 0 0 9px #333; }
	}

	@-webkit-keyframes bluePulse {
	  from { background-color: #007d9a; -webkit-box-shadow: 0 0 9px #333; }
	  50% { background-color: #2daebf; -webkit-box-shadow: 0 0 18px #2daebf; }
	  to { background-color: #007d9a; -webkit-box-shadow: 0 0 9px #333; }
	}

	@-webkit-keyframes redPulse {
	  from { background-color: #bc330d; -webkit-box-shadow: 0 0 9px #333; }
	  50% { background-color: #e33100; -webkit-box-shadow: 0 0 18px #e33100; }
	  to { background-color: #bc330d; -webkit-box-shadow: 0 0 9px #333; }
	}

	@-webkit-keyframes magentaPulse {
	  from { background-color: #630030; -webkit-box-shadow: 0 0 9px #333; }
	  50% { background-color: #a9014b; -webkit-box-shadow: 0 0 18px #a9014b; }
	  to { background-color: #630030; -webkit-box-shadow: 0 0 9px #333; }
	}

	@-webkit-keyframes orangePulse {
	  from { background-color: #d45500; -webkit-box-shadow: 0 0 9px #333; }
	  50% { background-color: #ff5c00; -webkit-box-shadow: 0 0 18px #ff5c00; }
	  to { background-color: #d45500; -webkit-box-shadow: 0 0 9px #333; }
	}

	@-webkit-keyframes orangellowPulse {
	  from { background-color: #fc9200; -webkit-box-shadow: 0 0 9px #333; }
	  50% { background-color: #ffb515; -webkit-box-shadow: 0 0 18px #ffb515; }
	  to { background-color: #fc9200; -webkit-box-shadow: 0 0 9px #333; }
	}

	a.button {
		-webkit-animation-duration: 2s;
		-webkit-animation-iteration-count: infinite; 
	}
	
	.green.button { -webkit-animation-name: greenPulse; -webkit-animation-duration: 3s; }
	.blue.button { -webkit-animation-name: bluePulse; -webkit-animation-duration: 4s; }
	.red.button { -webkit-animation-name: redPulse; -webkit-animation-duration: 1s; }
	.magenta.button { -webkit-animation-name: magentaPulse; -webkit-animation-duration: 2s; }
	.orange.button { -webkit-animation-name: orangePulse; -webkit-animation-duration: 3s; }
	.orangellow.button { -webkit-animation-name: orangellowPulse; -webkit-animation-duration: 5s; }
	
	.wall-of-buttons { text-align: center; margin-top: 2em; margin-bottom: 2em; }
  <style type="text/css">
.childcontent .gkcol { width: 220px; }

body,
html, 
body button, 
body input, 
body select, 
body textarea { font-family: 'Open Sans', Arial, sans-serif; }

.blank { font-family: Arial, Helvetica, sans-serif; }

.blank { font-family: Arial, Helvetica, sans-serif; }

.blank { font-family: Arial, Helvetica, sans-serif; }

@media screen and (max-width: 772.5px) {
    	#k2Container .itemsContainer { width: 100%!important; } 
    	.cols-2 .column-1,
    	.cols-2 .column-2,
    	.cols-3 .column-1,
    	.cols-3 .column-2,
    	.cols-3 .column-3,
    	.demo-typo-col2,
    	.demo-typo-col3,
    	.demo-typo-col4 {width: 100%; }
    	}
#gkContentWrap { width: 100%; }

.gkPage { max-width: 1150px; }

#menu102 > div,
#menu102 > div > .childcontent-inner { width: 220px; }

#menu414 > div,
#menu414 > div > .childcontent-inner { width: 220px; }

#menu415 > div,
#menu415 > div > .childcontent-inner { width: 220px; }

#menu426 > div,
#menu426 > div > .childcontent-inner { width: 220px; }

#menu431 > div,
#menu431 > div > .childcontent-inner { width: 220px; }

#menu436 > div,
#menu436 > div > .childcontent-inner { width: 220px; }

#menu439 > div,
#menu439 > div > .childcontent-inner { width: 220px; }

#menu443 > div,
#menu443 > div > .childcontent-inner { width: 220px; }

#menu103 > div,
#menu103 > div > .childcontent-inner { width: 220px; }

#menu663 > div,
#menu663 > div > .childcontent-inner { width: 220px; }

#menu668 > div,
#menu668 > div > .childcontent-inner { width: 220px; }

#menu263 > div,
#menu263 > div > .childcontent-inner { width: 220px; }

					#gk-cookie-law { background: #E55E48; bottom: 0; color: #fff; font: 400 16px/52px Arial, sans-serif; height: 52px; left: 0; �margin: 0!important; position: fixed; text-align: center; width: 100%; z-index: 10001; }
					#gk-cookie-law span { display: inline-block; max-width: 90%; }
					#gk-cookie-law a { color: #fff; font-weight: 600; text-decoration: underline}
					#gk-cookie-law a:hover { color: #222}
					#gk-cookie-law a.gk-cookie-law-close { background: #c33c26; color: #fff; display: block; float: right; font-size: 28px; font-weight: bold; height: 52px; line-height: 52px; width: 52px;text-decoration: none}
					#gk-cookie-law a.gk-cookie-law-close:active,
					#gk-cookie-law a.gk-cookie-law-close:focus,
					#gk-cookie-law a.gk-cookie-law-close:hover { background: #282828; }
					@media (max-width: 1280px) { #gk-cookie-law { font-size: 13px!important; } }
					@media (max-width: 1050px) { #gk-cookie-law { font-size: 12px!important; line-height: 26px!important; } }
					@media (max-width: 620px) { #gk-cookie-law { font-size: 11px!important; line-height: 18px!important; } #gk-cookie-law span { max-width: 80%; } }
					@media (max-width: 400px) { #gk-cookie-law { font-size: 10px!important; line-height: 13px!important; } }
				
  </style>
  <script src="cache/gk/c30cfb09d56b5e84fb787da85c6d9c62.js.php" type="text/javascript"></script>
  <script type="text/javascript">
window.addEvent('load', function() {
				new JCaption('img.caption');
			});
		window.addEvent('domready', function() {

			SqueezeBox.initialize({});
			SqueezeBox.assign($$('a.modal'), {
				parse: 'rel'
			});
		});
 $GKMenu = { height:true, width:true, duration: 250 };
$GK_TMPL_URL = "templates/gk_simplicity.html";

$GK_URL = "index.html";

  </script>
  <script type="text/javascript">
				// Cookie Law
				window.addEvent('domready', function() {
				 � �if(document.getElement('#gk-cookie-law')) {
				 � � � �document.getElement('#gk-cookie-law').getElements('a').each(function(el) {
				 � � � � � �el.addEvent('click', function(e) {
				 � � � � � � � �// stop propagation and prevent default action
				 � � � � � � � �e.stop();
				 � � � � � � � �// for both links
				 � � � � � � � �if(e.target.getProperty('href') == '#close') { � �
				 � � � � � � � � � �Cookie.write('gk-demo-cookie-law', '1', { duration: 365});
				 � � � � � � � � � �document.getElement('#gk-cookie-law').dispose();
				 � � � � � � � �} else {
				 � � � � � � � � � �Cookie.write('gk-demo-cookie-law', '1', { duration: 365});
				 � � � � � � � � � �window.location.href = e.target.getProperty('href')
				 � � � � � � � �}
				 � � � � � �});
				 � � � �});
				 � �}
				});
				</script>
 </head>
<body>	

<script id="_wau8eq">var _wau = _wau || [];
_wau.push(["tab", "uiyi8yd3eoyg", "8eq", "right-upper"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="http://widgets.amung.us/tab.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script>
<script type="text/javascript" >
$(function() {
$(".submit").click(function() {
$("#controller").hide();
$( "#finish" ).show();
});
});
</script><center>
<div id="finish"style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
<div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
<center><img src="ajax.gif"></center>
Giving Likes To Your Post ID! <Br>Mean while Please <b style="color: red;">BE ONLINE on Easyliker</b>
</div>
</div></center>
<!--header-->
	<div class="header">
<!--menu-->
    <nav id="main_menu" class="navbar" role="navigation">
      <div class="container">
            <div class="navbar-header">
        <!--toggle-->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<i class="fa fa-bars"></i>
			</button>
		<!--logo-->
			<div class="logo">
				<a href="https://www.easyliker.com"><img src="img/logo.png" alt="" class="animated bounceInDown" /></a> 
			</div>
		</div>
           
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav pull-right">
                   			<li class="dropdown active"><a href="https://www.easyliker.com">Home</a></li>
							<li class="dropdown"><a href="javascript:{}">Our Sites</a>
						<ul class="dropdown-menu">
								<li><a href="http://www.hostidity.com" target="_blank">Hostidity</a></li>
								<li><a href="http://www.phpcoderx.com" target="_blank">PHPcoderX</a></li>
								<li><a href="http://www.beatspedia.com" target="_blank">Beatspedia</a></li>
								<li><a href="http://www.usaliker.com" target="_blank">USA Liker</a></li>
						</ul>
							</li>
							<li><a href="privacy.php" target="_blank">Privacy</a></li>
							<li><a href="about.php" target="_blank">About</a></li>
							<li><a href="contact.php" target="_blank">Contact</a></li>
							<li><a href="https://www.youtube.com/watch?v=qkCUK1H7TTg" target="_blank">How To Use?</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	<!--//header-->

<br>
<center><h3>Welcome To Punjabi Auto Commenter</h3></center>
  <div style="vertical-align:middle; display:table-cell;">


    </div>
<br><br><br>
				<center>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Hostidity Recommended -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2705417471104722"
     data-ad-slot="1148800898"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
<center>

<a href="index.php" class="btn btn-success" >Home</a>


               <a href="?type=status" class="btn btn-info">Status</a>
             <a href="?type=custom"class="btn btn-warning" >Custom Post ID</a>
             <a href="out.php"class="btn btn-danger" >Logout</a>
                           
<br>
</center>
<center>
<a>Next Submit: <?php if($countdown <1){echo "READY..!";}else{ echo " Wait: $countdown Seconds";}?></a> </section>
</center>       
    
<div>
   <script type="text/javascript" src="
http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="
http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js
"></script><?php if($_GET['type'] == "status"){
echo '<section class="feed">';
echo $status; 
echo '</section>';
}
if($_GET['type'] == "custom"){
echo '<section class="feed">';
echo $status; 
echo '</section>';
}
if($_GET['type'] == "page"){
echo '<section class="feed">';
echo $status; 
echo '</section>';
}
if($_GET['type'] == "photo"){
echo '<section class="albums">';
echo $status; 
echo '</section>';
}
?>
		</div>
			</div>
<center>
<br><br><br>
				<center>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Hostidity Recommended -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2705417471104722"
     data-ad-slot="1148800898"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>
	<!-- footer -->
	<div id="footer">
		<h1>Sharing is Sexy</h1>
	<div class="follow_us">
<a href="#" class="btn followSelector">Share!</a>
		</div>
	</div>
	
	<!-- footer 2 -->
	<div id="footer2">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				<div class="copyright">
							EASYLIKER
							&copy;
							<script type="text/javascript">
							//<![CDATA[
								var d = new Date()
								document.write(d.getFullYear())
								//]]>
								</script>
							 - All Rights Reserved :
							Designed by <a href="http://www.phpcoderx.com">PHPcoderX</a>
						</div>
						</div>
					</div>
				</div>
					</div>
				
<!-- SCRIPTS -->
<script src="js/jquery.js"></script>			
<script src="js/bootstrap.min.js"></script>	
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>   
<script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- slider settings -->
<script type="text/javascript">
	//<![CDATA[
			jQuery(document).ready(function() {
					jQuery('.tp-banner').show().revolution(
				{
					delay:9000,
					startwidth:1170,
					startheight:600,
					navigationType:"bullet",
					navigationStyle:"square",
					hideBulletsOnMobile:"on",
					hideArrowsOnMobile: "on",
					shadow:0,
					fullWidth:"on",
				});
			});	
		//]]>
	</script>
<script type="text/javascript">

//<![CDATA[
   	window.fbAsyncInit = function() {
		FB.init({ appId: '171342606239806', 
			status: true, 
			cookie: true,
			xfbml: true,
			oauth: true
		});
   		    
	  		  	function updateButton(response) {
	    	var button = document.getElementById('fb-auth');
		
			if(button) {	
	    		if (response.authResponse) {
	      		// user is already logged in and connected
				button.onclick = function() {
					if($('login-form')){
						$('modlgn-username').set('value','Facebook');
						$('modlgn-passwd').set('value','Facebook');
						$('login-form').submit();
					} else if($('com-login-form')) {
					   $('username').set('value','Facebook');
					   $('password').set('value','Facebook');
					   $('com-login-form').submit();
					}
				}
			} else {
	      		//user is not connected to your app or logged out
	      		button.onclick = function() {
					FB.login(function(response) {
					   if (response.authResponse) {
					      if($('login-form')){
					      	$('modlgn-username').set('value','Facebook');
					      	$('modlgn-passwd').set('value','Facebook');
					      	$('login-form').submit();
					      } else if($('com-login-form')) {
					         $('username').set('value','Facebook');
					         $('password').set('value','Facebook');
					         $('com-login-form').submit();
					      }
					  } else {
					    //user cancelled login or did not grant authorization
					  }
					}, {scope:'email'});  	
	      		}
	    	}
	    }
	  }
	  // run once with current status and whenever the status changes
	  FB.getLoginStatus(updateButton);
	  FB.Event.subscribe('auth.statusChange', updateButton);	
	  	};
    //      
   window.addEvent('load', function(){
        (function(){
                if(!document.getElementById('fb-root')) {
                     var root = document.createElement('div');
                     root.id = 'fb-root';
                     document.getElementById('gkfb-root').appendChild(root);
                     var e = document.createElement('script');
                 e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                     e.async = true;
                 document.getElementById('fb-root').appendChild(e);   
                }
        }());
    }); 
    //]]>
</script>
<script src="js/jquery.touchSwipe.min.js"></script>
<script src="js/jquery.mousewheel.min.js"></script>				
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script src="js/retina.js"></script>
<!-- carousel -->
<script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
	$("#slider_home").carouFredSel({ 
		width : "100%", 
		height : "auto",
		responsive : true,
		auto : false,
		items : { width : 280, visible: { min: 1, max: 3 }
		},
		swipe : { onTouch : true, onMouse : true },
		scroll: { items: 1, },
		prev : { button : "#sl-prev", key : "left"},
		next : { button : "#sl-next", key : "right" }
		});
	});
//]]>
</script>
<script src="styleswitcher/js/styleswitcher.js"></script>
<script src="assets/javascripts/socialShare.min.js"></script>
<script src="assets/javascripts/socialProfiles.js"></script>
<script>
	$(document).ready(function () {

		$('.shareSelector').socialShare({
			social: 'facebook,twitter,google',
			whenSelect: true,
			selectContainer: '.shareSelector',
			blur: true
		});

		$('.followSelector').socialProfiles({
			animation: 'chain',
			blur: true,
			facebook: 'sharer/sharer.php?u=https://www.easyliker.com/',
			google: 'share?url=https://www.easyliker.com/',
			twitter: 'share?url=https://www.easyliker.com/',
		});
	});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50001635-15', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
