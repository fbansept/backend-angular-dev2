<?php

$enTetes = getallheaders();

if(!isset($enTetes['Authorization'])) {
    die('{ "message" : "Vous n\'êtes pas connecté" }');
}


$jwt = $enTetes['Authorization'];


$key = 'clé secrète'; // La même clé secrète que celle utilisée pour l'encodage

$jwtParts = explode('.', $jwt);

if(count($jwtParts) != 3) {
     echo '{ "message" : "JWT malformé" }';
     header('HTTP/1.0 400 Bad request');
     exit();
}

// Étape 1 : Diviser le JWT en trois parties
list($base64UrlHeader, $base64UrlPayload, $base64UrlSignatureProvided) = $jwtParts;

// Étape 2 : Décoder le Header et le Payload
$header = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlHeader)), true);
$payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlPayload)), true);

// Étape 3 : Vérifier la signature
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

if ($base64UrlSignatureProvided !== $base64UrlSignature) {
    die('{"message" : "Signature invalide"}');
}

$emailUtilisateurConnecte = $payload["email"];

include_once 'connexion.php';

$requete = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");

$requete->execute(["email" => $emailUtilisateurConnecte ]);

$utilisateurConnecte = $requete->fetch();

