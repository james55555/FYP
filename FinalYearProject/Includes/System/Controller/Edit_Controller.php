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
        if (isset($_GET['isProject']) && $_GET['isProject'])
            {
            $this->registry->project = new Project_Model($_GET['proj_id']);
            $view = 'editProject';
            $est_id = $this->registry->project->estimation();
            } else
            {
            $this->registry->task = new Task_Model($_GET['task_id']);
            $this->registry->staff = new Staff_Model($this->registry->task->staff());
            $this->registry->dependencies = new Dependency_Model($this->registry->task->dpnd());
            $view = 'editTask';
            $est_id = $this->registry->task->estimation();
            }
        $this->registry->estimation = new Estimation_Model($est_id);
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
            $this->registry->message = "System error: " . $success;
            }
        $this->registry->View_Template->show('showMessage');
        }

    }
