<?php
	// On démarre la session AVANT d'écrire du code HTML
	session_start();
	if($_SESSION['type']==1)
    {
        header("location: ToutParcourirAcheteur.php");

    }elseif ($_SESSION['type']==2) 
    {
        header("location: ToutParcourirVendeur.php");
    }elseif ($_SESSION['type']==3) 
    {
        header("location: ToutParcourirAdmin.php");
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
								<a class="nav-link" href="toutParcourir.php"><img src="toutParcourirSelect.png" alt="bouton Tout Parcourir"></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="notifications.php"><img src="notifs.png" alt="bouton Notifications"></a>
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

		<!--SECTION-->
		<div class="section container">
		</div>



	</div>


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>