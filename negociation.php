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
                echo "pas trouve DB";
                die("Unable to connect. ERROR" . mysqli_error($db_handle));
            }

            $sql = "SET NAMES utf8";
            $result = mysqli_query($db_handle, $sql);


            $db_found = mysqli_select_db($db_handle, "ece-marketplace");  

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$id_article = isset($_POST["negociation"])? $_POST["negociation"] : "";
		$prix_nego = isset($_POST["prix_nego"])? $_POST["prix_nego"] : "";
		$id_client = $_SESSION['id'];

		$sql = "SELECT * FROM negociation WHERE id_articles='$id_article' AND id_client = '$id_client'";
	    $result = mysqli_query($db_handle, $sql);

	    $data = mysqli_fetch_assoc($result);
	    var_dump($data);

	    if ($data !=NULL) {
	    	foreach ($data as $key => $value) {
	    		$_data["$key"] = $value;
	    	}

			$compteur = $_data['compteur'] + 1; 
			echo $compteur."<br>";
			echo $prix_nego."<br>";

			$sql = "UPDATE negociation SET dernier_prix_client = '$prix_nego', compteur = '$compteur' WHERE id_articles = '$id_article' AND id_client = '$id_client'";
			$result = mysqli_query($db_handle, $sql);
			var_dump($result);

		} else {
			    $sql="INSERT INTO negociation (id_articles, id_client, dernier_prix_client, dernier_prix_vendeur, compteur) VALUES ('$id_article', '$id_client', '$prix_nego', '0', '1')";
			    $result = mysqli_query($db_handle, $sql);
		}
	}

	mysqli_close($db_handle);

	header('Location: ToutParcourirAcheteur.php');
	exit();
?>