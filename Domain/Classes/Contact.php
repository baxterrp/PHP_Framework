<?php
	
    // The Contact Object 
    class Contact{
        
        // **************** All Contact Object Properties ****************   
        // The Contact Identifier
        private $id;

		// The Name of the Contact
		private $name;
	       
        // The Contact's work phone number
        private $workPhone;
        
        // The Contact's mobile phone number
        private $mobilePhone;
        
        // The Contact's email address
        private $email;

        // **************** All Contact Object Getters **************** 
        // Get Contact Id
        public function getId(){
            return $this->id;
        }
        
        // Get Contact Name
        public function getName(){
            return $this->name;
        }
        
        // Get Contact Work Phone
        public function getWorkPhone(){
            return $this->workPhone;
        }
        
        // Get Contact Mobile Phone
        public function getMobilePhone(){
            return $this->mobilePhone;
        }
        
        // Get Contact Email Address
        public function getEmail(){
            return $this->email;
        }
                
        // **************** The Contact Object Mapper **************** 
        public function map($row){
            $this->id = $row['id'];
			$this->name = $row['name'];
			$this->workPhone = $row['work_phone'];
			$this->mobilePhone = $row['mobile_phone'];
			$this->email = $row['email'];
        }
		
		// Data Type Conversion string -> int
		public function ConvertId($idToConvert){
			$this->id = (int)$idToConvert;
		}
          
        // **************** The Contact Constructor **************** 
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
                $this->workPhone = $objJson["work_phone"];
                $this->mobilePhone = $objJson["mobile_phone"];
                $this->email = $objJson["email"];
            }
        }
    }	
?>