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
        //Get the paper selected
        $proj_id = ['proj_id'];

        //Delete a paper for given id
        $this->registry->success = Project_Model::deleteProject($proj_id);

    
        }

    }

?>