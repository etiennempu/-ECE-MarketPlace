<?php
	// On démarre la session AVANT d'écrire du code HTML
	session_start();
	// Variable connexion
            $user = "root";
            $mdp = "";
            $addr = "localhost";

            // Connect to MySQL server
            $db_handle = mysqli_connect($addr,$user, $mdp);

            if($db_handle) {

            } 
            else {
                echo "pas trouve DB";
                die("Unable to connect. ERROR" . mysqli_error($db_handle));
            }

            $sql = "SET NAMES utf8";
            $result = mysqli_query($db_handle, $sql);


            $db_found = mysqli_select_db($db_handle, "ece-marketplace");  

            if($_SERVER["REQUEST_METHOD"] == "POST") {
			$id_panier = isset($_POST["ajoutPanier"])? $_POST["ajoutPanier"] : "";

			$var = count($_SESSION['mes_articles']);
			$_SESSION['mes_articles'][$var] = $id_panier;
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
	   				<div id="navbarContent" class="collapse navbar-collapse">
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
								<a class="nav-link" href="panier.php"><img src="panierSelect.png" alt="bouton Panier"></a>
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
					<table class="table">
                    	<thead class="thead-light">
                    		<?php  
                    			$var = count($_SESSION['mes_articles']);
                    			$prix_total = 0;
                    			
                    			for ($i=0; $i<$var; $i++) {
                    				if($_SESSION['mes_articles'][$i]!=NULL) {
                    					$temp = $_SESSION['mes_articles'][$i];
                    				
	                    				$sql = "SELECT * FROM articles WHERE id_article = '$temp'";
	                    				$result = mysqli_query($db_handle, $sql);

	                    				$data = mysqli_fetch_assoc($result);
	                    				if ($data !=NULL) {
		                    				foreach ($data as $key => $value) {
		    									$_data["$key"] = $value;
		    								}

		                    				$nom_article = $_data ['Nom'];
		                    				$id_article = $_data ['id_article'];

		                    				if($_data ['type_article']==1 ){
		                    					$prix_article =  $_data ['prix'];

		                    				} elseif ($_data ['type_article']==3) {
		                    					$sql = "SELECT dernier_prix_vendeur FROM negociation WHERE id_articles = '$temp'";
		                    					$result = mysqli_query($db_handle, $sql);
		                    					$data = mysqli_fetch_assoc($result);

		                    					foreach ($data as $key => $value) {
		                    						$prix_article = $value;
		                    					}
		                    				}

		                    				$prix_total = $prix_total + $prix_article;

		                    				echo "<tr>";
		                    				echo "<td>".$nom_article."</td>";
		                    				echo "<td>".$prix_article."€</td>";
		                    				echo "<form action='voirArticle.php' method='post'>";
		                    				echo "<td><button class='btn btn-light' name='voirPlus' value = $id_article type='submit'>voir plus</button></td>";
		                    				echo "</form>";
		                    				echo "<form action='supprimerAchat.php' method='post'>";
		                    				echo "<td><button class='btn btn-dark' name='supprimer_achat' value = $id_article type='submit'>SUPPRIMER</button></td>";
		                    				echo "</form>";
		                    				echo "</tr>";
		                    			}
	                    			}
                    			}

                    			if ($prix_total>0) {
                    				echo "<tr>";
	                    			echo "<form action='payement.php' method='post'>";
		                    		echo "<td><button id='inscrire' class='btn btn-primary' type='submit' name='payer' value='$prix_total'>PRIX TOTAL : ".$prix_total."€</button></td>";
		                    		echo "</form>";
		                    		echo "</tr>";
	                    		}
                    		?>
                    	</thead>
                    </table>
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