<?php  
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
		die("Unable to connect. ERROR" . mysqli_error($db_handle));
	}

	$sql = "SET NAMES utf8";
	$result = mysqli_query($db_handle, $sql);


	$db_found = mysqli_select_db($db_handle, "ece-marketplace");
	
	$var = count($_SESSION['mes_articles']);

	for ($i=0; $i < $var; $i++) { 
		$id_article = $_SESSION['mes_articles'][$i];

		$_SESSION['mes_articles'][$i]=NULL;

		$date_de_vente = date('Y-m-d');
		$nom_client = $_SESSION['nom'];
		$id_client = $_SESSION['id'];

		$sql = "SELECT * FROM articles WHERE id_article = '$id_article'";
		$result = mysqli_query($db_handle, $sql);

		$data = mysqli_fetch_assoc($result);
		if($data!=NULL) {
			foreach ($data as $key => $value) {
				$_data["$key"] = $value;
			}
			$nom_article = $_data['Nom'];
			$id_vendeur = $_data['id_vendeur'];
			$type_article = $_data['type_article'];

			if ($type_article==3) {
				$sql ="SELECT dernier_prix_vendeur FROM negociation WHERE id_articles = '$id_article'";

				$result = mysqli_query($db_handle, $sql);
				$data1 = mysqli_fetch_assoc($result);
				if($data1!=NULL) {
					foreach ($data1 as $key => $value) {
						$prix_de_vente = $value;
					}
				}
				
			}else{
				$prix_de_vente = $_data['prix'];
			}
			
			$sql = "SELECT nom FROM user WHERE id = '$id_vendeur'";
			$result = mysqli_query($db_handle, $sql);
			$data2 = mysqli_fetch_assoc($result);

			if($data2!=NULL){
				foreach ($data2 as $key => $value) {
					$nom_vendeur = $value;
				}
			

				$sql = "INSERT INTO `historique` (`id_articles`, `Nom_articles`, `dates de vents`, `prix de ventes`, `id_client`, `Nom_client`, `id_vendeur`, `Nom_vendeur`) VALUES ('$id_article', '$nom_article', '$date_de_vente', '$prix_de_vente', '$id_client', '$nom_client', '$id_vendeur', '$nom_vendeur') ";
				$result = mysqli_query($db_handle, $sql);
				var_dump($result);

				$sql = "DELETE FROM articles WHERE id_article='$id_article'";
		        $result = mysqli_query($db_handle, $sql);

		        $sql = "DELETE FROM negociation WHERE id_articles='$id_article'";
				$result = mysqli_query($db_handle, $sql);
			}

		}
	}

	header('location: panierClient.php');
?>