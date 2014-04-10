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
        if ($_GET['isProj'])
            {
            $this->registry->project = new Project_Model($_GET['proj_id']);
            $view = 'editProject';
            $est_id = $this->registry->project->estimation();
            } else
            {
            $this->registry->task = new Task_Model($_GET['task_id']);
            $view = 'editTask';
            $est_id = $this->registry->task->estimation();
            }
            $this->registry->estimation = new Estimation_Model($est_id);
            $this->registry->View_Template->show($view);
        }

    public function editProject()
        {
        $this->isProject = true;
        //Assign posted fields to an array
        $fields = array();
        $fields['proj_id'] = $_POST['proj_id'];
        $fields['pName'] = $_POST['pName'];
        $fields['pDescr'] = $_POST['pDescr'];
        $fields['pStart'] = $_POST['pStart'];
        $fields['pDead'] = $_POST['pDeadline'];
        $fields['pln_hr'] = $_POST['pln_hr'];
        //boolean to return true on success, false otherwise
        $updated = Project_Model::editProject($fields);

        return $this->showView($updated);
        }

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

            if ($success)
                {
                $this->registry->error = false;
                $this->registry->heading = $model . " updated!";
                $this->regisry->message = "Return " . $link;
                } else
                {
                throw new Exception("Error Updating . " . $model);
                }
            } catch (Exception $e)
            {
            $this->registry->error = true;
            $this->registry->heading = $e->getMessage();
            $this->registry->message = "System error: " . $e->getTraceAsString();
            }
        }

    }
