<?php
    require_once('/var/www/html/Domain/Services/CrudOperations.php');

    // All CRUD functions relating to Hours object
    class HoursRepository{
        
        // Function to add new Hours
        function AddHours($Hours){
            $statement = new InsertStatement("job_hour");
            $statement->addParameter("job_id", $Hours->getJobId());
            $statement->addParameter("job_date", $Hours->getJobDate());
            $statement->addParameter("job_hours", $Hours->getJobHours());
            $statement->addParameter("hourly_rate", $Hours->getHourlyRate());
            $statement->addParameter("description", $Hours->getJobDescription());
            $statement->executeStatement();
        }
		
		// Select Hours BY Job ID
		function SelectHoursByJobId($jobId){
			$statement = new SelectStatement("job_hour");
			$statement->where("job_id", $jobId);
			return $statement->executeStatement();
		}
		
		// Delete Hours
		function DeleteHours($hours){
			$statement = new DeleteStatement("job_hour");
			echo "horus id  " . $hours->getId();
			$statement->where("id", $hours->getId());
			$statement->executeStatement();
		}
		
		// Update Hours
		function UpdateHours($hours){
			$statement = new UpdateStatement("job_hour");
			$statement->addParameter("job_id", $hours->getJobId());
			$statement->addParameter("job_date", $hours->getJobDate());
			$statement->addParameter("hourly_rate", $hours->getHourlyRate());
			$statement->addParameter("job_hours", $hours->getJobHours());
			$statement->addParameter("description", $hours->getJobDescription());
			$statement->where("id", $hours->getId());
			$statement->executeStatement();
		}
    }
?>