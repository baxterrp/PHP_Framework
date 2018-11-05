<?php

    // The Account Object 
    class Account{
        
        // **************** All Account Object Properties ****************        
        //The Account Identifier
        private $id;
        
        // The User Id
        private $userId;
        
		// The Name of the Account
		private $name;
		
		// Account Street Number and Street Name
		private $address;
		
		// Account State
		private $state;
		
		// Account City
		private $city;

		// Account Zip
		private $zip;
		
		// Location of Account Documents
		private $folder;
         
        // **************** All Account Object Getters **************** 
        // Get Account Id
        public function getId(){
            return $this->id;
        }
        
        // Get User Identifier
        public function getUserId(){
            return $this->userId;
        }
        
        // Get Account Name
        public function getName(){
            return $this->name;
        }
        
        // Get Account Address
        public function getAddress(){
            return $this->address;
        }
        
        // Get Account State
        public function getState(){
            return $this->state;
        }
        
        // Get Account City
        public function getCity(){
            return $this->city;
        }
        
        // Get Account Zipcode
        public function getZip(){
            return $this->zip;
        }
        
        // Get Account Folder
        public function getFolder(){
            return $this->folder;
        }
		
		// Data Type Conversion string -> int
		public function ConvertId($idToConvert, $userIdToConvert){
			$this->id = (int)$idToConvert;
			$this->userId = (int)$userIdToConvert;
		}

        // **************** The Account Object Mapper **************** 
        public function map($row){
                $this->id = $row['id'];
                $this->userId = $row['user_id'];
                $this->name = $row['name'];
                $this->address = $row['address'];
                $this->state = $row['state'];
                $this->city = $row['city'];
                $this->zip = $row['zip'];
                $this->folder = $row['folder'];
        }
        
        // **************** The Account Constructor **************** 
        function __construct($data){
			
            // If parameters are passed, construct object, else create empty object
            if($data){
               
                // Decoded Json Object
                $objJson = json_decode($data, true);

                // Set all values of object from Json
				if(isset($objJson["id"])){
					$this->id = $objJson["id"];
				}
                $this->userId = $objJson["user_id"];
                $this->name = $objJson["name"];
                $this->address = $objJson["address"];
                $this->state = $objJson["state"];
                $this->city = $objJson["city"];
                $this->zip = $objJson["zip"];
                $this->folder = $objJson["folder"];
            }
        }
    }	
?>	
