<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {

			$firstname = isset($_POST["firstname"])? $_POST["firstname"] : ""; 
			$name = isset($_POST["name"])? $_POST["name"] : "";
			$mail = isset($_POST["mail"])? $_POST["mail"] : "";
			$numero = isset($_POST["num"])? $_POST["num"] : "0";
			$password = isset($_POST["password"])? $_POST["password"] : "";
			$adresse = isset($_POST["adress"])? $_POST["adress"] : "";
			
			if($firstname==NULL){
				$firstname=$_SESSION['prenom'];
			}else{
				$_SESSION['prenom']=$firstname;
			}

			if($name==NULL){
				$name=$_SESSION['nom'];
			}else{
				$_SESSION['nom']=$name;
			}

			if($mail==NULL){
				$mail=$_SESSION['mail'];
			}else{
				$_SESSION['mail']=$mail;
			}

			if($numero==NULL){
				$numero=$_SESSION['numero'];
			}else{
				$_SESSION['numero']=$numero;
			}

			if($adresse==NULL){
				$adresse=$_SESSION['id_adresse'];
			}else{
				$_SESSION['id_adresse']=$adresse;
			}

			if($password==NULL){
				$password=isset($_POST["password2"])? $_POST["password2"] : "";
			}
			

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

			$id=$_SESSION['id'];
			if($db_found){

				$sql = "UPDATE user SET nom='$name' ,prenom='$firstname',mail='$mail',numero='$numero',mdp= '$password',adresse = '$adresse' WHERE id = '$id' ";
				$result = mysqli_query($db_handle, $sql);
				var_dump($sql);
			}

			mysqli_close($db_handle);

			header('Location: votreCompte.php');
			//exit();

		}	

?>
<!DOCTYPE html>
<html>
<head>
	<title>index</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="wrapper container-fluid">

		<!--HEADER-->
		<div class="header container">
			<div class="row">	
		<!--LOGO-->
				<div class="col-9">
					<a href="accueil.php"><img id="logo" src="logoMarketPlace.png" alt="logo ECE Market Place"></a>
				</div>
				<div class="col-3">
						<?php 
							function initiales($nom){
                                   $nom_initiale = ''; // déclare le recipient
                                   $n_mot = explode(" ",$nom);
                                foreach($n_mot as $lettre){
                                        $nom_initiale .= $lettre{0};
                                    }
                                   return strtoupper($nom_initiale);
                                   }
							if($_SESSION['id']!=0){

								echo '<label id="prenom">'.initiales($_SESSION['prenom']) .' </label>';
								echo '<label id="nom">'.initiales($_SESSION['nom']) .'</label>';
								echo '<a href="deconnexion.php"><label id="deconnexion">Deconnexion</label></a>';
							}
							else{
								
								echo '<a href="inscription.php"><label id="inscription">Inscription </label></a>';
								echo '<a href="connexion.php"><label id="connexion">Connexion</label></a>';
							}

						 ?>
				</div>
			</div>
		</div>

		<!--NAVIGATION-->
		<div class="navigation container">
			<div class="row">
				<nav class="col navbar navbar-expand-lg navbar-light">
					 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" name="MENU"><span class="navbar-toggler-icon"></span>
	   				</button>
	   				<div id="navbarContent" class="collapse navbar-collapse navbar-light">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="accueil.php"><img src="accueil.png" alt="bouton Accueil"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="toutParcourir.php"><img src="toutParcourir.png" alt="bouton Tout Parcourir"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="notifications.php"><img src="notifs.png" alt="bouton Notifications"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="panier.php"><img src="panier.png" alt="bouton Panier"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="votreCompte.php"><img src="votreCompteSelect.png" alt="bouton Votre Compte"></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<!--Reste de la page-->
		<div class="section container">
			<div class="row">
				<div class="col">
					<form action="modifiercompte.php" method="post">
					<img id="logoInscription" src="logoMarketPlace.png" alt="logo ECE Market Place">
					<h1 id="titreInscription">modification</h1>
					<table>
						<tr>
							<td><input type="text" name="firstname" class="form-control"  placeholder="Votre prénom"  size="50px"></td>
						</tr>
						<tr>
							<td><input type="text" name="name" class="form-control"  placeholder="Votre nom" size="50px"></td>
						</tr>
						<tr>
							<td><input type="mail" name="mail" class="form-control"  placeholder="Votre adresse mail" size="50px"></td>
						</tr>
						<tr>
							<td><input type="number" name="num" class="form-control" placeholder="Votre numéro de téléphone" size="50"></td>
						</tr>
						<tr>
							<td><input type="password" name="password" class="form-control"  placeholder="Votre mot de passe" size="50px"></td>
						</tr>
						<tr>
							<td><input type="text" name="adress" class="form-control"  placeholder="Votre adresse" size="50px"></td>
						</tr>
						<tr>
						<td><input type="password" name="password2" class="form-control" required="required" placeholder="verification de votre mot de passe" size="50px"></td>
						</tr>
					</table>
					<button id="inscrire" class="btn btn-primary" type="submit">modifier</button>
				</form>	
				</div>
			</div>
			<div class="row">
				<div class="col">
					<h1>FOOTER</h1>
				</div>
			</div>
		</div>

	</div>


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
