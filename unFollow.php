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
	
	$sql    = 'DELETE FROM Follow where follow_id = "' .$otherUserid .'" AND user_id="' . $thisUserid . '"';
	
	$result = mysql_query($sql, $link);
	
	mysql_free_result($result);		//free memory associate with the result set so that the page won't be heavy
	mysql_close($link);
	header( "Location: profile.php" );
	?>