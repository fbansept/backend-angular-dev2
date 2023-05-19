<?php

include 'header-json.php';

try {

    include_once 'autorisation.php';

    if($utilisateurConnecte) {

        if($utilisateurConnecte["admin"] == 1) {

            $requete = $bdd->prepare("DELETE FROM articles WHERE id = :id");
            $requete->execute([
                "id" => $_GET["id"]
            ]);

            echo "{ \"message\" : \" l'article a été supprimé \" }";

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