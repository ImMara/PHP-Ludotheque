<?php
    if(isset($_GET['search'])){
        $search=htmlspecialchars($_GET['search']);
    }else{
        $search="";
    }
?>
<div class="container-md bg-dark mb-3">
  <h1 class="text-white mt-5">Resultat de recherche : </h1>
    <div class="row">

<?php
          if(empty($search)){
            include "indexContent.php";
          }

         if(!empty($search)){
            require "connexions.php";
            $req= $bdd->prepare("SELECT * FROM jeux WHERE nom LIKE :nom");
            $req->execute([
               ":nom" => "%".$search."%"
               ]);
            $row = $req->rowCount();
            if($row!=0){
                while($don=$req->fetch()){

                    $title = $don['nom'];
                    $info = $don['description'];
                    $images = $don['pochette'];
                    $link = $don['id'];

                   echo "<div class=\"card col-lg-3 mt-3 bg-secondary p-0 \" style=\"height:300px;\">
                        <img src=\"images\mini_$images\" class=\"card-img-top\" style='height: 60%;object-fit: cover' alt=\"$images\">
                        <div class=\"card-body\">
                           <p class=\"card-text text-white text-center mb-2\" style='text-transform: uppercase;'>$title</p>
                            <div class=\"d-flex justify-content-center\">
                          <a href=\"info.php?id=$link\" class=\"mt-3 btn btn-danger\" style='width: 300px;'>MORE</a>
                        </div>
                        </div>
                          </div>";
               }
            }else{
                echo "<div class='mt-5 mb-5 text-danger'>aucun résultat pour <span class='text-info'>".$search."</span></div>";
            }
           $req->closeCursor();
        }
       ?>
          </div>
</div>