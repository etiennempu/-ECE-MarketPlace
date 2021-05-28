<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {

	$id = isset($_POST["suprimer"])? $_POST["suprimer"] : ""; 

	echo $id;
	$user = "root";
	$mdp = "";
	$addr = "localhost";				
	// Connect to MySQL server
										
	$db_handle = mysqli_connect($addr,$user, $mdp);

	if($db_handle)
	{
												
	}else 
	{
		die("Unable to connect. ERROR" . mysqli_error($db_handle));
											}

	$sql = "SET NAMES utf8";
	$result = mysqli_query($db_handle, $sql);

	$db_found = mysqli_select_db($db_handle, "ece-marketplace");

	if($db_found)
	{
		echo "hello";
		$sql = "DELETE FROM `user` where id='$id' ";

		$result = mysqli_query($db_handle, $sql);
		//$data=mysqli_fetch_assoc($result);

	}
	mysqli_close($db_handle);
	}
	header('Location: votreCompte.php');
?>