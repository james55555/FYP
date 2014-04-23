<?php
/*
 * Controller class to run the command to show the error page.
 */
class Error_Controller extends Main_Controller
    {
        public function main()  { 
            //run the show function in View_Template for page 404.php
            $this->registry->error = true;
            $this->registry->heading = "Error 404";
            $this->registry->message = "There has been a redirect issue.";
            $this->registry->View_Template->show('showMessage');
            }
    }

?>

