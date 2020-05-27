<?php
	class Article{
        private $db;
        private $insert;
        private $getArticle;
        private $selectById;
		private $selectLimit;
		private $selectCount;
		private $addReply;
		private $getReplies;
		private $selectLimitReplies;
		private $selectCountReplies;

        public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO article(idProfil, titre, contenu, dateCreation)values(:idProfil,:titre,:contenu,NOW())");
            $this->getArticle = $this->db->prepare("SELECT A.idProfil, P.pseudo, R.libelle, P.photo, A.id AS idArticle, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id");
			$this->selectById = $this->db->prepare("SELECT A.idProfil, P.pseudo, R.libelle, P.photo, A.id AS idArticle, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id AND A.id=:id");
			$this->selectLimit = $db->prepare("SELECT P.id, P.pseudo, R.libelle, P.photo, A.id AS idArticle, A.titre, A.contenu, A.dateCreation, A.dateModif, A.nbVues FROM article A, profil P, role R WHERE A.idProfil=P.id AND P.idRole=R.id ORDER BY P.id LIMIT :inf,:limite");
			$this->selectCount =$db->prepare("SELECT COUNT(*) AS nb FROM article");
			$this->addReply = $this->db->prepare("INSERT INTO reponse(idProfil, contenu, idArticle, dateCreation)values(:idProfil,:contenu,:idArticle,NOW())");
			$this->getReplies = $this->db->prepare("SELECT RP.contenu, P.pseudo, R.libelle, P.photo, A.id AS idArticle FROM article A, profil P, role R, reponse RP WHERE P.idRole=R.id AND RP.idProfil=P.id AND RP.idArticle=A.id AND A.id=:id");
			$this->selectLimitReplies = $db->prepare("SELECT RP.contenu, P.pseudo, R.libelle, P.photo, A.id AS idArticle FROM article A, profil P, role R, reponse RP WHERE P.idRole=R.id AND RP.idProfil=P.id AND RP.idArticle=A.id ORDER BY RP.dateCreation LIMIT :inf,:limite");
			$this->selectCountReplies =$db->prepare("SELECT COUNT(RP.id) AS nb FROM reponse RP, article A WHERE RP.idArticle=A.id");
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

		public function addReply ($idProfil,$contenu,$idArticle){
			$r = true;
			$this->addReply->execute(array(':idProfil'=>$idProfil,':contenu'=>$contenu,'idArticle'=>$idArticle));
			
			if($this->addReply->errorCode()!=0){
				print_r($this->addReply->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function getReplies($id){
			$this->getReplies->execute(array(':id'=>$id));
			if ($this->getReplies->errorCode()!=0){
				print_r($this->getReplies->errorInfo());
			}
			return $this->getReplies->fetchAll();
		}


		
		public function selectLimitReplies($inf, $limite){
			$this->selectLimitReplies->bindParam(':inf', $inf, PDO::PARAM_INT);
			$this->selectLimitReplies->bindParam(':limite', $limite, PDO::PARAM_INT);
			$this->selectLimitReplies->execute();
			if ($this->selectLimitReplies->errorCode()!=0){
				print_r($this->selectLimitReplies->errorInfo());
			}
			return $this->selectLimitReplies->fetchAll();
		}

		public function selectCountReplies(){
			$this->selectCountReplies->execute();
			if ($this->selectCountReplies->errorCode()!=0){
				print_r($this->selectCountReplies->errorInfo());
			}
			return $this->selectCountReplies->fetch();
		}
    }
?>    