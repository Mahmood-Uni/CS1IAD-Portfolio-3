<?php
//connect to the database
require_once('Connectdb.php');

//retrieve the project ID from the form
$project_id = $_GET['id'];

//retrieve the updated project information from the form
$title = $_POST['title'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$phase = $_POST['phase'];
$description = $_POST['description'];

//query to update the project information in the database
$sql = "UPDATE projects 
        SET title = :title, start_date = :start_date, end_date = :end_date, phase = :phase, description = :description 
        WHERE pid = :pid";

//prepare the statement
$statement = $db->prepare($sql);

//bind the parameters
$statement->bindParam(':title', $title);
$statement->bindParam(':start_date', $start_date);
$statement->bindParam(':end_date', $end_date);
$statement->bindParam(':phase', $phase);
$statement->bindParam(':description', $description);
$statement->bindParam(':pid', $project_id, PDO::PARAM_INT);

//execute the statement
$statement->execute();

//redirect the user back to the database.php file
header('Location: DataBase.php');
exit;
?>
