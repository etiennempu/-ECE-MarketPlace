<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_article = isset($_POST["nomArticle"])? $_POST["nomArticle"] : ""; 
    $type_article = isset($_POST["type"])? $_POST["type"] : "0";
    $prix = isset($_POST["prix"])? $_POST["prix"] : "0";
    $description = isset($_POST["description"])? $_POST["description"] : "";
    $photo1 = isset($_POST["photo1"])? $_POST["photo1"] : "";
    $photo2 = isset($_POST["photo2"])? $_POST["photo2"] : "";
    $photo3 = isset($_POST["photo3"])? $_POST["photo3"] : "";
    $id_vendeur = $_SESSION['id'];

 

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
        if ($prix<0) {
            echo "<script>alert('Inserez un prix positif')</script>";
        }else{
            $sql = "INSERT INTO articles (id_vendeur, type_article, Nom, prix, photo1, photo2, photo3, video, description) VALUES ('$id_vendeur', '$type_article', '$nom_article', '$prix', '$photo1', '$photo2', '$photo3', '', '$description')";
        $result = mysqli_query($db_handle, $sql);

        if ($type_article==2) {
            $sql="SELECT MAX(id_article) FROM articles";
            $result = mysqli_query($db_handle, $sql);

            $data=mysqli_fetch_assoc($result);
            foreach ($data as $key => $value) {
                $id_max=$value;
            }
            echo $id_max;
        }

        $date_actuelle = date('Y-m-d H:i:s');
        $demain = date('Y-m-d H:i:s', strtotime('+1 day'));

        $sql = "INSERT INTO enchere (id_articles, id_clientmax, prix_max, prix_inf, date_debut, date_fin) VALUES ('$id_max', '0', '$prix', '0', '$date_actuelle', '$demain')";
        $result = mysqli_query($db_handle, $sql);
        var_dump($result);


        mysqli_close($db_handle);

        header('Location: ToutParcourirVendeur.php');
        exit();

        }        
    }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Article</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="ajouterArticle.php" method="post">
                    <img id="logoInscription" src="logoMarketPlace.png" alt="logo ECE Market Place">
                    <h1 id="titreInscription">AJOUTER UN ARTICLE</h1>
                    <table>
                        <tr>
                            <td><input type="text" name="nomArticle" class="form-control" required="required" placeholder="Nom de l'article"  size="50px"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="type" class="form-control" required="required" placeholder="1: achat immmédiat 2: enchère 3: Négociations" size="50px"></td>
                        </tr>
                        <tr>
                            <td><input type="number" name="prix" class="form-control" required="required" placeholder="Le prix" size="50px"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="photo1" class="form-control" placeholder="URL de la photo" size="50px"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="photo2" class="form-control" placeholder="URL de la photo" size="50px"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="photo3" class="form-control" placeholder="URL de la photo" size="50px"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="description" class="form-control" placeholder="Description de l'article" size="50px"></td>
                        </tr>
                    </table>
                    <button id="inscrire" class="btn btn-primary" type="submit">AJOUTER</button>
                </form>             
            </div>
            <div class="fondInscription col">

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>