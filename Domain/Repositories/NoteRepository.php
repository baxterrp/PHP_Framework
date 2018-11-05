<?php
    require_once('/var/www/html/Domain/Services/CrudOperations.php');

    // All CRUD functions relating to Note object
    class NoteRepository{
        
        // Function to add new Note
        function AddNote($note){
            $statement = new InsertStatement("job_note");
            $statement->addParameter("job_id", $note->getJobId());
            $statement->addParameter("note_date", $note->getNoteDate());
            $statement->addParameter("note_name", $note->getNoteName());
            $statement->addParameter("note", $note->getNote());
            $statement->executeStatement();
        }
		
		function SelectNotesByJobId($jobId){
			$statement = new SelectStatement("job_note");
			$statement->where("job_id", $jobId);
			return $statement->executeStatement();
		}
        
        // Function to update a Note
        function UpdateNote($note){
            $statement = new UpdateStatement("job_note");
            $statement->addParameter("note_date", $note->getNoteDate());
            $statement->addParameter("note_name", $note->getNoteName());
            $statement->addParameter("note", $note->getNote());
            $statement->where("id", $note->getId());
            $statement->where("job_id", $note->getJobId());
            $statement->executeStatement();
        }
        
        // Function to delete a Note
        function DeleteNote($note){
            $statement = new DeleteStatement("job_note");
			$statement->where("id", $note->getId());
            $statement->executeStatement();
        }
    }
?>