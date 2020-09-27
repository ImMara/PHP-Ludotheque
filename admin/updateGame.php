<?php
session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:403.php");
}
if(isset($_GET['id'])){
    $id=htmlspecialchars($_GET['id']);
    require '../connexions.php';
    $game = $bdd->prepare('SELECT * FROM jeux WHERE id=?');
    $game ->execute([$id]);
    if(!$don=$game ->fetch()){
        $game->closeCursor();
        header("LOCATION:admin.php");
    }
}else{
    header('LOCATION:admin.php?iderr');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="bg-dark">
<div class="container">
    <?php
    include "nav.php";
    ?>
    <h1 class="text-info">Modifier le jeux : <?=$don['nom']?></h1>
    <form action="updateGameTreatment.php?id=<?=$don['id']?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom" class="text-white">Nom: </label>
            <input type="text" value="<?=$don['nom']?>" id="nom" name="nom" class="bg-dark text-white form-control">
        </div>
        <?php
         if(isset($_GET['err'])){
            if($_GET['err']==1){
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                         Champs invalide : Entrée un nom de jeux .
                      </div>";
            }
        }
        ?>
        <div class="form-group">
            <label for="description" class="text-white">Description: </label>
            <textarea  value="" id="description" name="description" rows="8" class="text-white bg-dark form-control"><?=$don['description']?></textarea>
        </div>
        <?php
         if(isset($_GET['err'])){
            if($_GET['err']==2){
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                         Champs invalide : Entrée une description .
                      </div>";
            }
        }
        ?>
        <div class="form-group">
            <label for="editeur" class="text-white">Editeur: </label>
            <input type="text" value="<?=$don['editeur']?>" id="editeur" name="editeur" class="text-white bg-dark form-control">
        </div>
        <?php
         if(isset($_GET['err'])){
            if($_GET['err']==3){
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                         Champs invalide : Entrée un editeur .
                      </div>";
            }
        }
        ?>
        <div class="form-group">
            <div class="form-group">
            <label for="type" class="text-white">Type: </label>
            <input type="text" value="<?=$don['type']?>" id="type" name="type" class="text-white bg-dark form-control">
        </div>
            <label for="support" class="text-white">Support: </label>
            <select name="support" id="support" class="text-white bg-dark form-control">
                <?php

                require "../connexions.php";

                $type = $bdd->query('SELECT support,id_support FROM support');
                while($donS= $type->fetch()){

                    $supp =$donS['id_support'];
                    $nomSupp=$donS['support'];

                    if($don['id_support']==$donS['id_support']){
                        echo "<option selected class='text-white' value=\"$supp\">$nomSupp</option>";
                    }
                    echo "<option class='text-white' value=\"$supp\">$nomSupp</option>";
                }
                ?>
            </select>
        </div>
        <?php
         if(isset($_GET['err'])){
            if($_GET['err']==4){
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                         Champs invalide : Entrée un type de jeux .
                      </div>";
            }
        }
        ?>
        <div class="custom-file bg-dark">
            <input type="file" class="bg-dark custom-file-input" id="file" name="fichier">
            <label for="file" class="text-white bg-dark custom-file-label">Choisir le fichier</label>
        </div>
        <?php
         if(isset($_GET['upload'])){
            if($_GET['upload']=="echec"){
                echo "<div class=\"alert alert-warning\" role=\"alert\">
                         Erreur upload , réessayer
                      </div>";
            }
        }
        if(isset($_GET['uperror'])){
                    echo "<div class=\"alert alert-warning\" role=\"alert\">
                        Erreur upload : ".htmlspecialchars($_GET['uperror'])."
                      </div>";
                }
        ?>
        <div class="form-group">
            <input type="submit" value="Modifier" class="btn btn-info my-3">
            <a href="admin.php" class="btn btn-danger my-3 mx-1">Retour</a>
        </div>
    </form>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>
</html>

