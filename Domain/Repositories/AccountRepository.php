<?php

    require_once('/var/www/html/Domain/Services/CrudOperations.php');
    require_once('/var/www/html/Domain/Classes/Account.php');

    // All CRUD functions relating to Account object
    class AccountRepository{
                
        // Function to add new Account
        function AddAccount($account){
            $statement = new InsertStatement("account");
            $statement->addParameter("user_id", $account->getUserId());
            $statement->addParameter("name", $account->getName());
            $statement->addParameter("address", $account->getAddress());
            $statement->addParameter("state", $account->getState());
            $statement->addParameter("city", $account->getCity());
            $statement->addParameter("zip", $account->getZip());
            $statement->addParameter("folder", $account->getFolder());
            $statement->executeStatement();
        }
		
		// Function to update account
		function UpdateAccount($account){
			$statement = new UpdateStatement("account");
            $statement->addParameter("name", $account->getName());
            $statement->addParameter("address", $account->getAddress());
            $statement->addParameter("state", $account->getState());
            $statement->addParameter("city", $account->getCity());
            $statement->addParameter("zip", $account->getZip());
			$statement->addParameter("folder", $account->getFolder());
			$statement->where("id", $account->getId());
			$statement->executeStatement();
		}
        
        // Returns one account by identifier
        function SelectAccountById($AccountId){
            $statement = new SelectStatement("account");
            $statement->where("id", $AccountId);

            return $statement->executeStatement();
        }
        
        // Returns all Accounts by User Identifier
        function SelectAccountsByUserId($UserId){
            $statement = new SelectStatement("account");
            $statement->where("user_id", $UserId);
            
            return $statement->executeStatement();
        }
                                         
    }
?>