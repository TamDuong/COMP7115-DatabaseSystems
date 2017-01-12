<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">
    
    <link rel="stylesheet" href="css/style.css">
    
    <style>
    
    div {
    	background-color:white;
    	max-width: 600px; 
    	margin: 12px auto; 
    	border-radius: 4px; 
    	box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3); 
    	padding: 40px; 
    	padding-top: 5px; 
    	padding-bottom: 5px;
    }
    
     ul {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	    overflow: hidden;
	    background-color: rgba(19, 35, 47, 0.9);
	}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #1ab188;
    color: white;
}

.active {
    background-color: #1ab188;
}
	
    </style>
        
  </head>
  
  
  <body>

  <?php 
  session_start();
    $thisUserid = $_SESSION['thisUserid'];						// retrieve from login.php

    if (!$link = mysql_connect('localhost', 'root', '')) {
    	echo 'Could not connect to mysql';
    	exit;
    }
    
    if (!mysql_select_db('Project1', $link)) {
    	echo 'Could not select database';
    	exit;
    }
    
    $sql    = 'SELECT * FROM User where user_id = "' .$thisUserid .'"';			// retrieve user information
    $result = mysql_query($sql, $link);
    $row = mysql_fetch_assoc($result);				// retrieve name of the current user
    $thisUsername = $row['name'];
    $thisUseremail = $row['email'];
    
    $sql = 'SELECT User.user_id, User.name FROM User where User.user_id IN (SELECT FOLLOW.follow_id FROM FOLLOW WHERE FOLLOW.user_id="'.$thisUserid.'");';
    $result = mysql_query($sql, $link);
    
  ?>
  
	<ul>
	  <li><a href="Main.php">Main</a></li>
	  <li><a class="active" href="profile.php">Profile</a></li>
	  <li style="float:right"><a href="index.php">LogOut</a></li>
	  <li style="float:right"><a><strong><?php echo $thisUsername;?></strong></a></li>
	</ul>

	<div>
		<p><strong style="color:Green"><center>Profile Information: </center></strong> <br>
		<strong>Acount Name:</strong>	<?php echo '<span style="display: inline-block; width: 35px;"></span>';	echo $thisUsername. "<br>" . PHP_EOL; ?>
		<strong>Account Email:</strong> <?php echo '<span style="display: inline-block; width: 30px;"></span>';	echo $thisUseremail. "<br>" . PHP_EOL; ?>
    	</p>
	</div>
	
	<div>
		<p><strong style="color:Green"><center>People you follow: </center></strong> <br>
		
		<?php
	    	while ($row = mysql_fetch_assoc($result)) {
				echo "<form action='unFollow.php' method='post' style='display: inline-block;'>";
				echo "<input type=hidden name=otherUserid value=" . $row['user_id']. ">";
				echo "<input type=hidden name=thisUserid value=" . $thisUserid. ">";
				echo "<input type='submit' value='Unfollow' style='width: 60px; height:17px; padding: 0;background: none; color:green;font-size: 11px;' >";
				echo "</form>";
				echo '<span style="display: inline-block; width: 22px;"></span>';
	    		echo $row['name']. "<br>" . PHP_EOL; }
    	?>
    	</p>
	</div>
	
	<div>
		<p><strong style="color:Green"><center>Your posted Feed(s): </center></strong><br>
		<?php
			$sql = 'SELECT * FROM Feed WHERE user_id = "' .$thisUserid .'"';
			$result = mysql_query($sql, $link);
			$num_rows = mysql_num_rows($result);
			
	    	while ($row = mysql_fetch_assoc($result)) {
		    	echo $row['feed_text']. "<br>" . PHP_EOL; 
				echo "<font size=1>" . $row['create_date']. "</font>" . "<br>" . PHP_EOL;
				echo "<form action='deleteFeed.php' method='post' >";
				echo "<input type=hidden name=thisFeedid value=" . $row['feed_id']. ">";
				echo "<input type='submit' value='Delete' style='width: 40px; height:17px; padding: 0;background: none; color:green;font-size: 11px;' >";
				echo "</form>";
				$num_rows--;
				if ($num_rows != 0){
					echo '--------------------------------------------------------------------------'. "<br>" . PHP_EOL;}
			}
    	?>
    	</p>
	</div>
	
  		<?php 	
  			mysql_free_result($result);
    		mysql_close($link);
	    ?>
	    
  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
  </body>

  </html>
