<?php

session_start();
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = bin2hex(random_bytes(32));
	}

//if the form has been submitted
if (isset($_POST['submitted'])){
 #prepare the form input

  // connect to the database
  require_once('Connectdb.php');
	
  $username=isset($_POST['username'])?$_POST['username']:false;
  $password=isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT):false;
  $email=isset($_POST['email'])?$_POST['email']:false;
  
  if (!($username)){
	echo "Username wrong!";
    exit;
	}
  if (!($password)){
	exit("password wrong!");
	}
  if (!($email)){
	exit("email wrong!");
	}
 try{
	
	#register user by inserting the user info 
	$stat=$db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
	$stat->execute(array($username, $password,$email));
	
	$id=$db->lastInsertId();
	echo "Congratulations! You are now registered. Your ID is: $id  ";  	
	
 }
 catch (PDOexception $ex){
	echo "Sorry, a database error occurred! <br>";
	echo "Error details: <em>". $ex->getMessage()."</em>";
 }
}
?>


<html>
<head>
  <title>Registration System </title>
</head>
<body>
  <h2>Register</h2>
  <form method = "post" action="SignUp.php">
  <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
	Username: <input type="text" name="username" /><br>
	Password: <input type="password" name="password" /><br>
	Email: <input type="email" name="email" /><br><br>

	<input type="submit" value="Register" /> 
	<input type="reset" value="clear"/>
	<input type="hidden" name="submitted" value="true"/>
  </form>  
  <p> Already a user? <a href="Index.php">Log in</a>  </p>

</body>
</html>