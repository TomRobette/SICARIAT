<?php
	class Forum{
		private $db;
		private $select;
		private $insert;
		private $delete;

		public function __construct($db){
            $this->db=$db;
			$this->select = $this->db->prepare("SELECT id, libelle, description FROM forum");
			$this->insert = $this->db->prepare("INSERT INTO forum(libelle, description)values(:libelle, :description)");
			$this->delete = $this->db->prepare("DELETE FROM forum WHERE id=:id");
			
			
		}
        
        public function select(){
			$this->select->execute();
			if ($this->select->errorCode()!=0){
				print_r($this->select->errorInfo());
			}
			return $this->select->fetchAll();
		}

		public function insert($libelle,$description){
			$r = true;
			$this->insert->execute(array(':libelle'=>$libelle,':description'=>$description));
			
			if($this->insert->errorCode()!=0){
				print_r($this->insert->errorInfo());
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

	}
?>