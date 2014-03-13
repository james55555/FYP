<?php
/*
 * Controller class to run the command to show the error page.
 */
class Error_Controller extends Main_Controller
    {
        public function main()  {
            //run the show function in View_Template for page 404.php
            $this->registry->title = "Error 404";
            $this->registry->message = "There has been a redirecting issue...";
            $this->registry->View_Template->show('showMessage');
            }
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

