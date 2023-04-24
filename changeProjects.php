<?php

session_start();
	if (!isset($_SESSION['token'])) {
		$_SESSION['token'] = bin2hex(random_bytes(32));
	}

//connect to the database
require_once('Connectdb.php');

//retrieve the project ID from the URL parameter
$project_id = $_GET['id'];

//query to retrieve the project information
$sql = "SELECT projects.title, projects.start_date, projects.end_date, projects.phase, projects.description, users.email 
        FROM projects 
        JOIN users ON projects.uid = users.uid 
        WHERE projects.pid = :pid";

//prepare the statement
$statement = $db->prepare($sql);

//bind the parameter
$statement->bindParam(':pid', $project_id, PDO::PARAM_INT);

//execute the statement
$statement->execute();

//fetch the result as an associative array
$project = $statement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit <?php echo $project['title']; ?></title>

    <style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>

</head>
<body>

	<h1>Edit <?php echo $project['title']; ?></h1>
	
	<form method="post" action="updateProjects.php?id=<?php echo $project_id; ?>">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
		<table>
			<tr>
				<td><label for="title">Title:</label></td>
				<td><input type="text" id="title" name="title" value="<?php echo $project['title']; ?>"></td>
			</tr>
			<tr>
				<td><label for="start_date">Start Date:</label></td>
				<td><input type="date" id="start_date" name="start_date" value="<?php echo $project['start_date']; ?>"></td>
			</tr>
			<tr>
				<td><label for="end_date">End Date:</label></td>
				<td><input type="date" id="end_date" name="end_date" value="<?php echo $project['end_date']; ?>"></td>
			</tr>
			<tr>
				<td><label for="phase">Phase:</label></td>
				<td><input type="text" id="phase" name="phase" value="<?php echo $project['phase']; ?>"></td>
			</tr>
			<tr>
				<td><label for="description">Description:</label></td>
				<td><textarea id="description" name="description"><?php echo $project['description']; ?></textarea></td>
			</tr>

		</table>
		<input type="submit" name="submit" value="Submit">
		<input type="button" value="Cancel" onclick="location.href='DataBase.php';">
	</form>
	
</body>
</html>
