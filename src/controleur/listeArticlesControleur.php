<?php
    function listeArticlesControleur($twig, $db){

        $liste = array();

        $article = new Article($db);
        $liste = $article->getArticle();

        if(isset($_GET['id'])){
            $exec=$article->delete($_GET['id']);
           
            if (!$exec){
                $etat = false;
            }else{
                $etat = true;
            }
            header('Location: index.php?page=listearticles&etat='.$etat);
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
        $r = $article->selectCount();
        $nb = $r['nb'];


        $liste = $article->selectLimit($inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        
        echo $twig -> render('listeArticles.html.twig',array('form'=>$form,'liste'=>$liste));
    
    }

?>