<?php 
$title = 'Multy Post To Friends'; 
$access_token=$_REQUEST['token']; 
$id=$_REQUEST['id']; 
$user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$access_token)); 
include'moduls/header.php'; 
$limit = isset($_GET['limit']) ? $_GET['limit'] : 100; 
if(empty($access_token) && empty($id)){ 
echo'<div class="itxt">invalid access token</div>'; 
include'moduls/foot.php'; 
exit;
}

$df = json_decode(file_get_contents('https://graph.facebook.com/me/friends?access_token='.$access_token.'&method=GET&limit='.$limit),true);

echo '<script type="text/javascript"> checked=false; function checkedAll(frm1){ var aa = document.getElementById("frm1"); if(checked == false){ checked = true } else { checked = false } for(var i =0; i < aa.elements.length; i++) { aa.elements[i].checked = checked; } } </script>
<div class="menu">
&bull;<input type="checkbox" name="checkall" onclick="checkedAll(frm1);">Select All
<br/>
<form id="frm1" action="send.php?token='.$access_token.'&id='.$id.'&limit='.$limit.'" method="POST">
Select Your Friends
<br/>';
for($i=0;$i<count($df[data]);$i++){
echo ''.($i+1).'<input type="checkbox" name="uid'.($i+1).'" value="'.$df[data][$i][id].'">'.$df[data][$i][name].'<br/>';
}
$next = $limit+100;
echo '<a href="?token='.$access_token.'&id='.$id.'&limit='.$next.'">&raquo; Lihat '.$next.' teman</a>
<hr>';
echo 'Write Something
<br/>
<textarea name="status"></textarea>
<br/>
<center><input type="submit" name="submit" value="POST" class="tmn"></center>
</form>
</div>';
include'moduls/foot.php';
?>