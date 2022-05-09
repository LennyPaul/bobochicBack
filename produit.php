

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Produit</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Une description de la page" />
        <link rel="stylesheet" href="reset.css" />
        <link rel="stylesheet" href="style.css" />
        <script src="main.js" defer></script>
    </head>
    <body>
    <?php require 'layout/header.php';?>
    <main>
    <h1>Produit</h1>
    <?php require_once 'fonctions/fonctions_produit.php';?>
    <?php if(isset($produitSelect['id'])&&!empty($produitSelect['id'])&& !isset($_GET['suppr'])){ echo '<h2>Modifier</h2>';}elseif(isset($_GET['suppr'])&& $_GET['suppr'] == 1){ echo "<h2>Supprimer</h2>";}else{echo '<h2>Ajouter</h2>';}?>
    <form action="produit.php" method="post">
    <input type="hidden" name="id" id="id" value ="<?php if(isset($produitSelect['id'])&&!empty($produitSelect['id'])){ echo $produitSelect['id'];}?>">
    <?php 
      if(isset($_GET['suppr'])&& $_GET['suppr'] == 1){
        ?>
        <input type="hidden" name="suppr" id="suppr" value ="1">
        <input type="submit" value="La suppression est définitive">
        <?php
    }else{

    ?>

        <input type="text" name="title" id="title" placeholder='Titre du produit' value="<?php if(isset($produitSelect['id'])&&!empty($produitSelect['id'])){ echo $produitSelect['title'];}?>">
        <input type="text" name="reference" id="reference" placeholder ='Reference du produit' value="<?php if(isset($produitSelect['id'])&&!empty($produitSelect['id'])){ echo $produitSelect['reference'];}?>">
        <input type="number" name="price" id="price" placeholder='Prix du porduit' value="<?php if(isset($produitSelect['id'])&&!empty($produitSelect['id'])){ echo $produitSelect['price'];}?>">
        <input type="submit" value="<?php if(isset($produitSelect['id'])&&!empty($produitSelect['id'])){ echo 'MODIFIER';}else{echo 'AJOUTER';} ?>">
        <?php 
      if(isset($produitSelect['id'])&&!empty($produitSelect['id'])){?>

        <a href="declinaison.php?id_produit=<?=$produitSelect['id']?>">Gerer les declinaisons du produits</a>
        <?php
      } 
      }
        ?>
    </form>
    <?php 
    
    
        $produits = produitAllById($mysqlclient);
        ?>
        <a href="produit.php">Ajouter produits</a>
        <br> <br> <br>
        <table>
              <thead>
                <tr>
                  <th colspan="1">id</th>
                  <th colspan="1">title</th>
                  <th colspan="1">reference</th>
                  <th colspan="1">prix</th>
                  <th colspan="1">nb_declinaison</th>
                  <th colspan="1">stock</th>
    
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($produits as $key => $produit){ ?>
                  <tr>
                    <td><?=$produit['id']?></td>
                    <td><?=$produit['title']?></td>
                    <td><?=$produit['reference']?></td>
                    <td><?=$produit['price']?>$</td>
                    <td><?=$produit['nb_declinaison']?></td>
                    <td><?=$produit['stock']?></td>
    
    
                    <td>
                  <p><a href="produit.php?id=<?=$produit['id']?>">Editer</a> <a href="produit.php?id=<?=$produit['id']?>&suppr=1">Supprimer</a></p> 
    
                    </td>
                  </tr>
                <?php
                  }
                ?>
                <tr>
              </tbody>
            </table>
            
        

    </main>
   
    <?php require_once 'layout/footer.php'; ?>
        
    </body>
</html>

