<?php

	// Database configuration 

	$sernamename = "localhost";
	$username    = "root";
	$passoword   = "";
	$databasename= "ongbata_v1";

	// Create database connection
	$connect = mysqli_connect($sernamename, $username,$passoword,$databasename);

	// Check connection
	if ($connect->connect_error) {
		die("Connection failed". $connect->connect_error);
	}

?>