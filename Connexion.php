<?php 

	session_start();

	echo"hello";
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


	$db_found = mysqli_select_db($db_handle, "ecemarketplace");

if($db_found){
	$sql = "
				SELECT *
				FROM user
				WHERE prenom LIKE 'Etienne'
			";


		

		$result = mysqli_query($db_handle, $sql);

		while($data = mysqli_fetch_assoc($result)) {
			foreach($data as $key => $value){
						//echo $key . " : " . $value . "<br>";
						$_SESSION["$key"]=$value;
						 //echo "<br>----------------------- <br>";
						 //echo $key . " : " . $_SESSION['prenom'] . "<br>";
						
			}	
			//echo "----------------------- <br>";
		}

	} else {
		echo "DB not found";
	}

mysqli_close($db_handle);
	echo "connection closed.";

header('Location: accueil.php');
exit();

	
 ?>
