<?php
    function listeArticlesControleur($twig, $db){

        $liste = array();
        
        $article = new Article($db);
        $liste = $article->getArticle();
        echo $twig -> render('listeArticles.html.twig',array('liste'=>$liste));
    }

?>