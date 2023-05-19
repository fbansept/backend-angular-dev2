<?php

include 'header-json.php';

try {

    include_once 'autorisation.php';

    if($utilisateurConnecte) {

        if($utilisateurConnecte["admin"] == 1) {

            $json = file_get_contents('php://input');
            $donneesFormulaire = json_decode($json, TRUE);

            $requete = $bdd->prepare("UPDATE articles 
                            SET nom=:nom , description=:description
                            WHERE id= :id");

            $requete->execute([
                "nom" => $donneesFormulaire["nom"] , 
                "description" => $donneesFormulaire["description"], 
                "id" => $donneesFormulaire["id"]
            ]);

            echo '{ "message" : "L\'article est modifié" }';

        } else {
            echo "{ \"message\" : \" Vous n'avez pas les droits nécessaires \" }";
            header('HTTP/1.0 403 Forbidden');
        }

    } else {

         echo "{ \"message\" : \" Vous n'êtes pas connecté \" }";
         header("HTTP/1.1 401 Unauthorized");
    }

} catch (Exception $e) {
    echo '{ "message" : "Echec : ' . $e->getMessage() . '"}';
    header("HTTP/1.1 500 Internal server error");
    exit;
}