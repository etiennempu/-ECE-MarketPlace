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
        <!--BARRE DE RECHERCHE-->
            <div class="searchBar row">
                <div class="col">
                    <div class="container">
                        <form action="ToutParcourirAcheteur.php" method="post">
                            <fieldset>    
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <select onchange="this.form.submit()" id="categorie" name="categorie" class="custom-select bg-light text-dark">
                                            <option value="4">Catégorie</option>
                                            <option value="0">Aucune Catégorie</option>
                                            <option value="1">Achat Immédiat</option>
                                            <option value="2">Enchères</option>
                                            <option value="3">Négociations</option>
                                        </select>
                                    </div>
                                    <input id="saisie" name="saisie" type="text" class="form-control" aria-label="Saisie de mots clés" placeholder="Mot(s) clé(s)" required="required">
                                    <div class="input-group-append">
                                        <button class="btn btn-light" id="recherche" type="submit">Recherche</button>
                                    </div>
                                </div>
                        </fieldset> 
                      </form>
                    </div>
                    </form>
                </div>
            </div>
            <div class="tableArticles row">
                <div class="col">
                    <table class="table">
                      <thead class="thead-light">
                        <tbody>
                            <?php 

                            if($_SERVER["REQUEST_METHOD"] == "POST") {
                                $choice = isset($_POST["categorie"])? $_POST["categorie"] : "";


                                $sql="SELECT MAX(id) FROM articles";
                                $result = mysqli_query($db_handle, $sql);

                                $data = mysqli_fetch_assoc($result);
                                foreach ($data as $key => $value) {
                                    $id_max=$value;
                                }

                                if ($choice==1 || $choice==2 || $choice==3) {
                                    

                                for($i = 1; $i <= $id_max; $i++){
                            
                                $sql = "SELECT * FROM articles WHERE type_article = $choice AND id_article = $i";
                                $result = mysqli_query($db_handle, $sql);
                                var_dump($sql);    
                                $data = mysqli_fetch_assoc($result);
                                if($data!=NULL)
                                {           
                                    foreach($data as $key => $value) {    
                                        $_SESSION["$key"]=$value;           
                                    }   
                                        echo "<tr>";                             
                                        echo "<td>".$_SESSION['Nom']."<td>";
                                        echo "<td>".$_SESSION['type_article']."<td>";
                                        echo "<td>".$_SESSION['id_vendeur']."<td>";
                                        echo "<td>".$_SESSION['photo1']."<td>";
                                        echo "<td>".$_SESSION['prix']."€"."<td>";
                                        echo "<td>".$_SESSION['description']."<td>";
                                        echo "</tr>";
                                }
                                else {
                                }
                                }
                            }else {
                                for($i = 1; $i <= $id_max; $i++){
                                
                                $sql = "SELECT * FROM articles WHERE id = $i";
                                $result = mysqli_query($db_handle, $sql);    
                                $data = mysqli_fetch_assoc($result);
                                if($data!=NULL)
                                {           
                                    foreach($data as $key => $value) {    
                                        $_SESSION["$key"]=$value;           
                                    }   
                                        echo "<tr>";                             
                                        echo "<td>".$_SESSION['Nom']."<td>";
                                        echo "<td>".$_SESSION['type_article']."<td>";
                                        echo "<td>".$_SESSION['id_vendeur']."<td>";
                                        echo "<td>".$_SESSION['photo1']."<td>";
                                        echo "<td>".$_SESSION['prix']."€"."<td>";
                                        echo "<td>".$_SESSION['description']."<td>";
                                        echo "</tr>";
                                }
                                else {
                                }
                                }
                            }

                                
                            }
                            
                            ?>
                          </tbody>
                      </thead>
                    </table>
                </div>
            </div>
        </div>

        <!--FOOTER-->
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>FOOTER</h1>
                </div>
            </div>
        </div>

    </div>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(e){
        // Boucler tous les hyperliens de la liste « categorieListe »
        // Et capturer le l’événement « click »
        $('#categorieListe').find('a').click(function(e) {
        // Prévenir une action
        // Montrer ou cacher la liste des categories
        e.preventDefault();
        // Changer l’étiquette (label) de la liste pour le contenu du lien
        $('#categorie').html($(this).html());
        // Assigner la valeur de l’attribut « data-valeur » à l’élément caché (hidden) du formulaire « categorieValeur »
        $('#categorieValeur').val($(this).attr("data-valeur"));

        if ($('#categorie').attr("selected")=="selected") {

        }

    });
    });
    </script>

</body>
</html>