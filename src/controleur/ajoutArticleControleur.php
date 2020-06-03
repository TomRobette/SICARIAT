<?php
    function ajoutArticleControleur($twig,$db){
        $form = array();     
        if (isset($_POST['btPoster'])){  
            $inputTitre = $_POST['inputTitre'];
            $inputContenu = $_POST['inputContenu'];
            $form['valide'] = true;      
            $profil = new Profil($db);
            $idProfil = $profil->selectByPseudo($_SESSION['login']);
            $article=new Article($db);
            $exec=$article->insert($idProfil['id'], $inputTitre, $inputContenu);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table article ';
            }
            $profil->addArticle($idProfil['id']);
        }
        echo $twig -> render('ajoutArticle.html.twig',array());
    }
?>