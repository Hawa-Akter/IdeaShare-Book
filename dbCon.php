<?php
//Connect to database

function connect($setup = FALSE){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "ewsd_gone";

	// Create connection
	if($setup)
		$con = new mysqli($servername, $username, $password);
	else
		$con = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	} 
	return $con;
	//echo "Connected successfully";
}

//ideas without cmnt

//SELECT id FROM ideas WHERE id NOT IN (SELECT idea_id FROM comments)