<?php

class task {

        protected $id;
        protected $title;
        protected $description;
        protected $status;
        protected $duedate;
		private $tablename='notes';
        private $dbconn ;

		
      

        function setId($id) { $this->id = $id; }
        function getId() { return $this->id; }
        function setTitle($title) { $this->title = $title; }
        function getTitle() { return $this->title; }
        function setDescription($description) { $this->description = $description; }
        function getDescription() { return $this->description; }
        function setStatus($status) { $this->status = $status; }
        function getStatus() { return $this->status; }
        function setDueDate($duedate) { $this->duedate = $duedate; }
		function getDueDate() { return $this->duedate; }
		
	
			function __construct(){
            require_once('dbConnect.php');
            $db=new DbConnect();
            $this->dbconn = $db->connect();

        }
		
		
        
        public function Insert($t_id,$t_title,$t_description,$t_status,$t_duedate){

            $sql = "INSERT INTO $this->tablename VALUES (:id,:title,:description,:status,:duedate)";
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->bindParam(':id',$t_id);
            $stmnt->bindParam(':title',$t_title);
            $stmnt->bindParam(':description',$t_description);
            $stmnt->bindParam(':status',$t_status);
            $stmnt->bindParam(':duedate',$t_duedate);
    

            if($stmnt->execute()){
                return true;
            }else{
                return false;
            }
        }

        

        public function UpdateTask($t_id,$t_title,$t_description,$t_status,$t_duedate){

            $sql = 'UPDATE '.$this->tablename.' SET title=:title , ndesc=:description , status=:status , due=:duedate WHERE id=:id';
            $stmnt=$this->dbconn->prepare($sql);
			$stmnt->bindParam(':id',$t_id);
            $stmnt->bindParam(':title',$t_title);
            $stmnt->bindParam(':description',$t_description);
            $stmnt->bindParam(':status',$t_status);
            $stmnt->bindParam(':duedate',$t_duedate);
			
            if($stmnt->execute()){
                return true;
                
            }else{
                return false;
            }
        }
		
		
		 public function GetAllTasksData(){
            
			$sql = 'SELECT * FROM '.$this->tablename.' ';
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->execute();
            $result =$stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			

        }
		
		
		 public function GetIncompletedTasksData(){
            
			$sql = 'SELECT * FROM '.$this->tablename.' WHERE status=0';
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->execute();
            $result =$stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			

        }

        
        public function GetInCompletedTasksPaginatedData($start_from,$pagination_pages){
            
            $sql = "SELECT * FROM  `notes` WHERE STATUS='0' limit $start_from , $pagination_pages";
			//$sql = 'SELECT * FROM '.$this->tablename.' WHERE status=1';
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->execute();
            $result =$stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			

        }
		
		
		
		 public function GetCompletedTasksData(){
            
			$sql = 'SELECT * FROM '.$this->tablename.' WHERE status=1';
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->execute();
            $result =$stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			

        }

        public function GetCompletedTasksPaginatedData($start_from,$pagination_pages){
            
            $sql = "SELECT * FROM  `notes` WHERE STATUS='1' limit $start_from , $pagination_pages";
			//$sql = 'SELECT * FROM '.$this->tablename.' WHERE status=1';
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->execute();
            $result =$stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			

        }
		
		
		
		public function SetInCompleted($t_id){

            $sql = 'UPDATE '.$this->tablename.' SET status=0  WHERE id=:id';
            $stmnt=$this->dbconn->prepare($sql);
			$stmnt->bindParam(':id',$t_id);
		
            if($stmnt->execute()){
                return true;
                
            }else{
                return false;
            }
        }
		
		public function SetCompleted($t_id){

            $sql = 'UPDATE '.$this->tablename.' SET status=1  WHERE id=:id';
            $stmnt=$this->dbconn->prepare($sql);
			$stmnt->bindParam(':id',$t_id);
		
            if($stmnt->execute()){
                return true;
                
            }else{
                return false;
            }
        }
		

        public function GetTasksById($t_id){
            
			$sql = 'SELECT * FROM '.$this->tablename.' WHERE id=:id';
            $stmnt=$this->dbconn->prepare($sql);
            $stmnt->bindParam(':id',$t_id);
            $stmnt->execute();
            $result =$stmnt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
			

        }
       
}



?>