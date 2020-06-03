<?php
    function profilControleur($twig,$db){
        $form = array();     
        if(isset($_GET['profil'])){
            $profil = new Profil($db);
            $unProfil = $profil->selectByPseudo($_GET['profil']);
            $form['profil'] = $unProfil;
        }else{
            $form['message'] = 'Profil non précisé';
        }
        echo $twig -> render('profil.html.twig',array('form'=>$form));
    }
?>