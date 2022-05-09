<?php
require 'db_config.php';



function produitSelect($mysqlclient, $id){
    
    $sqlQuery = 'SELECT * FROM produits WHERE id = '.$id.'';
    $produits = $mysqlclient->prepare($sqlQuery);
    $produits->execute();
    return $produits->fetch(PDO::FETCH_ASSOC);
}

function declinaisonSelect($mysqlclient, $id){
    
    $sqlQuery = 'SELECT * FROM declinaisons WHERE id = '.$id.'';
    $produits = $mysqlclient->prepare($sqlQuery);
    $produits->execute();
    return $produits->fetch(PDO::FETCH_ASSOC);
}


