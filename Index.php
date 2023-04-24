<?php

	session_start();
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = bin2hex(random_bytes(32));
	}
	//if the form has been submitted
	if (isset($_POST['submitted'])){

		if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
			exit('Invalid CSRF token');
		}

		if ( !isset($_POST['username'], $_POST['password']) ) {
		// Could not get the data that should have been sent.
		 exit('Please fill both the username and password fields!');
	    }
		// connect DB
		require_once ("Connectdb.php");
		try {
		//Query DB to find the matching username/password
		//using prepare/bindparameter to prevent SQL injection.
			$stat = $db->prepare('SELECT uid, username, password FROM users WHERE username = ?');
			$stat->execute(array($_POST['username']));
			$row = $stat->fetch(PDO::FETCH_ASSOC);
		    
			// fetch the result row and check 
			if ($stat->rowCount()>0){  // matching username

				if (password_verify($_POST['password'], $row['password'])){ //matching password
					
					//??recording the user session variable and go to loggedin page?? 
				  	session_start();
					$_SESSION["username"]=$_POST['username'];
					$_SESSION["uid"] = $row['uid'];
					header("Location:DataBase.php");
					exit();
				
				} else {
				 echo "<p style='color:red'>Error logging in, password does not match </p>";
 			    }
		    } else {
			 //else display an error
			  echo "<p style='color:red'>Error logging in, Username not found </p>";
		    }
		}
		catch(PDOException $ex) {
			echo("Failed to connect to the database.<br>");
			echo($ex->getMessage());
			exit;
		}

  }
?>
<html>
<head>
    <title>Login</title>
</head>

<body>

    <h2>Login</h2>
    <form method="post" action="Index.php">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
        <label>Username:</label>
        <input type="text" name="username" size="15" maxlength="25" />
        <label>Password:</label>
	    <input type="password" name="password" size="15" maxlength="25" />

        <input type="submit" value="Login" />
	    <input type="reset" value="clear"/>
        <input type="hidden" name="submitted" value="TRUE" />
	<p>
		Sign Up Here <a href="SignUp.php">Sign Up</a>
	</p>
	<p>
		projects page here <a href="projects.php">projects</a>
	</p>
    </form>

</body>

</html>