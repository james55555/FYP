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
        if (isset($_POST['submit']))
            {
            $valid = $this->checkForm();
            if ($valid)
                {
                $this->registry->heading = "Registration success!";
                $this->registry->message = "You are now a registered user.";
                } else
                {
                $this->registry->title = "Error adding new user...";
                     //Print errors as a list                 
                    $this->registry->message = implode("</br>", $this->newUser);
                }

            $this->registry->View_Template->show('showMessage');
            }
        }

    /*
     * Helper method to add the 'posted' fields
     */

    private function checkForm()
        {
        $valid = false;

        //Create publically available array
        $this->registry->registrationFields = array();
        //assign to an easier to use variable.
        $registrationFields = $this->registry->registrationFields;


        $registrationFields['fname'] = $_POST['fname'];
        $registrationFields['lname'] = $_POST['lname'];
        $registrationFields['email'] = $_POST['email'];
        $registrationFields['user_id'] = $_POST['user_id'];
        $registrationFields['password'] = $_POST['password'];
        $registrationFields['password2'] = $_POST['password2'];

        foreach ($registrationFields as $field)
            {
            //look to loop through fields and validate similar fields.
            $this->filterVars($field);
            $registrationFields[$field] = $field;
            }

        if ($registrationFields['password'] === $registrationFields['password2'])
            {
            $this->newUser = Account_Model::addUser($registrationFields);
            if (is_bool($this->newUser))
                {
                $valid = true;
                } else
                {
                $valid = false;

                }
            } else
            {
            $valid = false;
            echo("The two passwords provided do not match.");
            }
        return $valid;
        }

    protected function filterVars($value)
        {
        $htmlVal = htmlspecialchars($value);
        return mysqli_real_escape_string($htmlVal);
        }

    }

?>
