<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_Controller
 *
 * @author new user
 */
class Home_Controller extends Main_Controller
    {

    public
            function main()
        {
        //Get all projects assigned to user in session available
        $this->registry->projects = Project_Model::getAllUserProj($_SESSION['user']->userId());

        //Show the home screen
        $this->registry->View_Template->show('home');
        }

    public function delete()
        {
        //Run the delete function and return a boolean
        $this->registry->success = Project_Model::deleteProject($_GET['proj_id']);

        if ($this->registry->success)
            {
            $this->registry->heading = "Success";
            $this->registry->message = "User successfully deleted";
            } else
            {
            $this->registry->error = true;
            $this->registry->heading = "Error Deleting..";
            $this->registry->message = "We don't know what happened here.";
            }
        $this->registry->View_Template->show('showMessage');
        }

    }

?>