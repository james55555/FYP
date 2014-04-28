<?php

/**
 * Description of Add_Controller
 *
 * @author James
 */
class Add_Controller extends Main_Controller
    {

    private $is_project = false;
    protected $newProject;
    protected $newTask;

    public function main()
        {
        
        $this->registry->variable; //Incorrect
        $this->registry->View_Template->variable; //Correct
        
        //Direct to page depending on whether the object is project or task
        if (isset($_GET['isProj']) && $_GET['isProj'] === "true")
            {
            $this->registry->View_Template->show('addProject');
            } else
            {
            //Make dates available to view
            $project = new Project_Model($_GET['proj_id']);
            //et up $projTasks
            $this->registry->View_Template->projEst = new Estimation_Model($project->estimation());
            $this->registry->View_Template->show('addTask');
            }
        }

    public function addProject()
        {
        $this->is_project = true;
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
        $this->is_project = false;
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
        if ($this->is_project)
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
            } elseif (!$this->is_project)
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
