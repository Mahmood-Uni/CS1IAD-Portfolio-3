
<?php
	//start the session, check if the user is not logged in, redirect to start
	session_start();	

	if (!isset($_SESSION['username'])){
		header("Location: Index.php");
		exit();
	}
	$username=$_SESSION['username'];
	echo "<h2> Welcome ".$_SESSION['username']."! </h2>";
	
	// include the connectdb.php to connect to the database, the PDO object is called $db and run the query to get all the course information 
	require_once ('Connectdb.php');  
	try {
		$query="SELECT * FROM projects WHERE uid = ?";
		//run  the query
		$stat = $db->prepare($query);
    	$stat->execute([$_SESSION['uid']]);
    	$rows = $stat->fetchAll(PDO::FETCH_ASSOC);
		
	//display the course list in a table 	
	if ($rows && count($rows) > 0) {		?>	
		<head>

	<title>Home</title>
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
	<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Start Date</th>
				<th>End Date</th>
				<th>Phase</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $project) { ?>
                <tr>
                    <td><?php echo $project['pid']; ?></td>
                    <td><?php echo $project['title']; ?></td>
                    <td><?php echo $project['start_date']; ?></td>
					<td><?php echo $project['end_date']; ?></td>
					<td><?php echo $project['phase']; ?></td>
                    <td><?php echo $project['description']; ?></td>
                    <td>
                        <form action="changeProjects.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $project['pid']; ?>">
                            <button type="submit">Change</button>
                        </form>
                    </td>   
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
    } else {
        echo  "<p>No project in the list.</p>\n"; //no match found
    }
}	
	catch (PDOexception $ex){
		echo "Sorry, a database error occurred! <br>";
		echo "Error details: <em>". $ex->getMessage()."</em>";
	}

	//display the logout choice 	
?>	
  
  <p><a href="createProjects.php">Create a new project</a></p>

<?php
	//display the logout choice 	
?>	
<p>Would you like to log out? <a href="Logout.php">Log out</a>  </p>

