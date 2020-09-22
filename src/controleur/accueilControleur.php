<?php
    function accueilControleur($twig){
        echo $twig -> render('index.html.twig',array());
    }

    function rechercheControleur($twig, $db){
        $form = array();     
        if (isset($_POST['btRecherche'])){  
            $inputRecherche = $_POST['inputRecherche'];
            $form['valide'] = true;      
            $article = new Article($db);
            $resultats = $article->recherche($inputRecherche);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème de la recherche ';
            }
        }
        echo $twig -> render('recherche.html.twig',array('resultats'=>$resultats));
    }
?>

