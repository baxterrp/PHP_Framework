<?php
	
    // The Note Object 
    class Note{
        
        // **************** All Note Object Properties ****************         
        // The Note Identifier
        private $id;
        
        // The Job Identifier
        private $jobId;
        
        // The date of the Note
        private $noteDate;
        
        // The name of the Note
        private $noteName;
        
        // Details of Note
        private $note;
        
        // **************** All Note Object Getters **************** 
        // Get Note Id
        public function getId(){
            return $this->id;
        }
        
        // Get Job Identifier
        public function getJobId(){
            return $this->jobId;
        }
        
        // Get Note Date
        public function getNoteDate(){
            return $this->noteDate;
        }
        
        // Get Note Name
        public function getNoteName(){
            return $this->noteName;
        }
        
        // Get Note
        public function getNote(){
            return $this->note;
        }
        
        // **************** The Note Object Mapper **************** 
        public function map($row){
			$this->id = $row['id'];
			$this->jobId = $row['job_id'];
			$this->noteDate = $row['note_date'];
			$this->noteName = $row['note_name'];
			$this->note = $row['note'];
        }
        
        // **************** The Note Constructor **************** 
        function __construct($data){
			
            // If parameters are passed, construct object, else create empty object
            if($data){
                
                // Decoded Json Object
                $objJson = json_decode($data, true);
				
				if(isset($objJson['id'])){
					$this->id = $objJson['id'];
				}

                // Set all values of object from Json
				$this->jobId = $objJson["job_id"];
                $this->noteDate = $objJson["note_date"];
                $this->noteName = $objJson["note_name"];
                $this->note = $objJson["note"];
            }
        }
    }	    
?>