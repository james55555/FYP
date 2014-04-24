<?php

/**
 * Description of Add_Controller
 *
 * @author James
 */
class Add_Controller extends Main_Controller
    {

    private $isProject = false;
    protected $newProject;
    protected $newTask;

    public function main()
        {
        //Direct to page depending on whether the object is project or task
        if (isset($_GET['isProj']) && $_GET['isProj'] === "true")
            {
            $this->registry->View_Template->show('addProject');
            } else
            {
            $this->registry->View_Template->projTasks = Task_Model::getAllTasks($_GET['proj_id']);
            //Make dates available to view
            $project = new Project_Model($_GET['proj_id']);
            $this->registry->View_Template->projEst = new Estimation_Model($project->estimation());
            $this->registry->View_Template->show('addTask');
            }
        }

    public function addProject()
        {
        $this->isProject = true;
        //assign to an array
        $fields = array();

        $fields['pName'] = $_POST['pName'];
        $fields['pDescr'] = $_POST['pDescr'];
        $fields['pStart'] = $_POST['pStart'];
        $fields['pDead'] = $_POST['pDeadline'];
        $fields['pln_hr'] = $_POST['pln_hr'];

        $this->newProject = Project_Model::addProject($fields);
        return $this->showView();
        }

    public function addTask()
        {
        $this->isProject = false;
        //assign to an array

        $this->newTask = Task_Model::addTask($_POST);
        return $this->showView();
        }

    /*
     * Helper method to show view based on status of project error
     * @param boolean $err - if is an error
     * @param String $errDetails - then print out details
     */

    private function showView()
        {
        //Identify whether or not the object is a project or task
        if ($this->isProject)
            {
            //If the project is set to an array or string then an error message needs to be printed
            if (is_array($this->newProject) ||
                    is_string($this->newProject))
                {
                $this->registry->View_Template->error = true;
                $this->registry->View_Template->heading = "Error adding project";
                $this->registry->View_Template->message = $this->newProject;
                } else
                {
                $this->registry->View_Template->error = false;
                $this->registry->View_Template->heading = "Project Added!";
                $this->registry->View_Template->message = "Click <a href=\"?page=Home\"> here </a> "
                        . "to view your projects";
                }
            } elseif (!$this->isProject)
            {
            if (is_array($this->newTask) ||
                    is_string($this->newTask))
                {
                $this->registry->View_Template->error = true;
                $this->registry->View_Template->heading = "Error adding task!";
                $this->registry->View_Template->message = $this->newTask;
                } else
                {
                $this->registry->View_Template->error = false;
                $this->registry->View_Template->heading = "Task Added!";
                $this->registry->View_Template->message = "Click <a href=\"?page=Task&action=details&task_id=" . $this->newTask->tsk_id() . "\">"
                        . " here </a> to view tasks.";
                }
            } else
            {
            die("Something is wrong here (Add_Controller)");
            }
        $this->registry->View_Template->show('showMessage');
        }

    }
