<?php
function getPage($db){
    $lesPages['accueil']="accueilControleur";
    $lesPages['connexion']="connexionControleur";
    $lesPages['inscription']="inscriptionControleur";
    
    if($db!=NULL){
        if(isset($_GET['page'])) {
            $page=$_GET['page'];
        }else{
            $page='accueil';
        }
    
        if(isset($lesPages[$page])){
            $contenu=$lesPages[$page];
        
        }else{
            $contenu=$lesPages['accueil'];
        }
    
        return $contenu;
    }else{
        return $lesPages['maintenance'];
    }       
}
?>