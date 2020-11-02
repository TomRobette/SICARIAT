<?php
    function modifProfilControleur($twig,$db){
        $form = array();     
        if(isset($_GET['profil'])){
            $profil = new Profil($db);
            $unProfil = $profil->selectByPseudo($_GET['profil']);
            $form['profil'] = $unProfil;
            if (isset($_POST['btModif'])){
                $inputEmail= $_POST['inputEmail'];
                $inputPassword= $_POST['inputPassword'];       
                $inputPassword2=$_POST['inputPassword2'];   
                $inputPseudo = $_POST['inputPseudo'];
                $form['valide'] = true;      
        
                $upload = new Upload(array('png', 'gif', 'jpg', 'jpeg'), 'images', 8000000);
                
                
                $photo = $upload->enregistrer('photo');
                if($photo == null){
                    $form['photo'] = $unProfil['photo'];
                }else{
                    $form['photo'] = $photo['nom'];
                }
    
                $mdp = password_hash($inputPassword,PASSWORD_DEFAULT);
                $mdp2 = password_hash($inputPassword2,PASSWORD_DEFAULT);
                $icn = $form['photo'];

                if($mdp == null || $mdp == ""){
                    $mdp = $unProfil['mdp'];
                }
                if($mdp2 == null || $mdp2 == ""){
                    $mdp2 = $unProfil['mdp'];
                }    
                if($photo == null || $photo == ""){
                    $icn = $unProfil['photo'];
                }

                if ($inputPassword!=$inputPassword2){        
                    $form['valide'] = false;          
                    $form['message'] = 'Les mots de passe sont différents';      
                }else{
                    $exec=$profil->modify($unProfil['id'], $inputPseudo, $inputEmail, $mdp, $icn);
                    if(!$exec){
                        $form['valide'] = false;
                        $form['message'] = 'Problème d\'insertion dans la table profil ';
                    }else{
                        $_SESSION['login'] = $inputPseudo;
                        $_SESSION['image'] = $form['photo'];    
                        header("Location:index.php");    
                    }
                }
                $form['email'] = $inputEmail;
            }
        }else{
            $form['message'] = 'Profil non précisé';
        }
        echo $twig -> render('modifProfil.html.twig',array('form'=>$form));
    }
?>