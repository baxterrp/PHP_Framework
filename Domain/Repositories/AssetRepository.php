<?php
    require_once('/var/www/html/Domain/Services/CrudOperations.php');

    // All CRUD functions relating to Asset object
    class AssetRepository{
        
        // Function to add new Job Asset
        function AddJobAsset($Asset){
            $statement = new InsertStatement("job_asset");
            $statement->addParameter("job_id", $Asset->getItemId());
            $statement->addParameter("name", $Asset->getName());
            $statement->addParameter("file", $Asset->getFileName());
            $statement->executeStatement();
        }
        
        // Function to add new Account Asset
        function AddAccountAsset($Asset){
            $statement = new InsertStatement("account_asset");
            $statement->addParameter("account_id", $Asset->getItemId());
            $statement->addParameter("name", $Asset->getName());
            $statement->addParameter("file", $Asset->getFileName());
            $statement->executeStatement();
        }
		
		// Function to select all assets by account id
		function SelectAssetsByAccount($AccountId){
			$statement = new SelectStatement("account_asset");
			$statement->where("account_id", $AccountId);
			
			return $statement->executeStatement();
		}
		
		// Select Asset by Asset Id
		function SelectAssetById($assetId){
			$statement = new SelectStatement("account_asset");
			$statement->where("id", $assetId);
			return $statement->executeStatement();
		}		
		
		// Select Job Asset by Asset Id
		function SelectJobAssetById($assetId){
			$statement = new SelectStatement("job_asset");
			$statement->where("id", $assetId);
			return $statement->executeStatement();
		}
		
		// Select Assets By Job ID
		function SelectAssetsByJob($jobId){
			$statement = new SelectStatement("job_asset");
			$statement->where("job_id", $jobId);
			return $statement->executeStatement();
		}
		
		// Delete Account Assets
		function DeleteAsset($assetId){
			$statement = new DeleteStatement("account_asset");
			$statement->where("id", $assetId);
			$statement->executeStatement();		
		}
		
		// Delete Job Assets
		function DeleteJobAsset($assetId){
			$statement = new DeleteStatement("job_asset");
			$statement->where("id", $assetId);
			$statement->executeStatement();
		}
    }
?>