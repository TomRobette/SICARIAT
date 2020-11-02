<?php
    function ajoutForumControleur($twig,$db){
        $form = array();     
        $forum = new Forum($db);
        
        if (isset($_POST['btPoster'])){  
            $inputLibelle = $_POST['inputLibelle'];
            $inputDescription = $_POST['inputDescription'];
            $form['valide'] = true;      
            $exec=$forum->insert($inputLibelle, $inputDescription);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table forum ';
            }
        }
        echo $twig -> render('ajoutForum.html.twig',array());
    }
?>