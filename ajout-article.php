<?php
include 'header-json.php';

$json = file_get_contents('php://input');
$donneesFormulaire = json_decode($json, TRUE);

try {

    include 'connexion.php';
   
    $requete = $bdd->prepare("INSERT INTO articles (nom,description,date_creation) 
                                VALUES (:nom , :description , NOW())");
    $requete->execute([
        "nom" => $donneesFormulaire["nom"] , 
        "description" => $donneesFormulaire["description"]
    ]);

    echo '{ "message" : "L\'article est ajouté" }';

}
catch (PDOException $e) {
    echo '{ "message" : "Echec de la connexion : ' . $e->getMessage() . '"}';
    exit;
}