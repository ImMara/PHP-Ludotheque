<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }
    if(isset($_GET['deconnexion'])){
        session_destroy();
        header("LOCATION:index.php");
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
    <title>Document</title>
</head>
<body class="bg-dark">
<div class="container">
<?php
include 'nav.php';

if(isset($_GET['insert'])){
  echo "<div class=\"alert alert-success\" role=\"alert\">
             insert success bitch!
        </div>";
}
if(isset($_GET['update'])){
    echo "<div class=\"alert alert-success\" role=\"alert\">
             update success bitch!
        </div>";
}
?>
<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOM</th>
        <th scope="col">POCHETTE</th>
        <th scope="col">Modifier/supprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php

        require '../connexions.php';

        $game = $bdd->query('SELECT * FROM jeux');
        while($don= $game->fetch()){

            $gameNom=$don['nom'];
            $gameId=$don['id'];
            $gamePochette=$don['pochette'];

            echo   "<tr>
                       <td>$gameId</td>
                       <td>$gameNom</td>
                       <td>$gamePochette</td>
                       <td>
                           <a href=\"updateGame.php?id=$gameId\" class=\"btn btn-outline-info justify-content-center\" style='width: 100px'>Modifier</a>
                           <a href=\"deleteGame.php?id=$gameId\" class=\"btn btn-outline-danger justify-content-center\">Supprimer</a>
                       </td>
                    </tr>";
        }
        $game -> closeCursor();
    ?>
    </tbody>
</table>
</div>
</body>
</html>
