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

        $this->registry->project_tasks = Task_Model::getAllTasks($_GET['proj_id']);
        $this->project = new Project_Model($_GET['proj_id']);
        $this->registry->projectEstimation = Estimation_Model::get($this->project->estimation());

//Show the projectTasks view
        $this->registry->View_Template->show('projectTasks');
        }

    /*
     * Function to set individual task variables and 
     * show the task details page
     */

    public function details()
        {
        $this->registry->task = new Task_Model($_GET['task_id']);
        $this->registry->project = new Project_Model
                ($this->registry->task->proj_id());
        $this->registry->taskEstimation = Estimation_Model::get($this->registry->task->estimation());
        $this->registry->taskStaff = Staff_Model::get($this->registry->task->staff());
        $this->registry->taskDependencies = Dependency_Model::get($this->registry->task->dpnd());

        $this->registry->View_Template->show('taskDetails');
        }

    public function editTask()
        {
        
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
                    //Run the delete function and return a boolean
                    $this->success = Task_Model::deleteTask($_GET['task_id']);
                    } else
                    {
                    throw new Exception("Task has already been deleted!");
                    }
                }
            if ($this->success)
                {
                $this->registry->error = false;
                $this->registry->heading = "Success";
                $this->registry->message = "Task successfully deleted";
                } else
                {
                throw new Exception("Something went wrong!");
                }
            }//End of try
        catch (Exception $e)
            {
            $this->registry->error = true;
            $this->registry->heading = "Error Deleting..";
            $this->registry->message = $e->getMessage();
            }
        $this->registry->View_Template->show('showMessage');
        }

    public function addTask()
        {
        $this->registry->View_Template->show('addTask');
        }

    }
