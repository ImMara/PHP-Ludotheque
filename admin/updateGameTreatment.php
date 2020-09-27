<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }

    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:admin.php?err=wrongid");
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
                $update = $bdd->prepare('UPDATE jeux SET nom=:nom,description=:description,editeur=:editeur,type=:type,id_support=:id_support WHERE id=:myid');
                $update ->execute([
                    ":nom"=>$nom,
                    ":description"=>$description,
                    ":editeur"=>$editeur,
                    ":type"=>$type,
                    ":id_support"=>$_POST['support'],
                    ":myid"=>$id
                ]);
                $update->closeCursor();
                header("LOCATION:admin.php?update=success");
            }else{
                $reqImg = $bdd->prepare("SELECT pochette FROM jeux WHERE id=?");
                $reqImg->execute([$id]);
                $donImg=$reqImg->fetch();

                if(!empty($donImg)){
                    unlink('../images/'.$donImg['pochette']);
                    unlink('../images/mini_'.$donImg['pochette']);
                }
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
                        $update = $bdd->prepare('UPDATE jeux SET nom=:nom,description=:description,editeur=:editeur,type=:type,id_support=:id_support,pochette=:pochette WHERE id=:myid');
                        $update->execute([
                            ":nom"=>$nom,
                            ":description"=>$description,
                            ":editeur"=>$editeur,
                            ":type"=>$type,
                            ":id_support"=>$_POST['support'],
                            ":pochette"=>$fichiercpt1,
                            ":myid"=>$id
                        ]);
                        $update->closeCursor();
                        if($extension==".png"){
                            header("LOCATION:redimpng.php?image=".$fichiercpt1);
                        }else{
                            header("LOCATION:redim.php?image=".$fichiercpt1);
                        }               
                    }
                    else 
                    {
                        header("LOCATION:updateGame.php?id=".$id."&upload=echec");
                    }
                }
                else
                {
                    header("LOCATION:updateGame.php?id=".$id."&fich=".$erreur);
                }   
            }
        }else{
            header("LOCATION:updateGame.php?id=".$id."err=".$err);
        }

    }else{
        header("LOCATION:updateGame.php?id=".$id);
    }
