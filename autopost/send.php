<?php 
include'moduls/header.php'; 
$access_token=$_REQUEST['token']; 
$id=$_REQUEST['id']; 
$limit = $_REQUEST['limit']; 
$user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$access_token)); 
 
if(empty($access_token) && empty($id) && empty($limit)){ 
echo'<div class="menu">Invalid Access Token.</div>'; 
include'moduls/foot.php'; 
exit;
}

if($_POST['submit']){
$status = $_POST['status'];
$link = $_POST['link'];
$name = $_POST['name'];
$foto = $_POST['foto'];
for($i=1; $i<($limit+1); $i++){
$uid = $_POST['uid'.$i.''];
if(!empty($uid)) echo'<a href="#'.$uid.'"><img alt="'.$uid.'" src="https://graph.facebook.com/'.$uid.'/feed?message='.urlencode($status).'&link='.urlencode($link).'&name='.urlencode($name).'&object_attachment='.$foto.'&method=POST&access_token='.$access_token.'"></a> <a href="https://graph.facebook.com/'.$uid.'/feed?message='.urlencode($status).'&link='.urlencode($link).'&name='.urlencode($name).'&object_attachment='.$foto.'&method=POST&access_token='.$access_token.'">Check</a><br/>';
}
echo'<hr>';
include'moduls/foot.php';
exit;
}
?>


