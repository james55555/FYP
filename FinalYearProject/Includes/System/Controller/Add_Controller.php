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
        //if is task or is project)
        
            if($_GET['isProj'])
                {
            $this->registry->View_Template->show('addProject');
            } else
            {
            $this->registry->View_Template->show('addTask');
            }
        }

    /*
     * @param boolean $err - if is an error
     * @param String $errDetails - then print out details
     */

    public function showError()
        {
        if ($this->isProject)
            {
            $valid = $this->addProject(); 
            if($valid){
                $this->registry->heading = "Project Added!";
                $this->registry->message = " has been added";
                }
                else {
                    $this->registry->error = true;
                    $this->registry->heading = "Error adding project";
                    $this->registry->message = $this->newProject;
                    }
            }
            $this->registry->View_Template->show('showMessage');
        }

    public function addProject()
        {
        $valid = false;
        $this->isProject = true;
        //assign to an array
        $fields = array();

        $fields['pName'] = $_POST['pName'];
        $fields['pDescr'] = $_POST['pDescr'];
        $fields['pStart'] = $_POST['pStart'];
        $fields['pDead'] = $_POST['pDeadline'];
        $fields['pln_hr'] = $_POST['pln_hr'];

        $this->newProject = Project_Model::addProject($fields);
        if (is_bool($this->newProject))
            {
            $valid = true;
            } elseif (is_array($this->newProject) ||
                is_string($this->newProject))
            {
            $valid = false;
            }
        return $valid;
        }

    public function addTask()
        {
        $valid = false;
        $this->isProject = true;
        //assign to an array
        $fields = array();

        $fields['tName'] = $_POST['tName'];
        $fields['tDescr'] = $_POST['tDescr'];
        $fields['tStart'] = $_POST['tStart'];
        $fields['tDead'] = $_POST['pDeadline'];
        $fields['pln_hr'] = $_POST['pln_hr'];

        $this->newProject = Task_Model::addTask($fields);
        if (is_bool($this->newProject))
            {
            $valid = true;
            } elseif (is_array($this->newProject) ||
                is_string($this->newProject))
            {
            $valid = false;
            }
        return $valid;
        }

    }
