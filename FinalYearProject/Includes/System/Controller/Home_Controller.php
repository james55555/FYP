<?php

/**
 * Description of Home_Controller
 *
 * @author new user
 */
class Home_Controller extends Main_Controller
    {

    public
            function main()
        {
        //Get all projects assigned to user in session available
        $this->registry->projects = Project_Model::getAllUserProj($_SESSION['user']->user_id);

        //Show the home screen
        $this->registry->View_Template->show('home');
        }

    public function delete()
        {
        try {
        if (isset($_GET['proj_id']))
            {
            $exists = Project_Model::getProject($_GET['proj_id']);
            if(isset($exists)){
                //Run the delete function and return a boolean
            $this->success = Project_Model::deleteProject($_GET['proj_id']);
                }
            else {
                throw new Exception("Project has already been deleted!");
                }
            }
        if ($this->success)
            {
            $this->registry->heading = "Success";
            $this->registry->message = "Project successfully deleted<br/>"
                    ."Click <a href=\"?page=\Home\"> here </a>" .
                        " to view your projects";
            } else
            {
                throw new Exception("Something went wrong!");
            }
        }
        catch(Exception $e){
            $this->registry->error = true;
            $this->registry->heading = "Error Deleting..";
            $this->registry->message = $e->getMessage();
            }
        $this->registry->View_Template->show('showMessage');
        }
        public function addProj(){
            $this->registry->View_Template->show('addProject');
            }
        
    }

?>