<?php
    function articleControleur($twig, $db){
        $form = array();
        if(isset($_GET['id'])){
            $article = new Article($db);
            $unArticle = $article->selectById($_GET['id']);
            if ($unArticle!=null){
                $form['article'] = $unArticle;
                $profil = new Profil($db);
                $unProfil = $profil->selectById($unArticle['idProfil']);
                $form['profil'] = $unProfil;
                $error = $article->vuePlusUn($_GET['id']);
            }else{
                $form['message'] = 'Article incorrect';
            }
        }else{
            $form['message'] = 'Article non précisé';
        }

        $listeReplies = array();
        $listeReplies = $article->getReplies($unArticle['idArticle']);
        $limite=10;
        if(!isset($_GET['nopage'])){
            $inf=0;
            $nopage=0;
        }else{
            $nopage=$_GET['nopage'];
            $inf=$nopage * $limite;
        }
        $r = $article->selectCountReplies();
        $nb = $r['nb'];

        $liste = array();
        $liste = $article->selectLimitReplies($unArticle['idArticle'],$inf,$limite);
        $form['nbpages'] = ceil($nb/$limite);
        $form['nopage'] = $nopage;

        if (isset($_POST['btPoster']) && $unArticle!=null){
            $inputContenu = $_POST['inputContenu'];
            
            $form['valide'] = true;      
            $profil = new Profil($db);
            $idProfil = $profil->selectByPseudo($_SESSION['login']);
            $article=new Article($db);
            $exec=$article->addReply($idProfil['id'], $inputContenu, $unArticle['idArticle']);
            if(!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table reponse ';
            }
            $profil->addReply($idProfil['id']);
        }

        echo $twig->render('article.html.twig', array('form'=>$form,'listeReplies'=>$listeReplies,'liste'=>$liste));
    }
       
?>