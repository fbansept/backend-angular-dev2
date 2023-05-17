<?php

include 'header-json.php';

try {

    include 'connexion.php';
   
    $requete = $bdd->prepare("DELETE FROM articles WHERE id = :id");
    $requete->execute([
        "id" => $_GET["id"]
    ]);

    echo '{ "message" : "L\'article est supprimé" }';

}
catch (PDOException $e) {
    echo '{ "message" : "Echec de la connexion : ' . $e->getMessage() . '"}';
    exit;
}