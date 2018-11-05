<?php
require_once('/var/www/html/Domain/Classes/Account.php');
require_once('/var/www/html/Domain/Classes/Note.php');
require_once('/var/www/html/Domain/Classes/Job.php');
require_once('/var/www/html/Domain/Classes/Hours.php');
require_once('/var/www/html/Domain/Classes/Contact.php');
require_once('/var/www/html/Domain/Classes/Asset.php');

class ObjectMapper{

	// recursive function to map each object
	// <objectType>Type of object being mapped</objectType>
	// <sqlResults>List of results from SQL query</sqlResults>
	// <counter>total of objects to be mapped</counter>
	// <objectArray>array containing mapped objects</objectArray>
	public static function MapMultipleObjects($objectType, $sqlResults, $counter, $objectArray){

		// Length of sql results
		$totalIterations = count($sqlResults) - 1;
		
		// Set type of new object
		switch($objectType){
			case "Account" :
				$object = new Account(null);
				break;
			case "Note" : 
				$object = new Note(null);
				break;
			case "Job" : 
				$object = new Job(null);
				break;
			case "Hours" : 
				$object = new Hours(null);
				break;
			case "Contact" : 
				$object = new Contact(null);
				break;
			case "Asset" : 
				$object = new Asset(null);
		}

		// map objects and add to array
		$object->map($sqlResults[$counter]);
		$objectArray[] = $object;     
		if($counter < $totalIterations){
			$counter++;
			return ObjectMapper::MapMultipleObjects($objectType, $sqlResults, $counter, $objectArray);
		}else{
			// all objects are mapped, return object array
			return $objectArray;
		}
	}
}