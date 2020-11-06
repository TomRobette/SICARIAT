<?php
    function accueilControleur($twig, $db){
        $liste = array();

        $profil = new Profil($db);
        $liste = $profil->show();

        if(isset($_GET['id'])){
            $exec=$profil->delete($_GET['id']);
            if (!$exec){
                $etat = false;
                $unProfil=$profil->selectById($_GET['id']);
                $etat = $profil->modify($unProfil['id'], "Sicaire supprimé", "adresse@supprimee.com", $unProfil['mdp'], "", 7);
            }else{
                $etat = true;
            }
            $form['etat']=$etat;
            header('Location: index.php?page=accueil&etat='.$etat);
            exit;
        }
        if(isset($_GET['modif'])){
            header('Location: index.php?page=modifprofil&profil='.$_GET['modif']);
            exit;
        }

        $limite=8;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $profil->selectCount();
        $nb = $r['nb'];


        $liste = $profil->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        echo $twig -> render('index.html.twig',array('form'=>$form,'liste'=>$liste));
    }
?>

