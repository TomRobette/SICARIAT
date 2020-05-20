<?php
	class Article{
        private $db;
        private $insert;
        private $getArticle;
        private $selectById;
		private $selectLimit;
		private $selectCount;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO article(idProfil, titre, contenu, dateCreation)values(:idProfil,:titre,:contenu,NOW())");
            $this->getArticle = $this->db->prepare("SELECT P.id, P.pseudo, R.libelle, P.photo, A.id AS idArticle, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id");
			$this->selectById = $this->db->prepare("SELECT P.id, P.pseudo, R.libelle, P.photo, A.id AS idArticle, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id AND id=:id");
			$this->selectLimit = $db->prepare("SELECT P.id, P.pseudo, R.libelle, P.photo, A.id AS idArticle, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id ORDER BY P.id LIMIT :inf,:limite");
			$this->selectCount =$db->prepare("SELECT COUNT(*) AS nb FROM article");
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

		public function selectLimit($inf, $limite){
			$this->selectLimit->bindParam(':inf', $inf, PDO::PARAM_INT);
			$this->selectLimit->bindParam(':limite', $limite, PDO::PARAM_INT);
			$this->selectLimit->execute();
			if ($this->selectLimit->errorCode()!=0){
				print_r($this->selectLimit->errorInfo());
			}
			return $this->selectLimit->fetchAll();
		}

		public function selectCount(){
			$this->selectCount->execute();
			if ($this->selectCount->errorCode()!=0){
				print_r($this->selectCount->errorInfo());
			}
			return $this->selectCount->fetch();
		}
    }
?>    