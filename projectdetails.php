<?php
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
	<title><?php echo $project['title']; ?> Details</title>

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

	<h1><?php echo $project['title']; ?> Details</h1>
    <table>
        <thead>
        <tr>
				<th>Title</th>
				<th>Start Date</th>
				<th>End Date</th>
                <th>Phase</th>
                <th>Description</th>
                <th>Email</th>
			</tr>
        <tbody>
	        <tr>
		        <td><?php echo $project['title']; ?></td>
		        <td><?php echo $project['start_date']; ?></td>
		        <td><?php echo $project['end_date']; ?></td>
                <td><?php echo $project['phase']; ?></td>
                <td><?php echo $project['description']; ?></td>
                <td><?php echo $project['email']; ?></td>
            </tr>
        </tbody>
    </table>
    <p>
		projects page here <a href="projects.php">projects</a>
	</p>
    <p>
		Login here <a href="Index.php">Login</a>
	</p>
    <p>
		Signup here <a href="SignUp.php">Sign up</a>
	</p>
</body>
</html>
