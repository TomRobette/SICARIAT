<?php
    function listeArticlesControleur($twig, $db){

        $liste = array();

        $article = new Article($db);
        $liste = $article->getArticle();

        $limite=8;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $article->selectCount();
        $nb = $r['nb'];


        $liste = $article->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        
        echo $twig -> render('listeArticles.html.twig',array('form'=>$form,'liste'=>$liste));
    
    }

?>