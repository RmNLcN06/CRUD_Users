<?php

// Démarrage de la session
session_start();

// Vérification que l'id existe ET qu'il n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id']))
{
    require_once('req/_connect.php');

    // Réinitialisation de l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM utilisateur WHERE id = :id';

    // Préparation de la requête
    $query = $database->prepare($sql);

    // Liaison des paramètres de l'id
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();

    // Récupération du candidat
    $utilisateur = $query->fetch();

    // Vérification de l'existence d'un utilisateur
    if(!$utilisateur) {
        $_SESSION['erreur'] = "Cet id utilisateur n\'existe pas";
        header('Location: index.php');
        die();
    }

    $sql = 'DELETE FROM utilisateur WHERE id = :id;';

    // Préparation de la requête
    $query = $database->prepare($sql);

    // Liaison des paramètres de l'id
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // Exécution de la requête
    $query->execute();
    $_SESSION['message'] = "Utilisateur supprimé";
    header('Location: index.php');
} 
else 
{
    $_SESSION['erreur'] = 'URL invalide';
    header('Location: index.php');
}