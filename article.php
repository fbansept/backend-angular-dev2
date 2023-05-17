<?php
include 'header-json.php';

try {

    include 'connexion.php';
   
    $requete = $bdd->prepare("SELECT * 
                            FROM articles 
                            WHERE id = :id");
    $requete->execute(["id" => $_GET['id']]);

    $article = $requete->fetch();

    echo json_encode($article);

}
catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
    exit;
}