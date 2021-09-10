<?
include('config.php');
//count member

$token_all = mysql_query ("SELECT id, COUNT(id) FROM token_all");

$token = mysql_fetch_array($token_all);

$count=$token['COUNT(id)'];

$token_allx = mysql_query ("SELECT ip, COUNT(ip) FROM cookie");

$tokenx = mysql_fetch_array($token_allx);

$countx=$tokenx['COUNT(ip)'];

  mysql_query("CREATE TABLE IF NOT EXISTS `cookie` (
  `ip` varchar(255) DEFAULT NULL,

  `time` varchar(255) DEFAULT NULL,
  `waktu` varchar(32) NOT NULL DEFAULT,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");

mysql_query("REPLACE INTO cookie (ip,time,waktu) VALUES ( '1','2','3')");








?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Token Counter | Easyliker</title>
<link href="favicon.ico" rel="shortcut icon"/>
<link href="counterstyle.css" rel="stylesheet" media="all"/> 
<style>.banner h1{color:#000}.bannerX{-webkit-transition:all .3s;-moz-transition:all .3s;-ms-transition:all .3s;-o-transition:all .3s;transition:all .3s;border:1px solid #d0d0d0;padding:25px 25px 30px;background-color:white;border-radius:2px;box-shadow:1px 1px 1px rgba(100,100,100,0.1),0 0 25px rgba(0,0,0,0.1) inset;overflow:hidden;-webkit-border-top-left-radius:42px;-moz-border-radius-topleft:42px;border-top-left-radius:42px;-webkit-border-top-right-radius:0;-moz-border-radius-topright:0;border-top-right-radius:0;-webkit-border-bottom-right-radius:42px;-moz-border-radius-bottomright:42px;border-bottom-right-radius:42px;-webkit-border-bottom-left-radius:0;-moz-border-radius-bottomleft:0;border-bottom-left-radius:0}.bannerX:hover{-webkit-transition:all .3s;-moz-transition:all .3s;-ms-transition:all .3s;-o-transition:all .3s;transition:all .3s;border-radius:6px;border:1px solid #d0d0d0;padding:25px 25px 30px;background-color:#FFF;border-radius:xxxx;box-shadow:1px 1px 1px #d0d0d0,0 0 35px #d0d0d0 inset;overflow:hidden;-webkit-border-top-left-radius:0;-moz-border-radius-topleft:0;border-top-left-radius:0;-webkit-border-top-right-radius:42px;-moz-border-radius-topright:42px;border-top-right-radius:42px;-webkit-border-bottom-right-radius:0;-moz-border-radius-bottomright:0;border-bottom-right-radius:0;-webkit-border-bottom-left-radius:42px;-moz-border-radius-bottomleft:42px;border-bottom-left-radius:42px}.bannerX:active{-webkit-transition:all .3s;-moz-transition:all .3s;-ms-transition:all .3s;-o-transition:all .3s;transition:all .3s}.logo{background:transparent;font-size:25px;margin:10px 0 -25px 0}.logo h1{font-size:55px;font-weight:bold;text-xshadow:1px 0 5px #398eb5}.logo h1 span{font-family:'Chau Philomene One',sans-serif;font-style:italic}input[type=password]{background:url(/) 12px 11px no-repeat,linear-gradient(to bottom,#f7f7f8 0,#ffffff 100%);border-radius:3px;border:0;box-shadow:0 1px 2px rgba(0,0,0,0.2) inset,0 -1px 0 rgba(0,0,0,0.05) inset;transition:all .2s linear;font-family:"Tahoma",sans-serif;font-size:13px;color:#222222;position:relative;height:36px;width:300px;padding-left:30px;&::-webkit-input-placeholder{color:#fff}&:-moz-placeholder{color:#fff}&:focus{box-shadow:0 1px 0 #2392f3 inset,0 -1px 0 #2392f3 inset,1px 0 0 #2392f3 inset,-1px 0 0 #2392f3 inset,0 0 4px rgba(35,146,243,0.5);outline:0;background:url(/) 12px 11px no-repeat,#FFF}}.classic-button{display:inline-block;position:relative;margin:8px;padding:0 14px;text-align:center;text-decoration:none;font:bold 12px/25px Tahoma,sans-serif;color:#fff;background:#398eb5}</style> 
</head>

<!-- Content -->
<body>
<div id="wrap" class="boxed">
<center>
<br><br><br><br><br><br>
<div class="bannerX" style="width: 600px;">
<div class="logo">
<section class="logo">
<img src="logo.png">
</section>
</div>
<br>
<hr>
<br>
<h1> Tokens :- <?php echo $count; ?> </h1>
<h1>Submits :- <?php echo $countx; ?> </h1></center>
</body>
</html>