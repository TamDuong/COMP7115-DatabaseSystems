<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="css/normalize.css">
    
        <link rel="stylesheet" href="css/style.css">
	<style>
		div.success { 	background: rgba(19, 35, 47, 0.9);
						padding: 40px;
						max-width: 600px;
						margin: 40px auto;
						border-radius: 4px;
						box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);}
		div.success2 {	width: 75%;
    					margin: auto; 
    					border: 1px solid #a0b3b0;
/* 						background: #1ab188; */
						color: #a0b3b0;}
	</style>
  </head>

  
  <body>
    
     <?php
		if (!$link = mysql_connect('localhost', 'root', '')) {
		    echo 'Could not connect to mysql';
		    exit;
		}
		
		if (!mysql_select_db('Project1', $link)) {
		    echo 'Could not select database';
		    exit;
		}
		$passwd = $_POST["signupPasswd"];
		$name =  $_POST["fname"] . ' ' . $_POST["lname"];
		$email =  $_POST["signupEmail"];
		
		$sql = 'INSERT INTO User (password, name, email) VALUES ("' 
		  														.$passwd
																.'", "'
																.$name
																.'", "'
																.$email
																.'")';				// . mean concatenation for string in a single quotes
		$result = mysql_query($sql, $link);
		
		if (!$result) {
		    echo "DB Error, could not query the database\n";
		    echo 'MySQL Error: ' . mysql_error();
		    exit;
		}
				
		mysql_close($link);	
	?>  

	<div class = "success">
		<h1>YAY!</h1>
		<h3 style="color:white;text-align:center">Your account has been successfully created.</h3>
		<div class = "success2">
			<h5 style="padding-left: 10px">Name: <?php echo $name; ?></h5>
			<h5 style="padding-left: 10px">Email: <?php echo $email; ?></h5>
			<h5 style="padding-left: 10px">Password: <?php echo $passwd; ?></h5>
		</div>
		<button onclick="location.href = '/DatabaseProject/index.php';" class="button button-block" style="font-size: 20px; line-height: 12px; margin: 40px auto;height: 40px; width:100px">Log in</button>
	</div>
	
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

  </body>
</html>
