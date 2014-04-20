<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: Edit_Controller
#@author: James

class Edit_Controller extends Main_Controller
    {

    private $isProject = false;

    public function main()
        {
        //if is task or is project
        if (isset($_GET['isProject']) && $_GET['isProject'] === "true")
            {
            $this->registry->project = new Project_Model($_GET['proj_id']);
            $view = 'editProject';
            $est_id = $this->registry->project->estimation();
            }//Else if vars are set to TASK
        else
            {
            $this->registry->task = new Task_Model($_GET['task_id']);
            $staff_id = $this->registry->task->staff();
            if (isset($staff_id))
                {
                $this->registry->staff = new Staff_Model($staff_id);
                }
            //Only create new dependency object if dependencies have been set up
            $dpnd_id = $this->registry->task->dpnd();
            if (isset($dpnd_id))
                {
                $this->registry->dependencies = new Dependency_Model($dpnd_id);
                }
            $view = 'editTask';

            $est_id = $this->registry->task->estimation();
            }
        if (isset($est_id))
            {
            $this->registry->estimation = new Estimation_Model($est_id);
            }
        $this->registry->View_Template->show($view);
        }

    /*
     * Function to parse posted project variables and run showView() function with parameters
     * 
     * @return (function)   Run function with obtained variables 
     */

    public function editProject()
        {
        $this->isProject = true;
        //boolean to return true on success, false otherwise
        $updated = Project_Model::editProject($_POST);
        return $this->showView($updated);
        }

    /*
     * Function to parse posted variables and run showView() function with parameters
     * 
     * @return (function)   Run function with obtained variables 
     */

    public function editTask()
        {
        $this->isProject = false;
        $this->registry->proj_id = $_POST['proj_id'];
        //Assign posted fields to an array
        $updated = Task_Model::editTask($_POST);
        return $this->showView($updated);
        }

    /*
     * Function to generate variables for use in showMessage function and 
     * display message based on $success.
     * @param (boolean) $success    This is the variable used to define 
     *                              whether editObject() was successful
     */

    private function showView($success)
        {
        try
            {
            $link = "<a href=\"?page=Home\"> home </a>";
            if ($this->isProject)
                {
                $model = "Project";
                } else
                {
                $model = "Task";
                $link = " to "
                        . "<a href=\"?page=Task&proj_id={$this->registry->proj_id}\">"
                        . "task list</a>";
                }

            if (is_bool($success) && $success)
                {
                $this->registry->error = false;
                $this->registry->heading = $model . " updated!";
                $this->registry->message = "Return " . $link;
                } else
                {
                throw new Exception("Error Updating " . $model);
                }
            } catch (Exception $e)
            {
            $this->registry->error = true;
            $this->registry->heading = $e->getMessage();
            $this->registry->message = $success;
            }
        $this->registry->View_Template->show('showMessage');
        }

    }
