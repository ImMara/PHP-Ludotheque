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
            <img src=\"images\mini_$images\" class=\"card-img-top\" style='height: 60%;object-fit: cover' alt=\"$images\">
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