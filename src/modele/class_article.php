<?php
	class Article{
        private $db;
        private $insert;
        private $getArticle;
        private $selectById;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO article(idProfil, titre, contenu, dateCreation)values(:idProfil,:titre,:contenu,NOW())");
            $this->getArticle = $this->db->prepare("SELECT P.id, P.pseudo, R.libelle, P.photo, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id");
			$this->selectById = $this->db->prepare("SELECT P.id, P.pseudo, R.libelle, P.photo, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id AND id=:id");
        }

        public function insert ($idProfil,$titre,$contenu){
			$r = true;
			$this->insert->execute(array(':idProfil'=>$idProfil,':titre'=>$titre,':contenu'=>$contenu));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
        }
        
        public function getArticle(){
			$this->getArticle->execute();
			if ($this->getArticle->errorCode()!=0){
				print_r($this->getArticle->errorInfo());
			}
			return $this->getArticle->fetchAll();
		}

        public function selectById($id){
			$this->selectById->execute(array(':id'=>$id));
			if ($this->selectById->errorCode()!=0){
				print_r($this->selectById->errorInfo());
			}
			return $this->selectById->fetch();
		}
    }
?>    