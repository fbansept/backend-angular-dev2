<?php

include 'header-json.php';

try {

    $enTetes = getallheaders();
    $jwt = $enTetes['Authorization'];

    include 'connexion.php';
   
    $requete = $bdd->prepare("DELETE FROM articles WHERE id = :id");
    // $requete->execute([
    //     "id" => $_GET["id"]
    // ]);

    echo "{ \"message\" : \"$jwt\" }";

}
catch (PDOException $e) {
    echo '{ "message" : "Echec de la connexion : ' . $e->getMessage() . '"}';
    exit;
}catch (Exception $e) {
    echo '{ "message" : "Echec : ' . $e->getMessage() . '"}';
    exit;
}