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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-gallery.css">
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
                <div class="col-6">
                    <?php  
                         echo "<h1>$nom_article</h1>";
                    ?>
                        <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
                            

                            <div class="carousel-inner">
                             <?php 

                             for($i=1; $i<=3; $i++) { 
                                if($i == 1){
                                    
                                    echo "<div class='item active'><img src=".$photo1." alt='photo1'/></div>";
                                }
                                elseif($i == 2){
                                    
                                    echo "<div class='item '><img src=".$photo2." alt='photo2'/></div>";
                                }
                                elseif($i == 3){
                                    
                                    echo "<div class='item '><img src=".$photo3." alt='photo3'/></div>";
                                }
                                
                            }
                             ?>
                            </div>
                            <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                             <span class="glyphicon glyphicon-chevron-left"></span>
                             <span class="sr-only">Previous</span>
                            </a>

                            <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                             <span class="glyphicon glyphicon-chevron-right"></span>
                             <span class="sr-only">Next</span>
                            </a>

                        </div>
                </div>
                <div class="col-6" style="border-left: solid lightgrey">
                    <?php  

                    if ($type_article==2) {
                        $sql ="SELECT * FROM enchere WHERE id_articles = $id_article";
                        $result = mysqli_query($db_handle, $sql);
                        $data = mysqli_fetch_assoc($result);
                        $_enchere = [];

                        if($data!=NULL){          
                            foreach($data as $key => $value) {    
                                $_enchere["$key"]=$value;           
                            }
                        }

                        $prix_article=$_enchere['prix_max'];
                        $date_de_fin = $_enchere['date_fin'];
                        echo "<h3>Date de fin d'enchère: ".$date_de_fin."</h3>";
                    }
                   

                        echo "<h2>Prix: ".$prix_article."€</h2>";
                        echo "<h2>Description:</h2>";
                        echo "<p>$description_article</p><br>";
                        if ($type_article==1) {
                            echo "<form action='panierClient.php', method='post'>";
                                echo "<button id='inscrire' class='btn btn-primary' name='ajoutPanier' value='$id_article' type='submit'>AJOUTER AU PANIER</button>";
                                echo "</form>";
                        }
                        elseif($type_article==2){
                            echo "<form action = 'enchere.php' method ='post'>";
                            echo "<input type='number' name='prix_enchere' class='form-control' required='required' placeholder='Votre enchère'  size='20px'>";
                            echo "<button id='inscrire' name='id_article' class='btn btn-primary' value='$id_article' type='submit'>ENCHERIR</button>";
                            echo "</form>";
                        }
                        elseif($type_article==3){
                            $sql = "SELECT compteur FROM negociation WHERE id_articles = $id_article";
                            $result = mysqli_query($db_handle, $sql);

                            $data = mysqli_fetch_assoc($result);

                            if ($data!=NULL) {
                                foreach ($data as $key => $value) {
                                $nego_cpt = $value;    
                            }


                            }else {
                                $nego_cpt = 0;
                            }
                            
                            if ($nego_cpt==0 || $nego_cpt==2 || $nego_cpt==4 || $nego_cpt==6 || $nego_cpt==8) {
                                echo "<form action='negociation.php', method='post'>";
                                echo "<input type='number' name='prix_nego' class='form-control' required='required' placeholder='Votre Negociation'  size='20px'>";
                                echo "<button id='inscrire' class='btn btn-primary' name='negociation' value='$id_article' type='submit'>NEGOCIER</button>";
                                echo "</form>";
                                echo "<form action='panierClient.php', method='post'>";
                                echo "<button id='inscrire' class='btn btn-primary' name='ajoutPanier' value='$id_article' type='submit'>AJOUTER AU PANIER</button>";
                                echo "</form>";
                            }else {
                                echo "<form action='negociation.php', method='post'>";
                                echo "<button id='inscrire' class='btn btn-primary' name='ajoutPanier' value='$id_article' type='submit'>AJOUTER AU PANIER</button>";
                                echo "</form>";
                            }
                            
                        }
                        
                    ?> 
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"      crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
