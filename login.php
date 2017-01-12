<?php
if (!$link = mysql_connect('localhost', 'root', '')) {		// connect to localhost with user root and password nothing
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db('Project1', $link)) {
    echo 'Could not select database';
    exit;
}
$passwd = $_POST["loginPasswd"];
$email =  $_POST["loginEmail"];
$sql    = 'SELECT * FROM User where email = "' .$email .'"';
 
$result = mysql_query($sql, $link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
	$num_rows = mysql_num_rows($result);
	if ($num_rows != 0) {
	
		$row = mysql_fetch_assoc($result);
		$passwd2 = $row['password'];				// retreive password from mysql
		$id = $row['user_id'];				
	
		if ($passwd == $passwd2) {
			session_start();						// feed variables to Main.php & profile.php
			$_SESSION['thisUserid'] = $id;
			header( "Location: Main.php" );
		} else {
			echo "<script>
					alert('Incorrect Password, Please try again!');
					window.location.href='index.php';
				</script>";    
		}
	} else {
		echo "<script>
				alert('Account does not exist. Please sign up!');
				window.location.href='index.php';
			</script>";
	}
}

mysql_free_result($result);		//free memory associate with the result set so that the page won't be heavy
mysql_close($link);
?>  