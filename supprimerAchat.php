<?php  
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		$id_article = isset($_POST["supprimer_achat"])? $_POST["supprimer_achat"] : "";

		$var = count($_SESSION['mes_articles']);

		for ($i = 0; $i < $var; $i++){
			echo $_SESSION['mes_articles'][$i].',';
		}

		echo "<br>";

		for ($i = 0; $i < $var; $i++){
			if ($_SESSION['mes_articles'][$i] == $id_article) {
				$_SESSION['mes_articles'][$i]=NULL;
			}
		}

		for ($i = 0; $i < $var; $i++){
			if ($_SESSION['mes_articles'][$i]!=NULL) {
				echo $_SESSION['mes_articles'][$i].',';
			}
			
		}
	}
?>