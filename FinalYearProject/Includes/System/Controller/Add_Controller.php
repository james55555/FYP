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
        if ($_GET['page'] === 'Home')
            {
            $this->isProject = true;
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

    public function showError($err, $errDetails)
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

        //assign to an array
        $fields = array();

        $fields['pName'] = $_POST['pName'];
        $fields['pDescr'] = $_POST['pDescr'];
        $fields['pStart'] = $_POST['pStart'];
        $fields['pDead'] = $_POST['pDead'];
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
        
        }

    }
