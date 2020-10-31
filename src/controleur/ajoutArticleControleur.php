<?php
    function ajoutArticleControleur($twig,$db){
        $liste = array();
        $form = array();     
        $article = new Article($db);
        $liste = $article->getForums();
        
        if (isset($_POST['btPoster'])){  
            $inputTitre = $_POST['inputTitre'];
            $inputContenu = $_POST['inputContenu'];
            $form['valide'] = true;      
            $profil = new Profil($db);
            $idProfil = $profil->selectByPseudo($_SESSION['login']);
            $exec=$article->insert($idProfil['id'], $inputTitre, $inputContenu, 1);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table article ';
            }
            $profil->addArticle($idProfil['id']);
        }
        echo $twig -> render('ajoutArticle.html.twig',array('liste'=>$liste));
    }
?>