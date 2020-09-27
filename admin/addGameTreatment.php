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
        if(!empty($_POST['type'])){
            $type=htmlspecialchars($_POST['type']);
        }else{
            $err=4;
        }
        if(empty($_POST['support'])){
            $err=5;
        }
        if($err==0){
            require '../connexions.php';
            if(empty($_FILES['fichier']['tmp_name'])){
                // no image
                $insert = $bdd->prepare('INSERT INTO jeux(nom,description,editeur,type,id_support)VALUES(:nom,:description,:editeur,:type,:id_support)');
                $insert->execute([
                    ":nom"=>$nom,
                    ":description"=>$description,
                    ":editeur"=>$editeur,
                    ":type"=>$type,
                    ":id_support"=>$_POST['support']
                ]);
                $insert->closeCursor();
                header("LOCATION:admin.php?insert=success");
            }else{
                //file
                $dossier = '../images/';
                $fichier= basename($_FILES['fichier']['name']);
                $taille_maxi = 2000000;
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
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                    $fichiercpt1=rand().$fichier;
                    if(move_uploaded_file($_FILES['fichier']['tmp_name'],$dossier.$fichiercpt1)){
                        $insert = $bdd->prepare('INSERT INTO jeux(nom,description,editeur,type,id_support,pochette)VALUES(:nom,:description,:editeur,:type,:id_support,:pochette)');
                        $insert->execute([
                            ":nom"=>$nom,
                            ":description"=>$description,
                            ":editeur"=>$editeur,
                            ":type"=>$type,
                            ":id_support"=>$_POST['support'],
                            ":pochette"=>$fichiercpt1
                        ]);
                        $insert->closeCursor();
                        if($extension==".png"){
                            header("LOCATION:redimpng.php?image=".$fichiercpt1)."&insert";
                        }else{
                            header("LOCATION:redim.php?image=".$fichiercpt1)."&insert";
                        }               
                    }
                    else 
                    {
                        header("LOCATION:addGame.php?error=1&upload=echec");
                    }
                }
                else
                {
                    header("LOCATION:addGame.php?error=1&fich=".$erreur);
                }   
            }
        }else{
            header("LOCATION:addGame.php?err=".$err);
        }

    }else{
        header("LOCATION:addGame.php");
    }
