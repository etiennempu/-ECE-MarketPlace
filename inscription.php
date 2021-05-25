<?php  
	echo "je rentre peu-etre <br>";
		if($_SERVER["REQUEST_METHOD"] == "POST") {

			echo "je suis rentre fdp <br>";
			$firstname = isset($_POST["firstname"])? $_POST["firstname"] : ""; 
			$name = isset($_POST["name"])? $_POST["name"] : "";
			$mail = isset($_POST["mail"])? $_POST["mail"] : "";
			$numero = isset($_POST["num"])? $_POST["num"] : "0";
			$password = isset($_POST["password"])? $_POST["password"] : "";

			// Variable connexion
			$user = "root";
			$mdp = "";
			$addr = "localhost";

			// Connect to MySQL server
			$db_handle = mysqli_connect($addr,$user, $mdp);

			if($db_handle) {
					echo "Connected ! <br>";
			} 
			else {
				die("Unable to connect. ERROR" . mysqli_error($db_handle));
			}

			$sql = "SET NAMES utf8";
			$result = mysqli_query($db_handle, $sql);


			$db_found = mysqli_select_db($db_handle, "ece-marketplace");

			echo $firstname."<br>";
			echo $name."<br>";
			echo $mail."<br>";
			echo $numero."<br>";
			echo $password."<br>";


			if($db_found){
				$sql = "INSERT INTO user (nom, prenom, mail, numero, mdp, type, photo, id_adresse) VALUES ('$name', '$firstname', '$mail', '$numero', '$password', 1, '0', '0')";
				$result = mysqli_query($db_handle, $sql);
				echo $result;
			}

			mysqli_close($db_handle);
			echo "connection closed.";

			/*header('Location: index.php');
			exit();*/

		}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Formulaire d'inscription</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<form action="inscription.php" method="post">
					<table>
						<tr>
							<td><label>Prénom: </label></td>
							<td><input type="text" name="firstname" placeholder="Votre prénom"></td>
						</tr>
						<tr>
							<td><label>Nom: </label></td>
							<td><input type="text" name="name" placeholder="Votre nom"></td>
						</tr>
						<tr>
							<td><label>Adresse mail: </label></td>
							<td><input type="mail" name="mail" placeholder="Votre adresse mail"></td>
						</tr>
						<tr>
							<td><label>Numéro de téléphone: </label></td>
							<td><input type="number" name="num" placeholder="Votre numéro de téléphone"></td>
						</tr>
						<tr>
							<td><label>Mot de passe: </label></td>
							<td><input type="password" name="password" placeholder="Votre mot de passe"></td>
						</tr>
						<tr>
							<td><label>Adresse: </label></td>
							<td><input type="text" name="adress" placeholder="Votre adresse"></td>
						</tr>
					</table>
					<button name="confirmer">Je confirme mes informations</button>
				</form>				
			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>