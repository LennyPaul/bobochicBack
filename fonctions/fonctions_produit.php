<?php
require_once 'db_config.php';
require_once 'fonctions.php';



function addProduit($newProduit,$mysqlclient){ // fonction ajout produit
    $sqlQuery = 'INSERT INTO produits(title, reference, price ) VALUE (:title, :reference, :price)';
    $insertProduit = $mysqlclient->prepare($sqlQuery);
    $insertProduit->execute ([
        'title' => $newProduit['title'],
        'reference' => $newProduit['reference'],
        'price' => $newProduit['price'],
    ]);
}

function produitAllById($mysqlclient){ // recuper tout les produit 

    $sqlQuery = 'SELECT * FROM produits ORDER BY id ASC';
    $produits = $mysqlclient->prepare($sqlQuery);
    $produits->execute();
    return $produits->fetchAll();
}



function produitUpdate($mysqlclient, $produitUpdate){ // Modifier produit
    $sqlQuery = 'UPDATE produits SET title = :title, reference = :reference, price = :price WHERE id = :id';
    $updateUser = $mysqlclient->prepare($sqlQuery);
    $updateUser->execute([
      'id' => $produitUpdate['id'],
      'title' => $produitUpdate['title'],
      'reference' => $produitUpdate['reference'],
      'price' => $produitUpdate['price']
    ]);
}

function delProduit($mysqlclient, $id){ // Suprrimer produit
  $sqlQuery= 'DELETE FROM produits WHERE id = '.$id.'';
  $produits = $mysqlclient->prepare($sqlQuery);
  $produits->execute();
}

if( isset($_GET['id']) && is_numeric($_GET['id'])){

    $id = $_GET['id'];
    $produitSelect = produitSelect($mysqlclient, $id);
    
    
  }
  if($_POST){ 
    if (isset($_POST['suppr']) && !empty($_POST['suppr'])){
      delProduit($mysqlclient, $_POST['id']);
  }else{
    if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['reference']) && !empty($_POST['reference']) && isset($_POST['price']) && !empty($_POST['price'])){
        if(strlen($_POST['title'])<50){
          if (isset($_POST['id']) && !empty($_POST['id'])){
            $produitUpdate = $_POST;
            produitUpdate($mysqlclient, $produitUpdate);
          }else{
            $newProduit = $_POST;
            addProduit($newProduit,$mysqlclient);
          }
        }else {
            echo 'Le titre du produit est trop long';
        }
    }else{
        echo 'Veuillez remplir tous les champs';
    }
  }
}





