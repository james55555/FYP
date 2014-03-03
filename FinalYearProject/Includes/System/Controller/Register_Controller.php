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

        if ($_POST['submit'])
            {
            $valid = $this->checkForm();
            if ($valid)
                {
                $this->registry->heading = "Registration success!";
                $this->registry->message = "You are now a registered user.";
                } else
                {
                $this->registry->title = "Error adding new user...";
                $this->registry->message = $this->newUser;
                }

            $this->registry->View_Template->show('showMessage');
            }
        $this->registry->View_Template->show('register');
        }

    /*
     * Helper method to add the 'posted' fields
     */

    private function checkForm()
        {
        $valid = false;

        //add the fields in register.php to an array
        $registrationFields = array();
        $registrationFields['fname'] = $_POST['fname'];
        $registrationFields['lname'] = $_POST['lname'];
        $registrationFields['email'] = $_POST['email'];
        $registrationFields['user_id'] = $_POST['user_id'];
        $registrationFields['password'] = $_POST['password'];
        $registrationFields['password2'] = $_POST['password2'];

        $this->newUser = Account_Model::addUser($registrationFields);

        if (!is_string($this->newUser))
            {
            $valid = true;
            }


        return $valid;
        }

    }

?>
