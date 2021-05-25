<?php

// Variable connexion
	$user = "root";
	$mdp = "";
	$addr = "localhost";

	// Connect to MySQL server
	$db_handle = mysqli_connect($addr,$user, $mdp);

	if($db_handle) {
		echo "Connected ! <br>";
	} else {
		die("Unable to connect. ERROR" . mysqli_error($db_handle));
	}

	$sql = "SET NAMES utf8";
	$result = mysqli_query($db_handle, $sql);


	$db_found = mysqli_select_db($db_handle, "myDB");

	mysqli_close($db_handle);
	echo "connection closed.";


?>