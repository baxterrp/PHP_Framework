<?php
    require_once('/var/www/html/Domain/Services/DataBaseConn.php');

	// Base class for CRUD operations
	class CrudOperations extends DatabaseConn {
        
        // If statement is query
        protected $isQuery = false;
					
		// Name of table
		protected $tableName;
		
		// Statement Handler
        protected $sth;
        
		// The SQL String
		protected $sql;
        
        // The Connection
        protected $conn;
	
		// Affected columns of statement
		protected $columns = array();
	
		// Values to be inserted or updated
		protected $values = array();
				
		// $column containing keys for WHERE
		protected $keyColumns = array();

		// Values of key for WHERE
		protected $keyValues = array();
				
		// Constructor
		// Takes table name as parameter
		public function __construct($table){
			$this->tableName = $table;
		}		
				        
		// Use PDO to bind parameters for execution
        protected function bindParams(){
			$this->sth = $this->conn->prepare($this->sql);
            
            if(count($this->columns > 0)){
                $length = count($this->columns);
                for($i = 0; $i < $length; $i++){
					// echo $this->values[$i];
                    if(is_string($this->values[$i])){
                        $this->sth->bindParam(":".$this->columns[$i], $this->values[$i], PDO::PARAM_STR);
                    }else if(is_int($this->values[$i])){
                        $this->sth->bindParam(":".$this->columns[$i], $this->values[$i], PDO::PARAM_INT);                
                    }else if(is_bool($this->values[$i])){
                        $this->sth->bindParam(":".$this->columns[$i], $this->values[$i], PDO::PARAM_BOOL);
                    }
                }
            }
            if(count($this->keyColumns > 0)){
            $length = count($this->keyColumns);
                for($i = 0; $i < $length; $i++){
					// echo $this->keyValues[$i];
                    if(is_string($this->keyValues[$i])){
                        $this->sth->bindParam(":".$this->keyColumns[$i], $this->keyValues[$i], PDO::PARAM_STR);
                    }else if(is_int($this->keyValues[$i])){
                        $this->sth->bindParam(":".$this->keyColumns[$i], $this->keyValues[$i], PDO::PARAM_INT);                
                    }else if(is_bool($this->keyValues[$i])){
                        $this->sth->bindParam(":".$this->keyColumns[$i], $this->keyValues[$i], PDO::PARAM_BOOL);
                    }
                }
            }
        }		
				
		// Add parameter method
		// Takes column name and value
		public function addParameter($column, $value){
			$this->columns[] = $column;
			$this->values[] = $value;
		}
        
		// Where method
		// Takes primary key of data base entry
		public function where($column, $value){
			$this->keyColumns[] = $column;
			$this->keyValues[] = $value;
		}
        
		// Executes statement
		public function executeStatement(){
            $connection = new DataBaseConn();
            $this->conn = $connection->dbOpen();
			$this->buildStatement();
            $this->bindParams();
            $this->sth->execute();
			$this->conn = null;
            if($this->isQuery){
                return $this->sth->fetchAll(PDO::FETCH_ASSOC);
            }
		}
	}
	
	// For using custom statements
	// Using table joins
	class CustomStatement extends CrudOperations{
		
		// add custom sql
		public function addSql($customSql){
			$this->sql = $customSql;
		}
		
		// needs work - doesn't account for multiple WHILE params while allowing using alias' in sql
		protected function buildStatement(){
			// This is a query
			$this->isQuery = true;
			
			// Set id
			$this->sql .= $this->keyColumns[0];
		}
	}
	
	// Update statement class : uses crudOperations
	class UpdateStatement extends CrudOperations{
		
		// build statement method
		// creates SQL statement to be executed
		protected function buildStatement(){

            // Length of column and value arrays
            $length = count($this->columns);
            
            // Construct UPDATE statement
            $this->sql = "UPDATE " . $this->tableName;
			$this->sql .= " SET " . $this->columns[0] . " = :" . $this->columns[0];
            
			if($length > 1){
                for($x = 1; $x < $length; $x++){
                    $this->sql .= ", " . $this->columns[$x] . " = :" . $this->columns[$x];
                }
            }
			if($this->keyColumns[0] != null){
				$this->sql .= " WHERE " . $this->keyColumns[0] . " = :" . $this->keyColumns[0];
			}
			$length = count($this->keyColumns);
            if($length > 1){
                for($x = 1; $x < $length; $x++){
                    $this->sql .= " AND " . $this->keyColumns[$x] . " = :" . $this->keyColumns[$x];
                }
            }
		}		
	}
	
	// INSERT statement class : uses crudOperations	
	class InsertStatement extends CrudOperations{
	
		// Build statement method
		// Creates sql statement to be executed
		protected function buildStatement(){
			
			// Length of column and value array
			$length = count($this->columns);

			// Construct INSERT statement
            $this->sql = "INSERT INTO " . $this->tableName . " (" . $this->columns[0];
            for($x = 1; $x < $length; $x++){
				$this->sql .= ", " . $this->columns[$x];
			}
			
            $this->sql .= ") VALUES (";
			for($x = 0; $x < $length; $x++){
				if($x == 0){
                    $this->sql .= ":" . $this->columns[$x];
				}else{
					$this->sql .= ", :" . $this->columns[$x]; 
                }
			}
			
            $this->sql .= ");";
		}
    }
	
	// Delete statement class : uses crudOperations
	class DeleteStatement extends CrudOperations{
		
		// not implemented - multiple WHERE 
		protected function buildStatement(){
			$this->sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->keyColumns[0] . " = :" . $this->keyColumns[0];
		}
	}

	// SELECT statement class : uses crudOperations
	class SelectStatement extends CrudOperations{
		
		// build statement method
		// creates SQL statement to be executed
		protected function buildStatement(){
            
            // This is a Query
            $this->isQuery = true;
            
            // Length of column and value arrays
            $length = count($this->keyColumns);
            
            // Construct SELECT statement
            $this->sql = "SELECT * FROM " . $this->tableName;
			if(count($this->keyColumns) > 0){
				$this->sql .= " WHERE " . $this->keyColumns[0] . " = :" . $this->keyColumns[0];
			}
            if($length > 1){
                for($x = 1; $x < $length; $x++){
                    $this->sql .= " AND " . $this->keyColumns[$x] . " = :" . $this->keyColumns[$x];
                }
            }
		}
	}
	
	// executing full sql script with no bindings
	class NonDynamicForDateRange extends CrudOperations{
		
		// add custom sql
		public function addSql($customSql){
			$this->sql = $customSql;
		}
		
		public function Run(){
			$connection = new DataBaseConn();
            $this->conn = $connection->dbOpen();
			$this->sth = $this->conn->prepare($this->sql);
            $this->sth->execute();
            return $this->sth->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>
