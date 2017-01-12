<?php
session_start();
$thisUserid = $_SESSION['thisUserid'];
if (!$link = mysql_connect('localhost', 'root', '')) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db('Project1', $link)) {
    echo 'Could not select database';
    exit;
}
$feed =  $_POST["FeedContent"];
$sql    = 'INSERT INTO Feed (user_id, feed_text) VALUES ("' 
		  												.$thisUserid
														.'", "'
														.$feed
														.'")';
 
$result = mysql_query($sql, $link);

header( "Location: Main.php" );

mysql_free_result($result);		//free memory associate with the result set so that the page won't be heavy
mysql_close($link);
?>