<?php
    require_once('/var/www/html/Domain/Services/CrudOperations.php');

    // All CRUD functions relating to Job object
    class JobRepository{
        
        // Function to add new Job
        function AddJob($Job){
            $statement = new InsertStatement("job");
            $statement->addParameter("account_id", $Job->getAccountId());
            $statement->addParameter("name", $Job->getName());
            $statement->addParameter("folder", $Job->getFolder());
            $statement->executeStatement();
        }
		
		// Get all jobs by account id
		function SelectJobsByAccountId($accountId){
			$statement = new SelectStatement("job");
			$statement->where("account_id", $accountId);
			return $statement->executeStatement();
		}
		
		// Get Jobs By ID
		function SelectJobById($jobId){
			$statement = new SelectStatement("job");
			$statement->where("id", $jobId);
			return $statement->executeStatement();
		}
		
		// Get all account-job-contact relationships
		function SelectAllContactsForJob($jobId){
			
			// for default constructor - doesn't use table name - include table name in custom sql
			$statement = new CustomStatement("account_job_contact");
			$statement->addSql("SELECT c.id, c.name, c.email, c.work_phone, c.mobile_phone 
									FROM account_job_contact ajc
										INNER JOIN contact c
											ON c.id = ajc.contact_id
										INNER JOIN job j
											ON j.id	= ajc.job_id
									WHERE j.id = :");
			$statement->where("id", $jobId);
			return $statement->executeStatement();
		}
		
		function GetInvoiceData($data){
			$jobId = $data["jobId"];
			$dateOne = $data["dateOne"];
			$dateOne = date('Y-m-d', strtotime($dateOne));
			$dateTwo = $data["dateTwo"];
			$dateTwo = date('Y-m-d', strtotime($dateTwo));
			$statement = new NonDynamicForDateRange(null);
			$statement->addSql("SELECT a.name as account, a.address, a.city, a.state, a.zip, j.name as job, c.work_phone, 
									c.email, h.description, h.job_date, h.hourly_rate, h.job_hours, (h.hourly_rate * h.job_hours) as total FROM account a
										LEFT JOIN job j
											ON j.account_id = a.id
										LEFT JOIN account_job_contact ajc 
											ON ajc.account_id = a.id
												AND ajc.job_id = j.id
										LEFT JOIN contact c
											ON ajc.contact_id = c.id
										LEFT JOIN job_hour h
											ON h.job_id = j.id
								WHERE h.job_date BETWEEN '" . $dateOne . "' AND '" . $dateTwo . "'
									AND j.id = " . $jobId);
			return $statement->run();
		}
    }
?>