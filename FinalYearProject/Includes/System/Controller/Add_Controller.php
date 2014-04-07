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

    public function main()
        {
        //if is task or is project

        if ($_GET['isProj'])
            {
            $this->registry->View_Template->show('addProject');
            } else
            {
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
        $fields = array();
        //TASK data
        $fields['tName'] = $_POST['tName'];
        $fields['tDescr'] = $_POST['tDescr'];
        $fields['web_addr'] = $_POST['web_addr'];
        $fields['dpnd'] = $_POST['tDpnd'];
        $fields['status'] = $_POST['status'];
        //ESTIMATION data
        $fields['tStart'] = $_POST['tStart'];
        $fields['tDeadline'] = $_POST['tDeadline'];
        $fields['pln_hr'] = $_POST['pln_hr'];
        //STAFF data
        $fields['stFirst'] = $_POST['stFirst'];
        $fields['stLast'] = $_POST['stLast'];
        $fields['stTel'] = $_POST['stTel'];
        $fields['stEmail'] = $_POST['stEmail'];

        $this->newtask = Task_Model::addTask($fields);

        return showView();
        }

    /*
     * Helper method to show view based on status of project error
     * @param boolean $err - if is an error
     * @param String $errDetails - then print out details
     */

    public function showView()
        {
        //Identify whether or not the object is a project or task
        if ($this->isProject)
            {
            //If the project is set to an array or string then an error message needs to be printed
            if (is_array($this->newProject) ||
                    is_string($this->newProject))
                {
                $this->registry->error = true;
                $this->registry->heading = "Error adding project";
                $this->registry->message = $this->newProject;
                } else
                {
                $this->registry->heading = "Project Added!";
                $this->registry->message = "Click <a href=\"?page=\Home\"> here </a>
                        to view your projects";
                }
            } elseif (!$this->isProject)
            {
            if (is_array($this->newTask) ||
                    is_string($this->newTask))
                {
                $this->registry->error = true;
                $this->registry->heading = "Error adding task!";
                $this->registry->message = $this->newProject;
                } else
                {
                $this->registry->heading = "Task Added!";
                $this->registry->message = "Possibly add click here to navigate to new task??";
                }
            } else
            {
            die("Something is wrong here (Add_Controller)");
            }
        $this->registry->View_Template->show('showMessage');
        }

    }
