<?php
    function articleControleur($twig, $db){
        $form = array();
        if(isset($_GET['id'])){
            $article = new Article($db);
            $unArticle = $article->selectById($_GET['id']);
            if ($unArticle!=null){
                $form['article'] = $unArticle;
                $profil = new Profil($db);
                $unProfil = $profil->selectById($unArticle['id']);
                $form['profil'] = $unProfil;
            }else{
                $form['message'] = 'Utilisateur incorrect';
            }
        }else{
            $form['message'] = 'Article non précisé';
        }
        echo $twig->render('article.html.twig', array('form'=>$form));
    }
       
?>