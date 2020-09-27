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
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>Supprimer?</h1>
		<h2><a href="deleteGame.php?id=<?=$don['id']?>&delete=accept">oui</a></h2>
		<h2><a href="admin.php">Non</a></h2>
	</body>
	</html>