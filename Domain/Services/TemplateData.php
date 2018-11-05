<?php
    
    class TemplateData{

        public static function docType(){
            return '<!DOCTYPE html><html lang="en"><head>';
        }

        public static function metaData(){
            return '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
            <meta name="Author" content="Robert Baxter" >';
        }

        public static function title($title){
            return "<title>$title</title>";
        }

        public static function css(){
            return '<!-- CUSTOM CSS --><link rel="stylesheet" href="../Public/CSS/Custom/main.css">';
        }
        
        public static function header($heading){
            return '<header><div class="row header-div"><div class="col-sm-2"></div><h1 class="col-sm-8">' . $heading . '</h1><div class="col-sm-2"></div></div></header>';
        }

        public static function navBar(){
            return '<nav class="nav-div">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <ul class="col-sm-8">
                                    <li class="nav-list-item text-primary"><a href="home.php">Home</a></li>
                                    <li class="dropdown nav-list-item text-primary">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                          <li class="sub-nav text-primary"><a href="account_add.php">Add Account</a></li>
                                          <li class="sub-nav text-primary"><a href="account_update.php">Update Account</a></li>
                                          <li class="sub-nav text-primary"><a href="account_assets_add.php">Add Assets To Account</a></li>
                                          <li class="sub-nav text-primary"><a href="account_assets_delete.php">View/Delete Account Assets</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown nav-list-item text-primary">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contacts <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                          <li class="sub-nav text-primary"><a href="contacts_add.php">Add Contact</a></li>
                                          <li class="sub-nav text-primary"><a href="contacts_update.php">Update Contact</a></li>
                                          <li class="sub-nav text-primary"><a href="contacts_manage.php">Manage Contact</a></li>
                                          <li class="sub-nav text-primary"><a href="contacts_delete.php">Delete Contacts</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown nav-list-item text-primary">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jobs <span class="caret"></span></a>
                                      <ul class="dropdown-menu">
                                          <li class="sub-nav text-primary"><a href="jobs_add.php">Add Job</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_view_contacts.php">View Job Contacts</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_notes_add.php">Add Job Notes</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_change_delete_notes.php">View/Update/Delete Job Notes</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_assets_add.php">Add Asset to Job</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_view_delete_assets.php">View/Delete Job Assets</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_hours_add.php">Add Job Hours</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_update_delete_hours.php">Update/Delete Job Hours</a></li>
                                          <li class="sub-nav text-primary"><a href="jobs_print_invoice.php">Print Invoice</a></li>
                                      </ul>
                                    </li>
                                    <li class="nav-list-item text-primary" id="logout"><a href="logout.php">Logout</a></li>
                                </ul>
                                <div class="col-sm-2"></div> 
                            </div>
                        </nav>';
        }

        public static function bootstrap(){
            return '<!-- BOOTSTRAP CSS -->
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                <!-- JQUERY JAVASCRIPT -->
                <script src="../Public/Javascript/JQuery/jquery-3.2.1.min.js"></script>

                <!-- BOOTSTRAP JAVASCRIPT -->        
                <script src="../Public/Javascript/Bootstrap/bootstrap.min.js"></script>
				
				<!-- Utility JAVASCRIPT -->        
                <script src="../Public/Javascript/Actions/UtilityFunctions.js"></script>
                <script src="../Public/Javascript/Actions/Validator.js"></script>';
        }

    }
?>