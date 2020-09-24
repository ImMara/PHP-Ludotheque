<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>LUDOTHEQUE</title>
</head>
<body class="bg-dark" style="height: 100%;">
<?php
include "header.php";
?>
<div class="container-md bg-dark mb-3">
    <div class="row">
        <?php
        require "connexions.php";

        $jeux = $bdd->query("SELECT * FROM jeux");
        while ($don = $jeux->fetch()) {

            $title = $don['nom'];
            $info = $don['description'];
            $images = $don['pochette'];
            $link = $don['id'];

            echo "<div class=\"card col-lg-3 mt-3 bg-secondary p-0 \" style=\"height:300px;\">
            <img src=\"images\\$images\" class=\"card-img-top\" style='height: 60%;object-fit: cover' alt=\"$images\">
                <div class=\"card-body\">
                    <p class=\"card-text text-white text-center mb-2\" style='text-transform: uppercase;'>$title</p>
                 <div class=\"d-flex justify-content-center\">
                    <a href=\"info.php?id=$link\" class=\"mt-3 btn btn-danger\" style='width: 300px;'>MORE</a>
                 </div>
                </div>
            </div>";

        }
        ?>
    </div>
</div>
</body>
</html>
