<?php
function getPage($db){
    $lesPages['accueil']="accueilControleur";
    $lesPages['connexion']="connexionControleur";
    $lesPages['inscription']="inscriptionControleur";
    $lesPages['deconnexion']="deconnexionControleur";
    $lesPages['profil']="profilControleur";
    $lesPages['modifprofil']="modifProfilControleur";
    $lesPages['article']="articleControleur";
    $lesPages['ajoutarticle']="ajoutArticleControleur";
    $lesPages['listearticles']="listeArticlesControleur";
    $lesPages['recherche']="accueilControleur";
    $lesPages['maintenance']="maintenanceControleur";
    
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