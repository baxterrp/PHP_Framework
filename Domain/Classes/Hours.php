<?php
	
    // The Hours Object 
    class Hours {
        
        // **************** All Hours Object Properties ****************  
        // The Hours Identifier
        private $id;
        
        // The Job Identifier
        private $jobId;
            
        // The Job Date
        private $jobDate;
            
        // The Hours spent on Job
        private $jobHours;
        
        // The Job's hourly rate
        private $hourlyRate;
        
        // The Job's description
        private $jobDescription;
        
        // **************** All Hours Object Getters ****************
        // Get Hours Identifier
        public function getId(){
            return $this->id;
        }
        
        // Get Job Identifier
        public function getJobId(){
            return $this->jobId;
        }
        
        // Get Job Hours
        public function getJobHours(){
            return $this->jobHours;
        }
        
        // Get Job Hourly Rate
        public function getHourlyRate(){
            return $this->hourlyRate;
        }        
		
		// Get Job Date
        public function getJobDate(){
            return $this->jobDate;
        }
        
        // Get Job Description
        public function getJobDescription(){
            return $this->jobDescription;
        }
          
        // **************** The Hours Object Mapper **************** 
        public function map($row){
			$this->id = $row['id'];
			$this->jobId = $row['job_id'];
			$this->jobDate = $row['job_date'];
			$this->hourlyRate = $row['hourly_rate'];
			$this->jobHours = $row['job_hours'];
			$this->jobDescription = $row["description"];
        }
        
        // **************** The Hours Constructor **************** 
        function __construct($data){
			
            // If parameters are passed, construct object, else create empty object
            if($data){
                
                // Decoded Json Object
                $objJson = json_decode($data, true);
				
				if(isset($objJson['id'])){
					$this->id = $objJson['id'];
				}

                // Set all values of object from Json
                $this->jobId = $objJson["job_id"];
                $this->jobDate = $objJson["job_date"];
                $this->jobHours = $objJson["job_hours"];
                $this->hourlyRate = $objJson["hourly_rate"];
                $this->jobDescription = $objJson["description"];
            }
        }
    }
?>