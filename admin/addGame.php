<?php

session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:403.php");
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
    <h1 class="text-info">Ajouter un jeux</h1>
    <form action="addGameTreatment.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom" class="text-white">Nom: </label>
            <input type="text" value="" id="nom" name="nom" class="bg-dark text-white form-control">
        </div>
        <div class="form-group">
            <label for="description" class="text-white">Description: </label>
            <textarea  value="" id="description" name="description" class="text-white bg-dark form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="editeur" class="text-white">Editeur: </label>
            <input type="text" value="" id="editeur" name="editeur" class="text-white bg-dark form-control">
        </div>
        <div class="form-group">
            <label for="type" class="text-white">Type: </label>
            <input type="text" value="" id="type" name="type" class="text-white bg-dark form-control">
        </div>
        <div class="form-group">
            <label for="type" class="text-white">Support: </label>
            <select name="support" id="type" class="text-white bg-dark form-control">

                <option class="text-white" value="" selected hidden>Choisis le support</option>
                <?php

                require "../connexions.php";

                $type = $bdd->query('SELECT support,id_support FROM support');
                while($don= $type->fetch()){

                    $supp =$don['id_support'];
                    $nomSupp=$don['support'];

                    echo "<option class='text-white' value=\"$supp\">$nomSupp</option>";

                }
                ?>
            </select>
        </div>
        <div class="custom-file bg-dark">
            <input type="file" class="bg-dark custom-file-input" id="file" name="fichier">
            <label for="file" class="text-white bg-dark custom-file-label">Choisir le fichier</label>
        </div>
        <div class="form-group">
            <input type="submit" value="Ajouter" class="btn btn-info my-3">
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
