<?php
	class Profil{
		private $db;
		private $insert;
		private $connect;
		private $connectPseudo;
		private $selectById;
		private $selectByPseudo;
		private $show;
		private $update;
		private $delete;
		private $selectLimit;
		private $selectCount;
		private $changeShowEmail;
		private $hidden;
		private $addArticle;
		private $addReply;
		private $modify;

		public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO profil(pseudo, email, mdp, idRole, photo, dateInscription)values(:pseudo,:email,:mdp,:idRole,:photo, NOW())");
			$this->connect = $this->db->prepare("SELECT pseudo, email, idRole, mdp, photo FROM profil WHERE email=:email");
			$this->connectPseudo = $this->db->prepare("SELECT pseudo, email, idRole, mdp, photo FROM profil WHERE pseudo=:pseudo");
			$this->selectById = $this->db->prepare("SELECT P.id, P.pseudo, P.email, P.idRole, P.photo, R.libelle, P.dateInscription, P.nbArticles, P.nbReplies, P.hideEmail FROM profil P, role R WHERE P.idRole=R.id AND P.id=:id");
			$this->selectByPseudo = $this->db->prepare("SELECT P.id, P.pseudo, P.email, P.idRole, R.libelle, P.photo, P.dateInscription, P.nbArticles, P.nbReplies, P.hideEmail FROM profil P, role R WHERE P.idRole=R.id AND pseudo=:pseudo");
			$this->show = $this->db->prepare("SELECT id, pseudo, email, idRole, photo FROM profil");
			$this->update = $this->db->prepare("UPDATE profil SET pseudo=:pseudo, idRole=:idRole, photo=:photo WHERE id=:id");
			$this->delete = $this->db->prepare("DELETE FROM profil WHERE id=:id");
			$this->selectLimit = $this->db->prepare("SELECT id, pseudo, email, mdp, idRole, photo FROM profil ORDER BY id LIMIT :inf,:limite");
			$this->selectCount = $this->db->prepare("SELECT COUNT(*) AS nb FROM profil");
			$this->changeShowEmail = $this->db->prepare("UPDATE profil SET hideEmail=:hideEmail WHERE id=:id");
			$this->hidden = $this->db->prepare("SELECT hideEmail FROM profil WHERE id=:id");
			$this->addArticle = $this->db->prepare("UPDATE profil SET nbArticles=:nbArticles WHERE id=:id");
			$this->addReply = $this->db->prepare("UPDATE profil SET nbReplies=:nbReplies WHERE id=:id");
			$this->modify = $this->db->prepare("UPDATE profil SET pseudo=:pseudo, email=:email, mdp=:mdp, photo=:photo WHERE id=:id");
		}
        
        public function insert ($pseudo,$email,$mdp,$idRole,$photo){
			$r = true;
			$this->insert->execute(array(':pseudo'=>$pseudo,':email'=>$email,':mdp'=>$mdp,':idRole'=>$idRole,':photo'=>$photo));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
				$r=false;
			}
			return $r;
		}
		  
		public function connect($email){
			$unUtilisateur = $this->connect->execute(array(':email'=>$email));
			if ($this->connect->errorCode()!=0){
				print_r($this->connect->errorInfo());
			}
			return $this->connect->fetch();
		}

		public function connectPseudo($pseudo){
			$unUtilisateur = $this->connectPseudo->execute(array(':pseudo'=>$pseudo));
			if ($this->connectPseudo->errorCode()!=0){
				print_r($this->connectPseudo->errorInfo());
			}
			return $this->connectPseudo->fetch();
		}

		public function selectById($id){
			$this->selectById->execute(array(':id'=>$id));
			if ($this->selectById->errorCode()!=0){
				print_r($this->selectById->errorInfo());
			}
			return $this->selectById->fetch();
		}

		public function selectByPseudo($pseudo){
			$this->selectByPseudo->execute(array(':pseudo'=>$pseudo));
			if ($this->selectByPseudo->errorCode()!=0){
				print_r($this->selectByPseudo->errorInfo());
			}
			return $this->selectByPseudo->fetch();
		}

		public function show(){
			$this->show->execute();
			if ($this->show->errorCode()!=0){
				print_r($this->show->errorInfo());
			}
			return $this->show->fetchAll();
		}

		public function update($id, $pseudo, $role, $photo){
			$r = true;
			$this->update->execute(array(':id'=>$id, ':pseudo'=>$pseudo, ':role'=>$role, ':photo'=>$photo));
			if ($this->update->errorCode()!=0){
				print_r($this->update->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function delete($id){
			$r = true;
			$this->delete->execute(array(':id'=>$id));
			if ($this->delete->errorCode()!=0){
				print_r($this->delete->errorInfo());
				$r=false;
			}
			return $r;
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

		public function changeShowEmail($id){
			$r = true;
			$hide = $this->hidden($id);
			if($hide['hideEmail']==1){
				$this->changeShowEmail->execute(array(':id'=>$id, 'hideEmail'=>0));
			}else{
				$this->changeShowEmail->execute(array(':id'=>$id, 'hideEmail'=>1));
			}
			if ($this->changeShowEmail->errorCode()!=0){
				print_r($this->changeShowEmail->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function hidden($id){
			$this->hidden->execute(array(':id'=>$id));
			if ($this->hidden->errorCode()!=0){
				print_r($this->hidden->errorInfo());
			}
			return $this->hidden->fetch();
		}

		public function addArticle($id){
			$r = true;
			$profil = $this->selectById($id);
			if($profil['nbArticles']!=null){
				$nb = $profil['nbArticles']+1;
				$this->addArticle->execute(array(':id'=>$id, 'nbArticles'=>$nb));
			}else{
				$this->addArticle->execute(array(':id'=>$id, 'nbArticles'=>1));
			}
			if ($this->addArticle->errorCode()!=0){
				print_r($this->addArticle->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function addReply($id){
			$r = true;
			$profil = $this->selectById($id);
			if($profil['nbReplies']!=null){
				$nb = $profil['nbReplies']+1;
				$this->addReply->execute(array(':id'=>$id, 'nbReplies'=>$nb));
			}else{
				$this->addReply->execute(array(':id'=>$id, 'nbReplies'=>1));
			}
			if ($this->addReply->errorCode()!=0){
				print_r($this->addReply->errorInfo());
				$r=false;
			}
			return $r;
		}

		public function modify($id, $pseudo, $email, $mdp, $photo){
			$r = true;
			$this->modify->execute(array(':id'=>$id, ':pseudo'=>$pseudo, ':email'=>$email, ':mdp'=>$mdp, ':photo'=>$photo));
			if ($this->modify->errorCode()!=0){
				print_r($this->modify->errorInfo());
				$r=false;
			}
			return $r;
		}
	}
?>