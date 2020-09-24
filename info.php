<?php
    if(isset($_GET["id"])) {
        $id = htmlspecialchars($_GET['id']);
        require "connexions.php";
        $game = $bdd->prepare("SELECT * FROM jeux INNER JOIN support ON jeux.id_support=support.id_support WHERE id=?");
        $game->execute([$id]);
        if(!$don= $game->fetch()){
            header("LOCATION:404.php");
        }
   }else{
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
    <title>LUDOTHEQUE : <?=$don['nom']?></title>
</head>

<body class="bg-dark">
<?php
    include "header.php";
?>
    <div class="container border border-danger mt-3 mb-3">
        <img src="images/<?=$don["pochette"]?>" alt="<?=$don["pochette"]?>" style="width: 100%;object-fit: cover;height: 150px;background-position: center center;">
        <h1 class="text-white text-center" style="text-decoration: underline;text-transform: uppercase;"><?=$don["nom"]?></h1>
        <h4 class="text-white text-center">Type : <?=$don["type"]?></h4>
        <h4 class="text-white text-center">Editeur : <?=$don["editeur"]?></h4>
        <h4 class="text-white text-center">Support : <?=$don["support"]?></h4>
        <h2 class="text-white text-center" style="text-decoration: underline">SYNOPSIS</h2>
        <p class="text-white text-center pl-5 pr-5"><?=nl2br($don["description"])?></p>
        <div class="d-flex justify-content-center mb-3">
            <a href="index.php" class="btn btn-outline-danger justify-content-center" style="width:30%;">Retour</a>
        </div>
    </div>
</body>
</html>
