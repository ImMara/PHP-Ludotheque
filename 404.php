<?php
header("HTTP/1.0 404 Not Found");
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

<?php
include "header.php";
?>
<div class="container">
<div class="mt-5 alert" role="alert" style="background-color: #090909">
    <p class="text-center text-white font-weight-bold">Aww yeah, nothing here </p>
    <div class="d-flex justify-content-center">
    <img src="images/404.png.jpg" alt="404" style="height:400px;object-fit: cover">
    </div>
</div>
</div>
</body>
</html>
