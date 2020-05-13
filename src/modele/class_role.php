<?php
	class Role{
		private $db;
		private $select;

		public function __construct($db){
            $this->db=$db;
            $this->select = $this->db->prepare("SELECT id, libelle FROM role");
		}
        
        public function select(){
			$this->select->execute();
			if ($this->select->errorCode()!=0){
				print_r($this->select->errorInfo());
			}
			return $this->select->fetchAll();
		}

	}
?>