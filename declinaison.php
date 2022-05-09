<?php require 'fonctions/fonctions_declinaison.php';?>

<!DOCTYPE html>
<html lang='fr-FR'>
    <head>
        <title>Declinaison</title>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0' />
        <meta name='description' content=`Une description de la page` />
        <link rel='stylesheet' href=reset.css />
        <link rel='stylesheet' href=style.css />
        <script src='main.js' defer></script>
    </head>
    <body>
        <?php require 'layout/header.php';?>
        <main>
            
            <h1>Declinaisons de <?=$produitSelect['title']?></h1>
            <?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])&& !isset($_GET['suppr'])){ echo '<h2>Modifier</h2>';}elseif(isset($_GET['suppr'])&& $_GET['suppr'] == 1){ echo "<h2>Supprimer</h2>";}else{echo '<h2>Ajouter</h2>';}?>
            <form action="declinaison.php?id_produit=<?=$produitSelect['id']?>" method="post">
            
            <input type="hidden" name="id" id="id" value ="<?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])){ echo $declinaisonSelect['id'];}?>">
    <?php 
      if(isset($_GET['suppr'])&& $_GET['suppr'] == 1){
        ?>
        <input type="hidden" name="suppr" id="suppr" value ="1">
        <input type="submit" value="La suppression est définitive">
        <?php
    }else{

    ?>
        <input type="hidden" name="id_produit" id="id_produit" placeholder='id_produit' value="<?=$produitSelect['id']?>">
        <input type="text" name="title" id="title" placeholder='Titre' value="<?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])){ echo $declinaisonSelect['title'];}?>">
        <input type="text" name="reference" id="reference" placeholder ='Reference' value="<?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])){ echo $declinaisonSelect['reference'];}?>">
        <input type="number" name="price" id="price" placeholder='Prix' value="<?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])){ echo $declinaisonSelect['price'];}?>">
        <input type="number" name="stock" id="stock" placeholder='Stock' value="<?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])){ echo $declinaisonSelect['stock'];}?>">
        <input type="submit" value="<?php if(isset($declinaisonSelect['id'])&&!empty($declinaisonSelect['id'])){ echo 'MODIFIER';}else{echo 'AJOUTER';} ?>">
        <?php 
      }
        ?>
    </form>
    <?php 
    
    $declinaisons = declinaisonSelectAllById_Produit($mysqlclient,$produitSelect['id']);
    if (isset($declinaisons)&&!empty($declinaisons)){
        
    
        ?>
        <a href="declinaison.php?id_produit=<?=$produitSelect['id']?>">Ajouter declinaisons</a>
        <br> <br> <br>
        <table>
            <thead>
                <tr>
                <th colspan="1">id</th>
                <th colspan="1">title</th>
                <th colspan="1">reference</th>
                <th colspan="1">prix</th>
                <th colspan="1">stock</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($declinaisons as $key => $declinaison){ ?>
                <tr>
                    <td><?=$declinaison['id']?></td>
                    <td><?=$declinaison['title']?></td>
                    <td><?=$declinaison['reference']?></td>
                    <td><?=$declinaison['price']?>$</td>
                    <td><?=$declinaison['stock']?></td>


                    <td>
                <p><a href="declinaison.php?id_produit=<?=$produitSelect['id']?>&id=<?=$declinaison['id']?>">Editer</a> <a href="declinaison.php?id_produit=<?=$produitSelect['id']?>&id=<?=$declinaison['id']?>&suppr=1">Supprimer</a></p> 

                    </td>
                </tr>
                <?php
                }
                ?>
                <tr>
            </tbody>
            </table>
        <?php }?>
        </main>
        <?php require_once 'layout/footer.php'; ?>
    </body>
</html>