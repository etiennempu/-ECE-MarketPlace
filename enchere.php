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
                $id_article = isset($_POST["id_article"])? $_POST["id_article"] : "";
                $prix_enchere = isset($_POST["prix_enchere"])? $_POST["prix_enchere"] : "0";

                $sql="SELECT * FROM enchere WHERE id_articles = $id_article";
                $result = mysqli_query($db_handle, $sql);
                $data = mysqli_fetch_assoc($result);


                if($data!=NULL){           
                    foreach($data as $key => $value) {    
                        $_enchere["$key"]=$value;           
                    }
                    $prix_max = $_enchere['prix_max'];
                    $prix_inf = $_enchere['prix_inf'];

                    if ($prix_max>$prix_enchere) {
                        $prix_enchere = $prix_max;
                        $id_client = $_enchere['id_clientmax'];
                    }
                    $id_client = $_SESSION['id'];
                    $prix_inf = $prix_max;


                    $sql="UPDATE enchere SET id_clientmax = '$id_client', prix_max = '$prix_enchere', prix_inf = '$prix_inf'";
                    $result = mysqli_query($db_handle, $sql);

                    header('Location: ToutParcourirAcheteur.php');

                    mysqli_close($db_handle);
        }

    }
?>