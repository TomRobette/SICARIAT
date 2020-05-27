<?php
    function connexionControleur($twig,$db){
        $form = array();    
         
        if (isset($_POST['btConnecter'])){        
            $form['valide'] = true;        
            $inputLogin = $_POST['inputEmail'];        
            $inputPassword = $_POST['inputPassword'];    
            $profil = new Profil($db);        
            if (isEmail($inputLogin)) {
                //Si c'est une addresse email valide
                $unProfil = $profil->connect($inputLogin);
            }else{
                //Ce peut être un pseudo
                $unProfil = $profil->connectPseudo($inputLogin);
            }
            
            if ($unProfil!=null){          
                if(!password_verify($inputPassword,$unProfil['mdp'])){              
                    $form['valide'] = false;       
                    $form['message'] = 'Login ou mot de passe incorrect';          
                }else{ 
                    $_SESSION['login'] = $unProfil['pseudo'];            
                    $_SESSION['role'] = $unProfil['idRole'];
                    $_SESSION['image'] = $unProfil['photo'];    
                    header("Location:index.php");          
                }         
            }else{           
                $form['valide'] = false;           
                $form['message'] = 'Login ou mot de passe incorrect';        
            }    
        }
        echo $twig -> render('connexion.html.twig',array('form'=>$form));
    
    }

    function isEmail($email) {
        $find1 = strpos($email, '@');
        $find2 = strpos($email, '.');
        return ($find1 !== false && $find2 !== false && $find2 > $find1);
    }

?>