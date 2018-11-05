<?php
    require_once('/var/www/html/Domain/Services/CrudOperations.php');

    // All CRUD functions relating to User object
    class UserRepository{
        
        // Function to add new User
        function AddUser($User){
            $statement = new InsertStatement("user");
            $statement->addParameter("email", $User->getEmail());
            $statement->addParameter("password", $User->getPassword());
            $statement->executeStatement();
        }
		
		function SelectUserByUserNameAndPassword($User){
			$statement = new SelectStatement("user");
            $statement->where("email", $User->getEmail());
            $statement->where("password", $User->getPassword());
			
			return $statement->executeStatement(); 
		}
        
        // Function get user by Identifier
        function SelectUserById($User){
            $statement = new SelectStatement("user");
            $statement->where("id", $User->getId());
            $User->mapUser($statement->executeStatement()); 
            
            return $User->getEmail();
        }
    }
?>