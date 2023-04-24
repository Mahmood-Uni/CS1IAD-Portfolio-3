<?php
session_start();
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = bin2hex(random_bytes(32));
	}

if (!isset($_SESSION['username'])){
	header("Location: Index.php");
	exit();
}

$username = $_SESSION['username'];
$user_id = $_SESSION['uid'];

// prepare the form input
if (isset($_POST['submitted'])){
	
	//connect to the database
	require_once('Connectdb.php');
	
	$title = isset($_POST['title']) ? $_POST['title'] : false;
	$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : false;
	$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : false;
	$phase = isset($_POST['phase']) ? $_POST['phase'] : false;
	$description = isset($_POST['description']) ? $_POST['description'] : false;
	
	if (!($title && $start_date && $end_date && $phase && $description)){
		echo "Please fill in all the fields!";
		exit();
	}
	
	//insert the new project into the database
	try {
		$stmt = $db->prepare("INSERT INTO projects (title, start_date, end_date, phase, description, uid) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $start_date, $end_date, $phase, $description, $user_id]);

		
		echo "New project created successfully!";
	} catch (PDOException $ex) {
		echo "Sorry, a database error occurred! <br>";
		echo "Error details: <em>". $ex->getMessage()."</em>";
	}
	
	exit();
}
?>

<html>
<head>
  <title>Create New Project</title>
</head>
<body>
  <h2>Create New Project</h2>
  <form method="post" action="createProjects.php">
  <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
	Title: <input type="text" name="title" /><br>
	Start Date: <input type="date" name="start_date" /><br>
	End Date: <input type="date" name="end_date" /><br>
	Phase: <input type="text" name="phase" /><br>
	Description: <textarea name="description"></textarea><br><br>

	<input type="submit" value="Create" /> 
	<input type="reset" value="Clear"/>
	<input type="hidden" name="submitted" value="true"/>
  </form>  
  <p><a href="DataBase.php">Back to User Page</a></p>
</body>
</html>
