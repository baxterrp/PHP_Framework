<?php

	// The Job Object 
    class Job {
        
        // **************** All Job Object Properties ****************  
        // The Job Identifier
        private $id;
        
		// The Name of the Job
		private $name;
		
		// Location of Job Documents
		private $folder;

        // The Account Identifier
        private $accountId;
        
        // **************** All Job Object Getters ****************
        // Get Job Identifier
        public function getId(){
            return $this->id;
        }
        
        // Get Name
        public function getName(){
            return $this->name;
        }
        
        // Get Folder
        public function getFolder(){
            return $this->folder;
        }
        
        // Get Accout Identifier
        public function getAccountId(){
            return $this->accountId;
        }
        
        // **************** The Job Object Mapper **************** 
        public function map($row){
			$this->id = $row['id'];
			$this->name = $row['name'];
			$this->accountId = $row['account_id'];
			$this->folder = $row['folder'];
        }
        
        // **************** The Job Constructor **************** 
        function __construct($data){
			
            // If parameters are passed, construct object, else create empty object
            if($data){
                
                // Decoded Json Object
                $objJson = json_decode($data, true);

                // Set all values of object from Json
				if(isset($objJson["id"])){
					$this->id = $objJson["id"];
				}
                $this->name = $objJson["name"];
                $this->accountId = $objJson["account_id"];
                $this->folder = $objJson["folder"];

            }
        }
    }	
?>