<?php
    function connexionControleur($twig,$db){
        $form = array();    
         
        if (isset($_POST['btConnecter'])){        
            $form['valide'] = true;        
            $inputEmail = $_POST['inputEmail'];        
            $inputPassword = $_POST['inputPassword'];    
            $profil = new Profil($db);        
            $unProfil = $profil->connect($inputEmail);        
            if ($unProfil!=null){          
                if(!password_verify($inputPassword,$unProfil['mdp'])){              
                    $form['valide'] = false;       
                    $form['message'] = 'Login ou mot de passe incorrect';          
                }else{ 
                    $_SESSION['login'] = $inputEmail;                
                    $_SESSION['role'] = $unProfil['idRole'];           
                    header("Location:index.php");          
                }         
            }else{           
                $form['valide'] = false;           
                $form['message'] = 'Login ou mot de passe incorrect';        
            }    
        }
        echo $twig -> render('connexion.html.twig',array('form'=>$form));
    
    }

?>