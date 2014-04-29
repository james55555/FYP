<?php

/*
 * Controller to validate form data and add user to database
 * @author James Graham
 */

class Register_Controller extends Main_Controller
    {

    protected $newUser;

    /*
     * Inherited method to validate credentials and 
     * return user to /View/Home.php
     */

    public
            function main()
        {
        $this->registry->View_Template->show('register');
        }

    public function submitForm()
        {

        $valid = $this->checkForm();
        if ($valid)
            {
            $this->registry->View_Template->error = false;
            $this->registry->View_Template->heading = "Registration success!";
            $this->registry->View_Template->message = "You are now a registered user."
                    . "<br/><a href=\"?page=Login\">Login with new details</a>";
            } else
            {
//Set user session to null so that header doesn't appear
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = "Error adding user!";
//Print errors             
            $this->registry->View_Template->message = $this->newUser;
            }

        $this->registry->View_Template->show('showMessage');
        }

    /*
     * Helper method to add the 'posted' fields
     */

    private function checkForm()
        {
        try
            {
            if ($_POST['password'] !== $_POST['password2'])
                {
                throw new Exception("Passwords don't match!");
                }
            $this->newUser = Account_Model::addUser($_POST);
            if (is_string($this->newUser) || is_array($this->newUser))
                {
                return false;
                }
            } catch (Exception $ex)
            {
            $this->newUser = $ex->getMessage();
            return false;
            }
        return true;
        }
    }
?>

