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

		public function __construct($db){
            $this->db=$db;
            $this->insert = $this->db->prepare("INSERT INTO profil(pseudo, email, mdp, idRole, photo)values(:pseudo,:email,:mdp,:idRole,:photo)");
			$this->connect = $this->db->prepare("SELECT pseudo, email, idRole, mdp, photo FROM profil WHERE email=:email");
			$this->connectPseudo = $this->db->prepare("SELECT pseudo, email, idRole, mdp, photo FROM profil WHERE pseudo=:pseudo");
			$this->selectById = $this->db->prepare("SELECT P.id, P.pseudo, P.email, P.idRole, P.photo, R.libelle FROM profil P, role R WHERE P.idRole=R.id AND P.id=:id");
			$this->selectByPseudo = $this->db->prepare("SELECT id, pseudo, email, idRole, photo FROM profil WHERE pseudo=:pseudo");
			$this->show = $this->db->prepare("SELECT id, pseudo, email, idRole, photo FROM profil");
			$this->update = $this->db->prepare("UPDATE profil SET pseudo=:pseudo, idRole=:idRole, photo=:photo WHERE id=:id");
			$this->delete = $this->db->prepare("DELETE FROM profil WHERE id=:id");
			$this->selectLimit = $db->prepare("SELECT id, pseudo, email, mdp, idRole, photo FROM profil ORDER BY id LIMIT :inf,:limite");
			$this->selectCount = $db->prepare("SELECT COUNT(*) AS nb FROM profil");
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
			$unUtilisateur = $this->connect->execute(array(':pseudo'=>$pseudo));
			if ($this->connect->errorCode()!=0){
				print_r($this->connect->errorInfo());
			}
			return $this->connect->fetch();
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
	}
?>