<?php 
$title = 'Multy Post To Groups'; 
$access_token = $_REQUEST['token']; 
$id = $_REQUEST['id']; 
$user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$access_token)); 
include'moduls/header.php'; 
$limit = isset($_GET['limit']) ? $_GET['limit'] : 300; 
 
if(empty($access_token) && empty($id)){ 
echo'<div class="tmn">Access token Invalid Please Go<a href="http://www.swaglikers.com"><b> Home</b></a></div>'; 
include'moduls/foot.php';
exit;
}

$dg = json_decode(file_get_contents('https://graph.facebook.com/me/groups?access_token='.$access_token.'&method=GET&limit='.$limit),true);

echo '<script type="text/javascript"> checked=false; function checkedAll(frm1){ var aa = document.getElementById("frm1"); if(checked == false){ checked = true } else { checked = false } for(var i =0; i < aa.elements.length; i++) { aa.elements[i].checked = checked; } } </script>
<div class="menu">
&bull;<input type="checkbox" name="checkall" onclick="checkedAll(frm1);">Select all
<br/>
<form id="frm1" action="send.php?token='.$access_token.'&id='.$id.'&limit='.$limit.'" method="POST">
Select Group:
<br/>';
for($i=0;$i<count($dg[data]);$i++){
echo ''.($i+1).'<input type="checkbox" name="uid'.($i+1).'" value="'.$dg[data][$i][id].'">'.$dg[data][$i][name].'<br/>';
}
echo 'Write something:
<br/>
<textarea name="status"></textarea>
<br/>
<center><input type="submit" name="submit" value="POST" class="tmn"></center>
</form>
</div>';
include'moduls/foot.php';
?>