<?php

	session_start();
	//unset($_SESSION["username"]);
	session_destroy();

?>
 <H2> Logged out now! </H2> 
 <p>Would like to log in again? <a href="Index.php">Log in</a>  </p>
