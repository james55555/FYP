<?php
/*
 * Controller class to run the command to show the error page.
 */
class Error_Controller extends Main_Controller
    {
        public function main()  { 
            //run the show function in View_Template for page 404.php
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = "Error 404";
            $this->registry->View_Template->message = "There has been a redirect issue.";
            $this->registry->View_Template->show('showMessage');
            }
    }

?>

