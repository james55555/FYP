<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: Edit_Controller
#@author: James

class Edit_Controller extends Main_Controller
    {

    private $is_project = false;
    private $project;
    private $task;

    public function main()
        {
//if is task or is project
        if (isset($_GET['is_project']) && $_GET['is_project'] === "true")
            {
            $this->project = new Project_Model($_GET['proj_id']);
            $view = 'editproject';
            $est_id = $this->project->estimation();
            $this->registry->View_Template->project = $this->project;
            }//Else if vars are set to TASK
        else
            {
            $this->task = new Task_Model($_GET['task_id']);
//$this->registry->View_Template->projTasks = Task_Model::getAllTasks($proj_id);
            $project = new Project_Model($this->task->proj_id());
            $this->registry->View_Template->projEst = new Estimation_Model($project->estimation());
//Set staff object
            $staff_id = $this->task->staff();
            $this->registry->View_Template->staff = new Staff_Model($staff_id);
            //Set dependency array
            $this->registry->View_Template->dependencies = $this->processDependency();
            //Set estimation ID variable
            $est_id = $this->task->estimation();
            //Make task variabl available
            $this->registry->View_Template->task = $this->task;
            $view = 'edittask';
            }
            var_dump(new Estimation_Model($est_id));
            $est = new Estimation_Model($est_id);
            echo $est->start_dt();
            echo "<br/>";
            echo $est->start_dt_AM();
        $this->registry->View_Template->estimation = new Estimation_Model($est_id);
        $this->registry->View_Template->show($view);
        }

    /*
     * Function to parse posted project variables and run showView() function with parameters
     * 
     * @return (function)   Run function with obtained variables 
     */

    public function editProject()
        {
        $this->is_project = true;
        $proj_id = $_POST['proj_id'];
//boolean to return true on success, false otherwise
        $updated = Project_Model::editProject($_POST);
        return $this->showView($updated, $proj_id);
        }

    /*
     * Function to parse posted variables and run showView() function with parameters
     * 
     * @return (function)   Run function with obtained variables 
     */

    public function editTask()
        {
        $this->is_project = false;

        $proj_id = $_POST['proj_id'];
//Assign posted fields to an array
        $updated = Task_Model::editTask($_POST);
        return $this->showView($updated, $proj_id);
        }

    /*
     * Function to generate variables for use in showMessage function and 
     * display message based on $success.
     * @param (boolean) $success    This is the variable used to define 
     *                              whether editObject() was successful
     */

    private function showView($success, $proj_id = null)
        {
        try
            {
            $link = "<a href=\"?page=Home\"> home </a>";
            if ($this->is_project)
                {
                $model = "Project";
                } else
                {
                $model = "Task";
                $link = " to "
                        . "<a href=\"?page=Task&proj_id={$proj_id}\">"
                        . "task list</a>";
                }

            if (is_bool($success) && $success)
                {
                $this->registry->View_Template->error = false;
                $this->registry->View_Template->heading = $model . " updated!";
                $this->registry->View_Template->message = "Return " . $link;
                } else
                {
                throw new Exception("Error Updating " . $model);
                }
            } catch (Exception $e)
            {
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = $e->getMessage();
            $this->registry->View_Template->message = $success;
            }
        $this->registry->View_Template->show('showMessage');
        }

    private function processDependency()
        {
//Set project variables (for use internally)
        $proj_id = $this->task->proj_id();
        $projTasks = Task_Model::getAllTasks($proj_id);
        //var_dump($projTasks);
        $dependencies = array();
//unset(array_keys($projTasks, $this->task->tsk_id()));
        $dp = new Dependency_Model($this->task->dpnd());

        foreach ($projTasks as $key => $val)
            {
            try{
                //Remove the Task object if it is the same as the current task
            if ($val->tsk_id() === $this->task->tsk_id())
                {
                //Issues with using direct $key val so cast to int
                $key = (int) $key;
                //Remove the current task from the list of dependencies
                unset($projTasks[$key]);
                throw new Exception();
                }
                
                //Find all task ids that exist in dp->dpnd()
                if ($dp->dpnd_on() === $val->tsk_id())
                    {
                    $checked = "checked";
                    } else
                    {
                    $checked = '';
                    }
                    //Push checkbox string into array
                $chckBoxStr = "<label id=\"dpndNm\">{$val->tsk_nm()}</label>"
                        . "<input type=\"checkbox\" name=\"tDpnd[]\" "
                        . "value=\"{$val->tsk_id()}\" $checked/>";
                array_push($dependencies, $chckBoxStr);
                } catch (Exception $ex) {
                    //Exception caught - used to bypass logic
                }
            }
        return $dependencies;
        }

    }
