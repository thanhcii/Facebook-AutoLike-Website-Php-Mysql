
<?php 
 // Connects to your Database 


 mysql_connect("localhost", "root", "dieuchat") or die(mysql_error()); 
  mysql_select_db("easyliker") or die(mysql_error()); 
$data = mysql_query("SELECT * FROM token_all ORDER BY RAND() LIMIT 0,9; ") 
 or die(mysql_error()); 
 Print "<table"; 
 while($info = mysql_fetch_array( $data )) 
 { 
 Print "<tr>"; 
Print " <a target=_blank href=\"https://www.facebook.com/".$info['id'] . "/\"/> <img  src=\"https://graph.facebook.com/".$info['id'] . "/picture\"/></a>"; 
  
} 
 Print "</table>"; 
 ?> 