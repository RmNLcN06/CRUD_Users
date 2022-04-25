<?php 

    $host = "localhost";
    $dbname = "crudaddix";
    $user = "root";
    $password= "";

    try
    {
        $database = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $database->exec('SET NAMES "UTF8"');
    }
    catch(PDOException $e)
    {
        die('Erreur: ' . $e->getMessage());
    }
?>