<?php 
$thisCommentid = $_POST["thisCommentid"];
$thisUserid = $_POST["thisUserid"];
$thisFeedid = $_POST["thisFeedid"];
echo $thisUserid;
echo $thisFeedid;

if (!$link = mysql_connect('localhost', 'root', '')) {
	echo 'Could not connect to mysql';
	exit;
}

if (!mysql_select_db('Project1', $link)) {
	echo 'Could not select database';
	exit;
}
	
	$sql    = 'DELETE FROM Comment where comment_id = "' . $thisCommentid . '"';
	
	$result = mysql_query($sql, $link);
	

	mysql_close($link);
	
	echo "<form id=Comment action='comment.php' method='post'>";
	echo "<input type=hidden name=thisUserid value=" . $thisUserid . ">";
	echo "<input type=hidden name=thisFeedid value=" . $thisFeedid . ">";
	echo "</form>";
	
	?>
	<script>document.getElementById('Comment').submit();</script>