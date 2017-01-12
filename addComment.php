<?php 
$thisUserid = $_POST["thisUserid"];
$thisFeedid = $_POST["thisFeedid"];
$commentContent = $_POST["commentContent"];

if (!$link = mysql_connect('localhost', 'root', '')) {
	echo 'Could not connect to mysql';
	exit;
}
	
if (!mysql_select_db('Project1', $link)) {
	echo 'Could not select database';
	exit;
}

$sql    = 'INSERT INTO Comment (user_id, feed_id, comment_text) VALUES ("'
		  												.$thisUserid
														.'", "'
														.$thisFeedid
														.'", "'
														.$commentContent
														.'")';
$result = mysql_query($sql, $link);
$row = mysql_fetch_assoc($result);

mysql_free_result($result);
mysql_close($link);

echo "<form id=Comment action='comment.php' method='post'>";
echo "<input type=hidden name=thisUserid value=" . $thisUserid . ">";
echo "<input type=hidden name=thisFeedid value=" . $thisFeedid . ">";
echo "</form>";
?>

<script>document.getElementById('Comment').submit();</script>