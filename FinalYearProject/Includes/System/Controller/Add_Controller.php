<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Add_Controller extends Main_Controller
    {

    public function main()
        {

        //Show the view for a adding a new item
        $this->registry->View_Template->show('NewItem');
        }

    public function add($fields)
        {
        $fields = array();
        //Need to provide logic to distinguish between task and project
        if ($isProject)
            {
            //Project Fields
            $fields['acc_id'] = $_SESSION['user']->userId();
            $fields['proj_id'] = null;
            $fields['proj_nm'] = $_POST['proj_nm'];
            $fields['proj_descr'] = $_POST['proj_descr'];
            $result = Project_Model::addProject($fields);
            }
        else
            {
            $fields['tsk_id'] = $_POST['tsk_id'];
            $fields['proj_id'] = $_POST['proj_id'];
            $fields['status'] = $_POST['status'];
            $fields['task_nm'] = $_POST['task_nm'];
            $fields['web_addr'] = $_POST['web_addr'];
            $fields['tsk_descr'] = $_POST['tsk_descr'];
            //New field estimation data
            $fields['pln_hr'] = $_POST['pln_hr'];
            $fields['start_dt'] = $_POST['start_dt'];
            $fields['deadline'] = $_POST['deadline'];
            //Not created yet
            //$result = Task_Model::addTask($fields);
            }
            
        }

    }
