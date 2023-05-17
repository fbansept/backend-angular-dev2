<?php

include 'header-json.php';

try {

    include 'connexion.php';
   
    $requete = $bdd->prepare("SELECT * FROM articles");
    $requete->execute();
    $listeArticle = $requete->fetchAll();

    echo json_encode($listeArticle);

}
catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
    exit;
}