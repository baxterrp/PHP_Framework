<?php
	
    // The Asset Object 
    class Asset{
        
        // **************** All Asset Object Properties ****************  	
        // The Asset Identifier
        private $id;
        
        // The related item Identifier
        private $itemId;
        
        // The Name of the Job
        private $name;
        
        // File Name related to Asset
        private $fileName;

        // **************** All Asset Object Getters ****************
        // Get Asset Id
        public function getId(){
            return $this->id;
        }
        
        // Get Item Identifier
        public function getItemId(){
            return $this->itemId;
        }
        
        // Get Asset Name
        public function getName(){
            return $this->name;
        }
        
        // Get Asset File Name
        public function getFileName(){
            return $this->fileName;
        }
                
        // **************** The Asset Object Mapper **************** 
        public function map($row){
			$this->id = $row['id'];
			if(isset($row['account_id'])){
				$this->itemId = $row['account_id'];
			}			
			if(isset($row['job_id'])){
				$this->itemId = $row['job_id'];
			}
			$this->name = $row['name'];
			$this->fileName = $row['file'];
        }
        
        // **************** The Asset Constructor **************** 
        function __construct($data){
			
            // If parameters are passed, construct object, else create empty object
            if($data){

                // Decoded Json Object
                $objJson = json_decode($data, true);

                // Set all values of object from Json
                $this->name = $objJson["name"];
                $this->itemId = $objJson["item_id"];
                $this->fileName = $objJson["file_name"];
            }
        }
    }	
?>