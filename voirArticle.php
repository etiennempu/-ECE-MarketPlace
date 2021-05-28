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
                $id_article = isset($_POST["voirPlus"])? $_POST["voirPlus"] : ""; 

                $sql = "SELECT * FROM articles WHERE id_article = $id_article";
                $result = mysqli_query($db_handle, $sql);
                                        
                $data = mysqli_fetch_assoc($result);

                if($data!=NULL){           
                    foreach($data as $key => $value) {    
                        $_data["$key"]=$value;           
                    }
                    $nom_article=$_data['Nom'];
                    $photo1=$_data['photo1'];
                    $photo2=$_data['photo2'];
                    $photo3=$_data['photo3'];
                    $video=$_data['video'];
                    $type_article=$_data['type_article'];
                    $prix_article=$_data['prix'];
                    $description_article=$_data['description'];

                }

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
            <div class="row">
                <div class="col">
                    <?php  
                        echo "<h1>$nom_article</h1>";
                        echo "PHOTOS ICI";
                        echo "<h2>Description:</h2>";
                        echo "<p>$description_article</p>";
                    ?> 
                </div>
                <div class="col">
                    <?php  
                        echo "<h2>Prix: ".$prix_article."€</h2>";
                        if ($type_article==1) {
                            echo "<button id='inscrire' class='btn btn-primary' type='submit'>AJOUTER AU PANIER</button>";
                        }
                        elseif($type_article==2){
                            echo "<button id='inscrire' class='btn btn-primary' type='submit'>ENCHERIR</button>";
                        }
                        elseif($type_article==3){
                            echo "<button id='inscrire' class='btn btn-primary' type='submit'>NEGOCIER</button>";
                        }
                    ?> 
                </div>
            </div>
        </div>
