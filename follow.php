<?php
$otherUserid = $_POST["otherUserid"];
$thisUserid = $_POST["thisUserid"];
if (!$link = mysql_connect('localhost', 'root', '')) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db('Project1', $link)) {
    echo 'Could not select database';
    exit;
}

$sql    = 'INSERT INTO Follow VALUES ("' 
		  												.$otherUserid
														.'", "'
														.$thisUserid
														.'")';
 
$result = mysql_query($sql, $link);

header( "Location: Main.php" );

mysql_free_result($result);		//free memory associate with the result set so that the page won't be heavy
mysql_close($link);
?>