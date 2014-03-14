<?php

/**
 * Description of taskList_Controller
 *
 * @author James
 */
class Task_Controller extends Main_Controller
    {

    public
            function main()
        {

        $this->registry->project_tasks = Task_Model::getAllTasks($_GET['proj_id']);
        $project = Project_Model::getProject($_GET['proj_id']);
        $this->registry->projectEstimation = Estimation_Model::get($project->estimation());
        //Show the projectTasks view
        $this->registry->View_Template->show('projectTasks');
        }
        public function details($id){
            $this->registry->task = Task_Model::getTask($id);
            $this->registry->taskEstimation = 
                    Estimation_Model::get($this->registry->task->estimation());
            
            $this->registry->View_Template->show('taskDetails');
            }

    }
