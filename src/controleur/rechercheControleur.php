<?php
    function rechercheControleur($twig, $db){
        $form = array();     
        $inputRecherche = $_POST['inputRecherche'];
        $form['valide'] = true;      
        $article = new Article($db);
        $resultats = $article->recherche($inputRecherche);
        $limite=10;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $article->selectCountResearch();
        $nb = $r['nb'];


        $liste = $article->selectLimitResearch($inf,$limite,$inputRecherche);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        echo $twig -> render('recherche.html.twig',array('resultats'=>$resultats));
    }
?>