<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">
    
    <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    <style>
    	.custom {
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
		body {
			background-color: #c1bdba;
		}
    </style>
        
  </head>
  
  
  <body>

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
    
    $sql    = 'SELECT * FROM User where user_id = "' .$thisUserid .'"';
    $result = mysql_query($sql, $link);
    
    if (!$result) {
    	echo "DB Error, could not query the database\n";
    	echo 'MySQL Error: ' . mysql_error();
    	exit;
    }
    
    $row = mysql_fetch_assoc($result);				// retrieve name of the current user
    $thisUsername = $row['name'];
    
    
    ?>
    
    <ul>
	  <li><a class="active" href="Main.php">Main</a></li>
	  <li><a href="profile.php">Profile</a></li>
	  <li style="float:right"><a href="index.php">LogOut</a></li>
	  <li style="float:right"><a><strong><?php echo $thisUsername;?></strong></a></li>
	</ul>
	
	<div class="action_buttons_header" style="width: 300px; float: right; margin: 10px auto; padding-left: 6px; padding-right: 6px;">
	  <a href="#createFeed" class="btn btn-info" data-toggle="collapse"><?php echo '<span style="display: inline-block; width: 72px;"></span>';?>+ Post a new Feed!<?php echo '<span style="display: inline-block; width: 72px;"></span>';?></a>
	  <div id="createFeed" class="collapse" style=" padding: 5px; padding-top: 10px; padding-bottom: 10px; background-color: white;" > 
	  
	    <form action="feed.php" method="post">
            <div class="field-wrap">
            <textarea type = "text" name="FeedContent" placeholder="Feed Content*" style="height: 300px;" ></textarea>
          </div>
          <button class="button button-block" style="font-size: 10px; line-height: 1px; margin: auto; margin-bottom: -5px; margin-top: -35px;  height: 30px; width:60px"/>Post!</button>
          </form>
          
	  </div>
	</div>
  
	<div class="action_buttons_header" style="width: 300px; float: right; clear: right; margin: 10px auto; padding-left: 6px; padding-right: 6px">
	  <a href="#userInDB" class="btn btn-info" data-toggle="collapse"><?php echo '<span style="display: inline-block; width: 49px;"></span>';?>+ People you could follow:<?php echo '<span style="display: inline-block; width: 49px;"></span>';?></a>
	  <div id="userInDB" class="collapse" style=" padding: 5px; padding-top: 10px; padding-bottom: 10px; background-color: white;" >
	    <?php 
	    	$sql = 'SELECT User.name, User.user_id FROM User where User.user_id NOT IN (SELECT follow_id FROM Follow where Follow.user_id="'.$thisUserid.'") AND User.user_id !="'.$thisUserid.'"';
	    	$result = mysql_query($sql, $link);
    		while ($row = mysql_fetch_assoc($result)) {
				echo "<form action='follow.php' method='post' style='display: inline-block;'>";
				echo "<input type=hidden name=otherUserid value=" . $row['user_id']. ">";
				echo "<input type=hidden name=thisUserid value=" . $thisUserid. ">";
				echo "<input type='submit' value='Follow' style='width: 40px; height:17px; padding: 0;background: none; color:green;font-size: 11px;' >";
				echo "</form>";
				echo '<span style="display: inline-block; width: 5px;"></span>';
    			echo $row['name']. "<br>" . PHP_EOL;
    		}
    	?>
	  </div>
	</div>
	
	<?php 
	    	$sql = 'SELECT f.*, u.name FROM Feed f INNER JOIN User u ON (f.user_id=u.user_id) WHERE f.user_id IN (SELECT Follow.follow_id FROM Follow WHERE user_id="' .$thisUserid. '") ORDER BY f.feed_id DESC';
	    	$result = mysql_query($sql, $link);
    		while ($row = mysql_fetch_assoc($result)) {
				echo "<div class=custom>";
				echo "<p><strong style=color:Green>" .$row['name']. "</strong>";
				echo '<span style="display: inline-block; width: 5px;"></span>·';
				echo '<span style="display: inline-block; width: 5px;"></span>';
				echo "<font color=#A9A9A9 size=2>" . $row['create_date']. "</font>" . "<br>" . PHP_EOL;
				echo $row['feed_text']. "<br>" . PHP_EOL;
				
				$sql2 = 'SELECT * FROM LOVE WHERE user_id="' . $thisUserid . '" AND feed_id="' . $row['feed_id'] . '"'; 
				$result2 = mysql_query($sql2, $link);
				$num_rows = mysql_num_rows($result2);
				if ($num_rows == 0) {
					echo "<form action='like.php' method='post' style='display: inline-block;'>";
					echo "<input type=hidden name=thisFeedid value=" . $row['feed_id']. ">";
					echo "<input type=hidden name=thisUserid value=" . $thisUserid. ">";
					echo "<input type='submit' value='Like' style='width: 45px; height:22px; padding: 0;background: none; color:green;font-size: 15px;' >";
					echo "</form>";
					echo '<span style="display: inline-block; width: 5px;"></span>';
				} else {
					echo "<form action='unlike.php' method='post' style='display: inline-block;'>";
					echo "<input type=hidden name=thisFeedid value=" . $row['feed_id']. ">";
					echo "<input type=hidden name=thisUserid value=" . $thisUserid. ">";
					echo "<input type='submit' value='UnLike' style='width: 65px; height:22px; padding: 0;background: none; color:green;font-size: 15px;' >";
					echo "</form>";
					echo '<span style="display: inline-block; width: 5px;"></span>';
				}
				
				echo "<form action='comment.php' method='post' style='display: inline-block;'>";
				echo "<input type=hidden name=thisFeedid value=" . $row['feed_id']. ">";
				echo "<input type=hidden name=thisUserid value=" . $thisUserid. ">";
				echo "<input type='submit' value='Comment' style='width: 80px; height:22px; padding: 0;background: none; color:green;font-size: 15px;' >";
				echo "</form>";

	  			
				echo "</p></div>";
    		}
    	?>

  	<?php 
  	
  		mysql_free_result($result);
//   		mysql_free_result($result2);
    	mysql_close($link);

    ?>
  
  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
    
  </body>

  </html>
