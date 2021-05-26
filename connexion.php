<?php 

	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{

			
			$mail = isset($_POST["mail"])? $_POST["mail"] : ""; 
			$mdpa = isset($_POST["password"])? $_POST["password"] : "";
				// Variable connexion
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
				$sql = "SELECT * FROM user WHERE mail ='$mail' AND mdp ='$mdpa' ";
					
					$result = mysqli_query($db_handle, $sql);
					
					$data = mysqli_fetch_assoc($result);
					if($data!=NULL)
					{
						

							foreach($data as $key => $value)
							{
	
										$_SESSION["$key"]=$value;	 		
							}	

							mysqli_close($db_handle);
							echo "connection closed. <br>";

							echo $_SESSION['nom']."<br>";
							header('Location: accueil.php');
							exit();

					}
					else
					{
						
						echo "<script>alert(\"erreur rentrez des champs valides\")</script>";
						// header('Location: connexion.php');
						//exit();

					}
			}
			else 
			{
				echo "DB not found <br>";
			}
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
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<form action="connexion.php" method="post">
					<img id="logoInscription" src="logoMarketPlace.png" alt="logo ECE Market Place">
					<h1 id="titreConnexion">CONNEXION</h1>
					<table>
						<tr>
							<td><input type="mail" name="mail" class="form-control" required="required" placeholder="Votre adresse mail" size="50px"></td>
						</tr>
						<tr>
							<td><input type="password" name="password" class="form-control" required="required" placeholder="Votre mot de passe" size="50px"></td>
						</tr>
					</table>
					<button id="connecter" class="btn btn-primary" type="submit">SE CONNECTER</button>
				</form>				
			</div>
			<div class="fondInscription col">

			</div>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>