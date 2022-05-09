<?php
require_once 'db_config.php';
require_once 'fonctions.php';



function addDeclinaison($newDeclinaison,$mysqlclient){ // Ajout declinaisons
    $sqlQuery = 'INSERT INTO declinaisons(title, reference, price, stock, id_produit ) VALUE (:title, :reference, :price, :stock, :id_produit)';
    $insertProduit = $mysqlclient->prepare($sqlQuery);
    $insertProduit->execute ([
        'title' => $newDeclinaison['title'],
        'reference' => $newDeclinaison['reference'],
        'price' => $newDeclinaison['price'],
        'stock' => $newDeclinaison['stock'],
        'id_produit' => $newDeclinaison['id_produit'],
    ]);
}


function declinaisonSelectAllById_Produit($mysqlclient,$id_produit){ // Selection toutes les declinaisons par id du produit

    $sqlQuery = 'SELECT * FROM `declinaisons` WHERE id_produit = '.$id_produit.' ORDER BY id ASC';
    $produits = $mysqlclient->prepare($sqlQuery);
    $produits->execute();
    return $produits->fetchAll();
}



function declinaisonUpdate($mysqlclient, $declinaisonUpdate){ // Modifie declinaisons
    $sqlQuery = 'UPDATE declinaisons SET title = :title, reference = :reference, price = :price, stock =:stock WHERE id = :id';
    $updateDec = $mysqlclient->prepare($sqlQuery);
    $updateDec->execute([
      'id' => $declinaisonUpdate['id'],
      'title' => $declinaisonUpdate['title'],
      'reference' => $declinaisonUpdate['reference'],
      'price' => $declinaisonUpdate['price'],
      'stock' => $declinaisonUpdate['stock'],
    ]);
}

function delDeclinaison($mysqlclient, $id){ // Supprimer declinaisons
  $sqlQuery= 'DELETE FROM declinaisons WHERE id = '.$id.'';
  $declinaisons = $mysqlclient->prepare($sqlQuery);
  $declinaisons->execute();
}

function updateNbDeclinaison($mysqlclient,$id,$updateDeclinaison){ //Moodifie nombre declinaisons d un produit
    $sqlQuery = 'UPDATE produits SET nb_declinaison = :nb_declinaison WHERE id = :id';
    $updateDec = $mysqlclient->prepare($sqlQuery);
    $updateDec->execute([
        'id' => $id,
        'nb_declinaison' => $updateDeclinaison,
    ]);
}

if( isset($_GET['id_produit']) && is_numeric($_GET['id_produit'])){

    $id_produit = $_GET['id_produit'];
    $produitSelect = produitSelect($mysqlclient, $id_produit);
    
  }
  if( isset($_GET['id']) && is_numeric($_GET['id'])){

    $id_produit = $_GET['id'];
    $declinaisonSelect = declinaisonSelect($mysqlclient, $id_produit);
    
  }
  if($_POST){

    if (isset($_POST['suppr']) && !empty($_POST['suppr'])){
      delDeclinaison($mysqlclient, $_POST['id']);
  }else{
    if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['reference']) && !empty($_POST['reference']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['stock']) && !empty($_POST['price']) && isset($_POST['id_produit']) && !empty($_POST['id_produit'])){
        if(strlen($_POST['title'])<50){
          if (isset($_POST['id']) && !empty($_POST['id'])){
            $declinaisonUpdate = $_POST;
            declinaisonUpdate($mysqlclient, $declinaisonUpdate);
          }else{
            $newDeclinaison = $_POST;
            addDeclinaison($newDeclinaison,$mysqlclient);
          }
        }else {
            echo 'Le titre de la declinaison est trop long';
        }
    }else{
        echo 'Veuillez remplir tous les champs';
    }
  }

  $updateDeclinaison = count(declinaisonSelectAllById_Produit($mysqlclient,$produitSelect['id']));
  updateNbDeclinaison($mysqlclient,$produitSelect['id'],$updateDeclinaison);
}