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
            <div class="tableArticles row">
                <div class="col">
                    <table class="table">
                      <thead class="thead-light">
                        <tbody>
                            <?php 

                                $id_vendeur = $_SESSION['id'];

                                $sql="SELECT MAX(id_article) FROM articles WHERE id_vendeur = $id_vendeur";
                                $result = mysqli_query($db_handle, $sql);
                                $data = mysqli_fetch_assoc($result);
                                foreach ($data as $key => $value) {
                                    $id_max=$value;
                                }
                                    
                                for($i = 1; $i <= $id_max; $i++){
                            
                                $sql = "SELECT * FROM articles WHERE id_article = $i AND id_vendeur = $id_vendeur";
                                $result = mysqli_query($db_handle, $sql);  
                                $data = mysqli_fetch_assoc($result);

                                if($data!=NULL)
                                {           
                                    foreach($data as $key => $value) {    
                                        $_SESSION["$key"]=$value;           
                                    }   

                                    $id_article = $_SESSION['id_article'];

                                    if($_SESSION['type_article']==1){
                                        $type_article = "Achat Immédiat";
                                    }
                                    elseif($_SESSION['type_article']==2){
                                        $type_article = "Enchères";
                                    }
                                    elseif($_SESSION['type_article']==3){
                                        $type_article = "Négociations";
                                    }
                                        echo "<tr>";                             
                                        echo "<td>".$_SESSION['Nom']."</td>";
                                        echo "<td>".$type_article."</td>";
                                        echo "<td>".$_SESSION['photo1']."</td>";
                                        echo "<td>".$_SESSION['prix']."€"."</td>";
                                        echo "<td>".$_SESSION['description']."</td>";
                                        echo "<form action='supprimerArticle.php' method='post'>";
                                        echo "<td><button class='btn btn-light' name='supprimer' value = $id_article type='submit'>Supprimer</button></td>";
                                        echo "</form>";
                                        echo "</tr>";
                                }
                                }
                            ?>
                            <tr>
                                <form action='ajouterArticle.php'>
                                    <td><button class='btn btn-light' type='submit'>Ajouter</button></td>
                                </form>
                            </tr>
                          </tbody>
                      </thead>
                    </table>
                </div>
            </div>
        </div>