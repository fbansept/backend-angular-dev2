<?php
include 'header-json.php';

$json = file_get_contents('php://input');
$donneesFormulaire = json_decode($json, TRUE);

try {

    include 'connexion.php';
   
    $requete = $bdd->prepare("UPDATE articles 
                            SET nom=:nom , description=:description
                            WHERE id= :id");
    $requete->execute([
        "nom" => $donneesFormulaire["nom"] , 
        "description" => $donneesFormulaire["description"], 
        "id" => $donneesFormulaire["id"]
    ]);

    echo '{ "message" : "L\'article est modifié" }';

}
catch (PDOException $e) {
    echo '{ "message" : "Echec de la connexion : ' . $e->getMessage() . '"}';
    exit;
}