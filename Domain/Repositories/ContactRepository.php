<?php
    require_once('/var/www/html/Domain/Services/CrudOperations.php');

    // All CRUD functions relating to Contact object
    class ContactRepository{
        
        // Function to add new Contact
        function AddContact($contact){
            $statement = new InsertStatement("contact");
            $statement->addParameter("name", $contact->getName());
            $statement->addParameter("work_phone", $contact->getWorkPhone());
            $statement->addParameter("mobile_phone", $contact->getMobilePhone());
            $statement->addParameter("email", $contact->getEmail());
            $statement->executeStatement();
        }
		
		// Select all contacts
		function SelectAllContacts(){
			$statement = new SelectStatement("contact");
			return $statement->executeStatement();
		}
		
		// Select contact by Identifier
		function SelectContactById($contactId){
			$statement = new SelectStatement("contact");
			$statement->where("id", $contactId);
			return $statement->executeStatement();
		}
		
        // Function to update a Contact
        function UpdateContact($contact){
            $statement = new UpdateStatement("contact");
            $statement->addParameter("name", $contact->getName());
            $statement->addParameter("work_phone", $contact->getWorkPhone());
            $statement->addParameter("mobile_phone", $contact->getMobilePhone());
            $statement->addParameter("email", $contact->getEmail());
            $statement->where("id", $contact->getId());
            $statement->executeStatement();
        }
		
		// Select all associations for Contact
		function SelectAccountJobContacts($contactId){
			$statement = new CustomStatement("contact");
			$statement->addSql('SELECT ajc.id, a.name as account, j.name as job
									FROM account_job_contact ajc
										INNER JOIN account a
											ON a.id = ajc.account_id
										INNER JOIN job j
											ON j.id = ajc.job_id
										INNER JOIN contact c
											ON c.id = ajc.contact_id
									WHERE c.id = :');
			$statement->where("id", $contactId);
			return $statement->executeStatement();
		}
        
        // Function to delete a Contact
        function DeleteContact($contactId){
            // First remove contact associates
            $statement = new DeleteStatement("account_job_contact");
            $statement->where("contact_id", $contactId);
            $statement->executeStatement();
            
            // Then remove contact from contacts table
            $statement = new DeleteStatement("contact");
            $statement->where("id", $contactId);
            $statement->executeStatement();
        }
        
        // Function to associate Contact with Job
        function ConnectContactToJob($contactId, $jobId, $accountId){
            $statement = new InsertStatement("account_job_contact");
            $statement->addParameter("account_id", $accountId);
            $statement->addParameter("job_id", $jobId);
            $statement->addParameter("contact_id", $contactId);
            $statement->executeStatement();
        }
		
		// Disassociate Contact From Job
		function DisconnectContactFromJob($ajcId){
			$statement = new DeleteStatement("account_job_contact");
			$statement->where("id", $ajcId);
			$statement->executeStatement();
		}
    }
?>