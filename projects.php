<?php
//connect to the database
require_once('Connectdb.php');

//set default search parameters
$search_title = '';
$search_start_date = '';

//if the form is submitted, update the search parameters
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['clear'])){
		$search_title = '';
        $search_start_date = '';
	}else{
    	$search_title = $_POST['search_title'] ?? '';
    	$search_start_date = $_POST['search_start_date'] ?? '';
	}
}

//query to retrieve all project information
$sql = "SELECT pid, title, start_date, description FROM projects WHERE 1=1";
if (!empty($search_title)) {
    $sql .= " AND title LIKE '%$search_title%'";
}
if (!empty($search_start_date)) {
    $sql .= " AND start_date = '$search_start_date'";
}

//execute the query
$statement = $db->query($sql);

//fetch the results as an associative array
$projects = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
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
<body>

	<h1>Project List</h1>

	<form id="searchForm" method="POST" action="">
        <label for="search_title">Search by title:</label>
        <input type="text" id="search_title" name="search_title" value="<?php echo $search_title; ?>">

        <label for="search_start_date">Search by start date:</label>
        <input type="date" id="search_start_date" name="search_start_date" value="<?php echo $search_start_date; ?>">

        <button type="submit">Search</button>
		<button type="button" onclick="clearSearch()">Clear</button>
    </form>

	<script>
	function clearSearch() {
		document.getElementById("search_title").value = "";
        document.getElementById("search_start_date").value = "";
        document.getElementById("searchForm").submit();
	}
	</script>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Start Date</th>
				<th>Description</th>
                <th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($projects as $project) { ?>
				<tr>
					<td><?php echo $project['pid']; ?></td>
					<td><?php echo $project['title']; ?></td>
					<td><?php echo $project['start_date']; ?></td>
					<td><?php echo $project['description']; ?></td>
                    <td>
                        <form action="projectdetails.php" method="get">
							<input type="hidden" name="id" value="<?php echo $project['pid']; ?>">
                            <button type="submit">Details</button>
                        </form>

                    </td>   
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<p>
		Login here <a href="Index.php">Login</a>
	</p>
    <p>
		Signup here <a href="SignUp.php">Sign up</a>
	</p>

</body>
</html>
