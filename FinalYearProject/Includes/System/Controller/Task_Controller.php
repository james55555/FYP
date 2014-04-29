<?php

/**
 * Description of taskList_Controller
 *
 * @author James
 */
class Task_Controller extends Main_Controller
    {
    /*
     * Function to set task variables based on project data and 
     * display high-level task view
     */

    private $project;

    public
            function main()
        {
        $tasks = Task_Model::getAllTasks($_GET['proj_id']);
        //If there are more than 1 task, they will be keyed numerically as objects
        $this->registry->View_Template->project_tasks = $tasks;
        $tasks && !is_array($tasks) ? array($tasks) : $tasks;
        $this->project = new Project_Model($_GET['proj_id']);
        $this->registry->View_Template->projectEstimation = new Estimation_Model($this->project->estimation());
//Show the projectTasks view
        $this->registry->View_Template->show('projectTasks');
        }

    /*
     * Function to set individual task variables and 
     * show the task details page
     */

    public function details()
        {
        $task = new Task_Model($_GET['task_id']);
        $proj = new Project_Model($task->proj_id());
        $this->registry->View_Template->project = $proj;

        $this->registry->View_Template->taskEstimation = new Estimation_Model($task->estimation());

        //Optional field
        $this->registry->View_Template->staff = new Staff_Model($task->staff());
        //Optional field

        $depOn_arr = array();
        $dp = new Dependency_Model($task->dpnd());
        //dpnd_on can either be array or string - transfer to $depOn_arr for either
        if (is_string($dp->dpnd_on()))
            {
            array_push($depOn_arr, $dp->dpnd_on());
            } else
            {
            foreach ($dp->dpnd_on() as $id)
                {
                array_push($depOn_arr, $id);
                }
            }
        foreach ($depOn_arr as $key => $val)
            {
            //Task dependent on this one
            $dependent = Task_Model::getTask($val);
            //Foreach dependency list use the task id
            $hLink = "<a href=\"?page=Task&action=details&task_id={$dependent['tsk_id']}\">
          {$dependent['tsk_nm']}</a>";
            $depOn_arr[$key] = $hLink;
            }
        $this->registry->View_Template->dependencies = $depOn_arr;

        $this->registry->View_Template->task = $task;
        $this->registry->View_Template->show('taskDetails');
        }

    public function delete()
        {
        try
            {
            if (isset($_GET['task_id']))
                {
                //Check if the task has already been deleted
                $exists = Task_Model::getTask($_GET['task_id']);

                if (isset($exists))
                    {
                    //Get proj_id dependent on object type
                    $proj_id = is_array($exists) ? $exists['proj_id'] : $exists->PROJ_ID;
                    //Run the delete function and return a boolean
                    $this->success = Task_Model::deleteTask($_GET['task_id']);
                    } else
                    {
                    throw new Exception("Task has already been deleted!");
                    }
                }
            if ($this->success)
                {
                $this->registry->View_Template->error = false;
                $this->registry->View_Template->heading = "Success";
                $this->registry->View_Template->message = "Task successfully deleted<br/>"
                        . "Return to <a href=\"?page=Task&proj_id=" . $proj_id . "\">"
                        . "Task List</a>";
                } else
                {
                throw new Exception("Something went wrong!");
                }
            }//End of try
        catch (Exception $e)
            {
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = "Error Deleting..";
            $this->registry->View_Template->message = $e->getMessage();
            }
        $this->registry->View_Template->show('showMessage');
        }

    /*
     * Function to redirect user to add task page
     */

    public function addTask()
        {
        $this->registry->View_Template->show('addTask');
        }

    }
