<?php

/**
 * Description of Home_Controller
 *
 * @author new user
 */
class Home_Controller extends Main_Controller
    {

    public function main()
        {
        try
            {
            //Get all projects assigned to user in session available
            $list = Project_Model::getAllUserProj($_SESSION['user']->user_id);
            if (is_string($list))
                {
                throw new Exception($list);
                }
            $this->registry->View_Template->projects = $list;
            } catch (Exception $e)
            {
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = "Project Query Error!";
            $this->registry->View_Template->message = $e->getMessage() . "<br/>" . mysqli_error();
            $this->registry->View_Template->show('showMessage');
            }
        //Show the home screen
        $this->registry->View_Template->show('Home');
        }

    public function delete()
        {
        try
            {
            if (isset($_GET['proj_id']))
                {
                $exists = Project_Model::getProject($_GET['proj_id']);
                if (isset($exists))
                    {
                    //Run the delete function and return a boolean
                    $this->success = Project_Model::deleteProject($_GET['proj_id']);
                    } else
                    {
                    throw new Exception("Project has already been deleted!");
                    }
                }
            if ($this->success)
                {
                $this->registry->View_Template->error = false;
                $this->registry->View_Template->heading = "Success";
                $this->registry->View_Template->message = "Project successfully deleted<br/>"
                        . "Click <a href=\"?page=Home\"> here </a>" .
                        " to view your projects";
                } else
                {
                throw new Exception("Something went wrong!");
                }
            } catch (Exception $e)
            {
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = "Error Deleting..";
            $this->registry->View_Template->message = $e->getMessage();
            }
        $this->registry->View_Template->show('showMessage');
        }

    }

?>