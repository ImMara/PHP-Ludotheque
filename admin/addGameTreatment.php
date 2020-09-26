<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }
    // FORMULAIRE CHECK
    if(isset($_POST['nom'])){
        $err=0;//ERR
        if(!empty($_POST['nom'])){
            $nom=htmlspecialchars($_POST['nom']);
        }else{
            $err=1;
        }
        if(!empty($_POST['description'])){
            $description=htmlspecialchars($_POST['description']);
        }else{
            $err=2;
        }
        if(!empty($_POST['editeur'])){
            $editeur=htmlspecialchars($_POST['editeur']);
        }else{
            $err=3;
        }
        if($err==0){
            require '../connexions.php';
            if(empty($_FILES['fichier']['tmp_name'])){
                // no image
                $insert = $bdd->prepare('INSET INTO jeux(nom,description,editeur,type)VALUES(:nom,:description,:editeur,:type)');
                $insert->execute([
                    ":nom"=>$nom,
                    ":description"=>$description,
                    ":editeur"=>$editeur,
                    ":type"=>$_POST['editeur']
                ]);
                $insert->closeCursor();
                header("LOCATION:addGame.php?insert=success");
            }else{
                //file
                $dossier = '../images/';
                $fichier= basename($_FILES['fichier']['tmp_name']);
                $taille_maxi = 20000;
                $taille=filesize($_FILES['fichier']['tmp_name']);
                $extensions = ['.png','.jpg','.jpeg'];
                $extension= strrchr($_FILES['fichier']['name'],'.');

                if(!in_array($extension,$extensions)){
                    $erreur = 'Vous devez upload un fichier png jpg ou jpeg';
                }
                if($taille>$taille_maxi){
                    $erreur = 'le fichier depasse la taille autorisée';
                }
                if(!isset($erreur)){
                    $fichier = strtr($fichier,
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    )
                }
            }
        }
    }else{ // FIN FORMULAIRE CHECK

    }
