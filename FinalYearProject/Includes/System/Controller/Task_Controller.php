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

     //   $this->registry->estimations = Estimation_Model::getAllEstimates($_GET['id']);
   
            
     //   $this->registry->staffMembers = Staff_Model::getStaffForProject($_GET['id']);

        /*
         * Test Statements
         */
        /*
          echo "<br/>***VAR_TEST****<br/>"
          . "id: " . var_dump($id)
          . "<br/>key: " . var_dump($key)
          . "<br/>projTasks: " . var_dump($projTasks) .
          "<br/>statusDescription: " . var_dump($statusDescription)
          . "<br/>taskStatus: " . var_dump($taskStatus)
          . "<br/>registry taskStatus: " . var_dump($this->registry->taskStatus);
         * */

        //Show the projectTasks view
        $this->registry->View_Template->show('projectTasks');
        }

    }
