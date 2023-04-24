<?php

$db_host = 'localhost';
$db_name = 'u_210132384_db';
$username = 'u-210132384';
$password = 'TmQ55OKOB6sKZhH';

try {
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
	#$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $ex) {
	echo("Failed to connect to the database.<br>");
	echo($ex->getMessage());
	exit;
}
?>