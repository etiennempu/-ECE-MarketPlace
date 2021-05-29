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
					<h2>C'est ici que vous avez le suivi de vos negociation et enchere, et que vous pouvez ajouter une alerte:</h2>
					<p>
						
						<?php 
							$id_client=$_SESSION['id'];
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
									$sql = "SELECT * FROM enchere WHERE id_clientmax='$id_client' ";
										
										$result = mysqli_query($db_handle, $sql);
										$data = mysqli_fetch_assoc($result);
										if($data!=NULL)
										{
											
												$temp=0;
												$enchere=[];
												do{
												foreach($data as $key => $value)
												{
						
															$enchere["$temp"]=$value;
															// echo $key." : ".$value."<br>";	 
															//  echo $key." : ".$enchere["$temp"]."<br>";
															//  echo $key." : ".$enchere[0]."<br>";
															// echo $temp."<br>";
															$temp=$temp+1;		
												}
												}while ($data = mysqli_fetch_assoc($result));

												
										}
										
										$sql = "SELECT * FROM negociation WHERE id_client='$id_client' ";
										
										$result = mysqli_query($db_handle, $sql);
										$data = mysqli_fetch_assoc($result);
										if($data!=NULL)
										{
											
												$temp2=0;
												$negociation=[];
												do{
												foreach($data as $key => $value)
												{
						
															$negociation["$temp2"]=$value;
															//echo $key." : ".$value."<br>";	 
															// echo $key." : ".$enchere["$temp"]."<br>";
															// echo $key." : ".$enchere[0]."<br>";
															//echo $temp."<br>";
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
								//---------------------enchere---------------------							
								//echo $enchere['$temp']. "<br>";
							if($temp>0){
								echo "<p>Voici vos enchères en cours:<p>";
								echo "<table border=\'1\'>";
								// echo "<tr>";
								// echo "<th>" ."Voici vos enchères en cours:". "</th>";
								// echo "</tr>";
								echo "<tr>";
								//echo "<th>" . "ID" . "</th>";
								echo "<th>" . "Vous avez encherie de:" . "</th>";
								echo "<th>" . "l'enchere a débuté:" . "</th>";
								echo "<th>" . "prendra fin le " . "</th>";
								echo "<th>" . "plus d'info sûr l'article" . "</th>";
								echo "<th>" . "Statut de l'enchère" . "</th>";
								echo "</tr>";
								//$i;
								// echo date("d/m/Y"); // Affiche la date du jour
								// echo "Il est " . date("H:i:s")."<br>" ; // Affiche l'heure
								for($i=0;$i<$temp;$i=$i+7){
									// echo "valeur de temp: ".$temp."<br>";
									// echo "valeur de i: ".$i."<br>";
									echo "<tr>";
									$t0=$i;
									$t1=$i+1;
									$t2=$i+2;
									$t3=$i+3;
									$t4=$i+4;
									$t5=$i+5;
									$t6=$i+6;
									
									$ajd=date('Y-m-d H:i:s');
									// echo "ajd :".$ajd."<br>";
									if($enchere["$t6"]<$ajd){

										echo "<td>" . $enchere["$t3"] . "€</td>";
										echo "<td>" . $enchere["$t5"] . "</td>";
										echo "<td>" . $enchere["$t6"] . "</td>";
										echo "<td>" . "</td>";
										echo "<td>" ."enchère finie, vous avez gagné"."</td>";
										echo "</tr>";

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
												$tempt0=$enchere["$t0"];
												$tempt1=$enchere["$t1"];
												$tempt2=$enchere["$t2"];
												$tempt3=$enchere["$t3"];
												$tempt4=$enchere["$t4"];
												$tempt5=$enchere["$t5"];
												$tempt6=$enchere["$t6"];
												
												//echo "Hello1 <br>";
												$sql = " SELECT * FROM articles WHERE id_article='$tempt1' ";
													
													$result = mysqli_query($db_handle, $sql);
													$data = mysqli_fetch_assoc($result);
													if($data!=NULL)
													{
														
															$temp3=0;
															$article=[];
															foreach($data as $key => $value)
															{
									
																		$article["$temp3"]=$value;
																		$temp3=$temp3+1;		
															}

															
													}
												$sql = "SELECT * FROM user WHERE id='$article[1]' ";
													
													$result = mysqli_query($db_handle, $sql);
													$data = mysqli_fetch_assoc($result);
													if($data!=NULL)
													{
														
															$temp4=0;
															$vendeur=[];
															foreach($data as $key => $value)
															{
									
																		$vendeur["$temp4"]=$value;
																		$temp4=$temp4+1;		
															}

															
													}
												$sql = "SELECT * FROM user WHERE id='$tempt2' ";
													
													$result = mysqli_query($db_handle, $sql);
													$data = mysqli_fetch_assoc($result);
													if($data!=NULL)
													{
														
															$temp5=0;
															$client=[];
															foreach($data as $key => $value)
															{
									
																		$client["$temp5"]=$value;
																		$temp5=$temp5+1;		
															}

															
													}
													$sql = "DELETE FROM articles WHERE id_article='$tempt1' ";
													$result = mysqli_query($db_handle, $sql);
													$sql = "DELETE FROM enchere WHERE id_enchere='$tempt0' ";
													
													
													$result = mysqli_query($db_handle, $sql);

													$prixvente=$tempt4+1;
													$datefin=$tempt6;;
													$nomarticles=$article[3];
													$nomclient=$client[1];
													$idvendeur=$vendeur[0];
													$nomvendeur=$vendeur[1];
													$sql = "INSERT INTO `historique` (`id_historique`,`id_articles`, `Nom_articles`, `dates de vents`, `prix de ventes`, `id_client`, `Nom_client`, `id_vendeur`, `Nom_vendeur`) VALUES (NULL,'$tempt1', '$nomarticles', '$datefin', '$prixvente', '$tempt2', '$nomclient', '$idvendeur', '$nomvendeur') ";
													
													
													$result = mysqli_query($db_handle, $sql);

													
													mysqli_close($db_handle);
													//echo "connection closed. <br>";
											}
											else 
											{
												echo "DB not found <br>";
											}
									
									}else{
										echo "<td>" . $enchere["$t3"] . "€</td>";
										echo "<td>" . $enchere["$t5"] . "</td>";
										echo "<td>" . $enchere["$t6"] . "</td>";
										echo "<td>" . "</td>";
										echo "<td>" ."l'enchère n'est pas finie"."</td>";
										echo "</tr>";
										
									}
									

								}
								echo "</table>";
							}
							else{
								echo "vous n'êtes en tête dans aucune enchère en cours<br>";
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
								echo "<th>" . "Proposition du vendeur" . "</th>";
								echo "<th>" . "votre proposition" . "</th>";
								echo "<th>" . "nombre de négosiation restante" . "</th>";
								echo "<th>" . "plus d'info sûr l'article" . "</th>";
								echo "</tr>";
								
								for($i=0;$i<$temp2;$i=$i+6){
									echo "<tr>";
									$t1=$i+4;
									$t2=$i+3;
									$t3=$i+5;
									echo "<td>" . $negociation["$t1"] . "€</td>";
									echo "<td>" . $negociation["$t2"] . "€</td>";
									echo "<td>" . $negociation["$t3"] . "</td>";
									echo "<td>" ."la négosiation n'est pas finie"."</td>";
									echo "</tr>";


								}
								echo "</table>";
							}
							else{
								echo "vous avez aucune négosiation en cour<br>";
							}		
						
						?>

							
					</p>
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