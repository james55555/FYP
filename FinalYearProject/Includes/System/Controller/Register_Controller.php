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
            $this->registry->heading = "Registration success!";
            $this->registry->message = "You are now a registered user."
                    . "<br/>"
                    . "<a href=?page=Login>Return to login</a>";
            } else
            {
            $this->registry->heading = "Error adding new user...";
            //Print errors as a list             
                $this->registry->message = $this->newUser;
                
            }

        $this->registry->View_Template->show('showMessage');
        }

    /*
     * Helper method to add the 'posted' fields
     */

    private function checkForm()
        {
        $valid = false;

        //assign to an array.
        $registrationFields = array();


        $registrationFields['fname'] = $_POST['fname'];
        $registrationFields['lname'] = $_POST['lname'];
        $registrationFields['email'] = $_POST['email'];
        $registrationFields['user_id'] = $_POST['user_id'];
        $registrationFields['password'] = $_POST['password'];
        $registrationFields['password2'] = $_POST['password2'];

        if ($registrationFields['password'] === $registrationFields['password2'])
            {
            $this->newUser = Account_Model::addUser($registrationFields);
            if (is_bool($this->newUser))
                {
                $valid = true;
                }
                elseif(is_array($this->newUser) || is_string($this->newUser)){
                    $valid = false;
                    }
            }
            else{
                $this->newUser = "Passwords didn't match...";
                }
            
        return $valid;
        }

    }
?>

