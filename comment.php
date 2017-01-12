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
    	padding-bottom: 0.1em;
    }
    
    .custom2 {
    	background-color:#DCDCDC;
    	max-width: 600px; 
    	margin: 12px auto; 
    	border-radius: 4px;
    	box-shadow: none;
    	padding: 40px; 
    	padding-top: 5px; 
    	padding-bottom: 20px;
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

	<div>

		<p>
		<?php
			if (!$link = mysql_connect('localhost', 'root', '')) {
				echo 'Could not connect to mysql';
				exit;
			}
			
			if (!mysql_select_db('Project1', $link)) {
				echo 'Could not select database';
				exit;
			}
		
			$thisUserid = $_POST["thisUserid"];
			$thisFeedid = $_POST["thisFeedid"];
			
			
			$sql = 'SELECT u.name, f.* FROM Feed f INNER JOIN User u ON (f.user_id=u.user_id) WHERE f.feed_id="' . $thisFeedid . '"';
			$result = mysql_query($sql, $link);
			$row = mysql_fetch_assoc($result);
			echo "<strong style='color:Green'>" .$row['name'] . "</strong>";
			echo '<span style="display: inline-block; width: 5px;"></span>·';
			echo '<span style="display: inline-block; width: 5px;"></span>';
			echo "<font color=#A9A9A9 size=2>" . $row['create_date']. "</font>" . "<br>" . PHP_EOL;
			echo $row['feed_text']. "<br><br>" . PHP_EOL;
			
			echo "<strong style='color:Green'>Comments: </strong><br>";
			echo "<div class='custom2'>";
			$sql = 'SELECT u.name, c.comment_id, c.user_id, c.comment_text FROM User u INNER JOIN Comment c ON (c.user_id=u.user_id) WHERE c.feed_id="' . $thisFeedid. '"ORDER BY c.comment_id ASC';
	  		$result = mysql_query($sql, $link);
			while ($row = mysql_fetch_assoc($result)) {
				echo "<strong style='color:Gray'>" . $row['name'] . "</strong>";
				
				if ($thisUserid == $row['user_id']) {
				echo '<span style="display: inline-block; width: 52px;"></span>';
				echo "<form action='deleteComment.php' method='post' style='display: inline-block;'>";
				echo "<input type=hidden name=thisCommentid value=" . $row['comment_id']. ">";
				echo "<input type=hidden name=thisUserid value=" . $thisUserid . ">";
				echo "<input type=hidden name=thisFeedid value=" . $thisFeedid . ">";
				echo "<input type='submit' value='Delete' style='width: 60px; height:17px; padding: 0;background: none; color:green;font-size: 11px;' >";
				echo "</form>";
				}
				echo "<br>";
		    	echo $row['comment_text']. "<br>" . PHP_EOL; 
				echo '--------------------------------------------------------------'. "<br>" . PHP_EOL;
			}
		?>
			<form action="addComment.php" method="post">
			<input type=hidden name=thisUserid value=<?php echo $thisUserid?>>
			<input type=hidden name=thisFeedid value=<?php echo $thisFeedid?>>
			<textarea type = "text" name="commentContent" placeholder="Comment Content*" style="height: 200px; color: gray;background-color: white;" ></textarea>
			<button class="button button-block" style="font-size: 20px;line-height: 1px;height: 40px;">Comment!</button>
			</form>
			
			
		<?php
			echo "</div>";
    	?>
    	<script>
		    function visitPage(){
		    	window.location.href='Main.php';
		    }
		</script>
		<button class="button button-block" style="font-size: 20px;line-height: 1px;height: 40px;background-color:gray;" onclick="visitPage();">Close</button>
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
