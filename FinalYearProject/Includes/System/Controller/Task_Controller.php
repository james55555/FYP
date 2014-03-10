<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of taskList_Controller
 *
 * @author James
 */
class Task_Controller extends Main_Controller
    {

    public
            function main()
        {

        $this->registry->project_tasks = Task_Model::getAllTasks($_GET['proj_id']);
        $project = Project_Model::getProject($_GET['proj_id']);
        $this->registry->projectEstimation = Estimation_Model::get($project->estimation());
        //Show the projectTasks view
        $this->registry->View_Template->show('projectTasks');
        }

    }
