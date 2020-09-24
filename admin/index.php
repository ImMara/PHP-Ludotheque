<?php
session_start();

if(isset($_POST['login'])){
    if($_POST['login']=="" && $_POST['password']){
        $err="<div class='alert alert-danger'>Veuillez remplir correctement le formulaire</div>";
    }else{
        $login = htmlspecialchars($_POST['login']);
        $password = $_POST['password'];

        require "../connexions.php";
        $req = $bdd-> prepare('SELECT * FROM membre WHERE login=?');
        $req->execute([$login]);
        if($don = $req->fetch()){
            if(password_verify($password,$don['password'])){
                $_SESSION['login']=$don['login'];
                $_SESSION['id']=$don['id'];
                header("LOCATION:admin.php");
            }else{
                $err="<div class='alert alert-danger'>Votre mot de passe n'est pas correct</div>";
            }
        }else{
            $err= "<div class='alert alert-danger'>Votre login n'est pas correct</div>";
        }
    }
}
?>
<!doctype html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>LUDOTHEQUE ADMIN</title>
</head>
<body class="bg-dark h-100">
<div class="d-flex justify-content-center h-100">
    <div class="card align-self-center">
        <h5 class="card-header bg-dark text-white text-center py-4">
            <strong>Sign in</strong>
        </h5>
        <div class="card-body px-lg-5 pt-3">
            <form class="text-center" action="index.php" method="post" style="width: 300px;height:30S0px">
                <div class="md-form">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" class="form-control">
                </div>
                <div class="md-form">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button class="btn btn-outline-danger btn-rounded btn-block my-4  z-depth-0" type="submit">
                    Sign in
                </button>
                <a href="../index.php" class="btn btn-outline-info justify-content-center" style="width:100%;">Retour</a>
                <?php
                    if(isset($err)){
                        echo $err;
                     }
                ?>
            </form>
        </div>
    </div>
</div>
</body>
</html>