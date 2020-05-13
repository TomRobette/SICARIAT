<?php
    function inscriptionControleur($twig,$db){


      $form = array();     
      if (isset($_POST['btInscrire'])){
        $inputEmail= $_POST['inputEmail'];
        $inputPassword= $_POST['inputPassword'];       
        $inputPassword2=$_POST['inputPassword2'];   
        $inputPseudo = $_POST['inputPseudo'];
        $role = $_POST['role'];      
        $form['valide'] = true;      

        $upload = new Upload(array('png', 'gif', 'jpg', 'jpeg'), 'images', 500000);
        $photo = $upload->enregistrer('photo');

        if ($inputPassword!=$inputPassword2){        
          $form['valide'] = false;          
          $form['message'] = 'Les mots de passe sont différents';      
        }else{
          $profil=new Profil($db);
          $exec=$profil->insert($inputPseudo,$inputEmail,password_hash($inputPassword,PASSWORD_DEFAULT),$role, $photo['nom']);
          if(!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
          }
        }
      }
        $form['email'] = $inputEmail;
        $form['role'] = $role;
        echo $twig -> render('inscription.html.twig',array());
    }
?>