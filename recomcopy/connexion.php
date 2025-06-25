<?php 
    //Parametre de connexion
    $host = "localhost";
    $dbname = "recomcopy";
    $username = "root";
    $password = "";
    
    try{
        // Etablir la connexion
        $link_mysql = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username,
            $password
        );

        // Configurer PDO pour afficher les erreurs
        $link_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // echo "Connection reussie!";
    } catch(PDOException $e){
        echo "<p>Erreur de connexion: " .$e->getMessage() . "</p>";
    }

?>