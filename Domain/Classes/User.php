<?php

	// The User Object 
    class User{
        
        // **************** All User Object Properties **************** 
        // The User Identifier
        private $id;
        
        // The User's email
        private $email;
        
        // The User's password
        private $password;
        
        // **************** All User Object Getters **************** 
        // Get User Id
        public function getId(){
            return $this->id;
        }
        
        // Get User Password
        public function getPassword(){
            return $this->password;
        }
        
        // Get User Email
        public function getEmail(){
            return $this->email;
        }
        
        // **************** The User Object Mapper **************** 
        public function map($row){
			$this->id = $row['id'];
			$this->email = $row['email'];
			$this->password = $row['password'];
        }
        
        // **************** The User Constructor **************** 
        public function __construct($data){
            
            // If parameters are passed, construct object, else create empty object
            if($data){
                // Decoded Json Object
                $objJson = json_decode($data, true);

                // Set all values of object from Json
                if(isset($objJson["id"])){
                    $this->id = $objJson["id"];
                }
                if(isset($objJson["email"])){
                    $this->email = $objJson["email"];
                }
                if(isset($objJson["password"])){
                    $this->password = $objJson["password"];
                }
            }
        }
    }	
?>