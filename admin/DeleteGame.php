<?php

	session_start();

	if(!isset($_SESSION['login'])){
		header("LOCATION:403.php");
	}

	if(isset($_GET['id'])){
		$id=htmlspecialchars($_GET['id']);
		require '../connexions.php';

		$req=$bdd->prepare("SELECT * FROM jeux WHERE id=?");
		$req -> execute([$id]);

		if(!$don=$req->fetch()){
			header("LOCATION:admin.php");
		}
		$req->closeCursor();
	}else{
		header("LOCATION:articles.php");
	}
	if(isset($_GET['delete'])){
		if(!empty($don['pochette'])){
			unlink('../images/'.$don['pochette']);
			unlink('../images/mini_'.$don['pochette']);
		}
		$delete=$bdd->prepare("DELETE FROM jeux WHERE id=?");
		$delete ->execute([$id]);
		$delete ->closeCursor();
		header("LOCATION:admin.php?delete=success");
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
?>
<h1 class="text-white mt-5 mb-5">Supprimer <?=$don['nom'] ?> ? </h1>
<img class="pb-5" src="../images/mini_<?=$don['pochette']?>" alt="<?=$don['pochette']?>">
<br>
<a href="DeleteGame.php?id=<?=$don['id']?>&delete=accept" class="btn btn-outline-info justify-content-center" style='width: 100px'>Oui ?</a>
<a href="admin.php" class="btn btn-outline-danger justify-content-center\" style='width: 100px'>Non !</a>
</div>
</body>
</html>
