<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();


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
	   				<div id="navbarContent" class="collapse navbar-collapse">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="accueil.php"><img src="accueil.png" alt="bouton Accueil"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="toutParcourir.php"><img src="toutParcourir.png" alt="bouton Tout Parcourir"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="notifications.php"><img src="notifsSelect.png" alt="bouton Notifications"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="panier.php"><img src="panier.png" alt="bouton Panier"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="votreCompte.php"><img src="votreCompte.png" alt="bouton Votre Compte"></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<!--Reste de la page-->
		<div class="container">
			<div class="row">
				<div class="col">
					<h2>C'est ici que vous avez le suivi de vos negociation avec les clients</h2>
					<?php 
							$id_vendeur=$_SESSION['id'];
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
									
										
										$sql = "SELECT * FROM negociation WHERE vendeur_id='$id_vendeur' ";
										
										$result = mysqli_query($db_handle, $sql);
										$data = mysqli_fetch_assoc($result);
										$temp2=0;
										$negociation=[];
										if($data!=NULL)
										{
											
												
												do{
												foreach($data as $key => $value)
												{
						
															$negociation["$temp2"]=$value;
															$temp2=$temp2+1;		
												}
												}while ($data = mysqli_fetch_assoc($result));

												
										}
										
										
										mysqli_close($db_handle);
										//echo "connection closed. <br>";
								}
								else 
								{
									echo "DB not found <br>";
								}
								//---------------------negoc-----------------------	
						
								//echo $enchere['$temp']. "<br>";
							if($temp2>0 ){
								
								echo "Voici vos negociations en cours:";
								echo "<table border=\'1\'>";
								// echo "<tr>";
								// echo "<th>" ."Voici vos negociations en cours:". "</th>";
								// echo "</tr>";
								echo "<tr>";

								//echo "<th>" . "ID" . "</th>";
								echo "<th>" . "Votre proposition" . "</th>";
								echo "<th>" . "Proposition du client" . "</th>";
								echo "<th>" . "évolution de la négosiation" . "</th>";
								echo "<th>" . "votre offre" . "</th>";
								echo "<th>" . "soumettre" . "</th>";
								echo "</tr>";
								
								for($i=0;$i<$temp2;$i=$i+7){
									echo "<tr>";
									$t1=$i+4;
									$t2=$i+3;
									$t3=$i+5;
									$t4=$i+1;
									$t5=$i;
									$t6=$i+6;

									$idnegociation= $negociation["$t5"];
									echo "<td>" . $negociation["$t1"] . "€</td>";
									echo "<td>" . $negociation["$t2"] . "€</td>";
									echo "<td>" . $negociation["$t3"] . "/9</td>";
									echo "<form action='notificationVendeur.php' method='post'>";
									echo "<td>"."<input type='number' name='offre' class='form-control' required='required'placeholder='proposition' size='10px'>"."</td>";
									if($negociation["$t3"]==1|| $negociation["$t3"]==3 ||$negociation["$t3"]==5||$negociation["$t3"]==7||$negociation["$t3"]==9){
										echo "<td>" ."<button name='submit' class='btn btn-primary' type='submit' value='$idnegociation'>soumettre </button>". "</td>";
									}
									echo"</form>";
									echo "</tr>";
										if($_SERVER["REQUEST_METHOD"] == "POST") {
											
										$offre = isset($_POST["offre"])? $_POST["offre"] : "0"; 
										$id= $negociation["$t6"];
										$compteur=$negociation["$t3"]+1;
										$id_article=$negociation["$t4"];
										// Variable connexion
										$user = "root";
										$mdp = "";
										$addr = "localhost";

										// Connect to MySQL server
										$db_handle = mysqli_connect($addr,$user, $mdp);

										if($db_handle) {
										} 
										else {
											die("Unable to connect. ERROR" . mysqli_error($db_handle));
										}

										$sql = "SET NAMES utf8";
										$result = mysqli_query($db_handle, $sql);


										$db_found = mysqli_select_db($db_handle, "ece-marketplace");

										

							            if($db_found){
							           
							           		$sql = "UPDATE negociation SET dernier_prix_vendeur = '$offre', compteur = '$compteur' WHERE id_articles = '$id_article' AND vendeur_id = '$id'";
								            $result = mysqli_query($db_handle, $sql);
								            //var_dump($result) ;
								            //echo $id_article." : ".$id." : ".$offre." : ".$compteur;

											mysqli_close($db_handle);

											header('Location: notificationVendeur.php');
											exit();
										
									}

									}	


								}
								echo "</table>";
							}
							else{
								echo "vous avez aucune négociation en cours<br>";
							}	

								?>
				</div>
			</div>
			<div class="row">
				<div class="col">
					
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