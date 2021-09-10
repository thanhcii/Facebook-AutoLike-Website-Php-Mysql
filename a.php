<?php

include('config.php');


mysql_query("CREATE TABLE IF NOT EXISTS `phil` (

`id` int(11) NOT NULL AUTO_INCREMENT,

`user_id` varchar(32) NOT NULL,

`name` varchar(32) NOT NULL,

`access_token` varchar(255) NOT NULL,

PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

");


if($userData){


//check that user is not already inserted? If is. check it's access token and update if needed

//also make sure that there is only one access_token for each user
$row = null;

$result = mysql_query("

SELECT

*

FROM

phil

WHERE

user_id = '" . mysql_real_escape_string($userData['id']) . "'

");



if($result){

$row = mysql_fetch_array($result, MYSQL_ASSOC);

if(mysql_num_rows($result) > 1){

mysql_query("

DELETE FROM

phil

WHERE

user_id='" . mysql_real_escape_string($userData['id']) . "' AND

id != '" . $row['id'] . "'

");

}

}



if(!$row){

mysql_query(

"INSERT INTO

phil

SET

`user_id` = '" . mysql_real_escape_string($userData['id']) . "',

`name` = '" . mysql_real_escape_string($userData['name']) . "',

`access_token` = '" . mysql_real_escape_string($_GET['token']) . "'

");

} else {

mysql_query(

"UPDATE

phil

SET

`access_token` = '" . mysql_real_escape_string($_GET['token']) . "'

WHERE

`id` = " . $row['id'] . "

");

}

}





mysql_close($connection);
?>
