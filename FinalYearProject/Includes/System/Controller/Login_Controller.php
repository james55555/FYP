<?php

/*
 *  Controller to log the user into the system.
 *  @author James Graham
 */

class Login_Controller extends Main_Controller
    {
    /*
     * This function is run when the user presses 'Login'
     * 
     * @return $this->login === Success ? ?page=home : ?page=Login
     */

    public
            function main()
        {
        $this->registry->success = null;
        try
            {
            //If username or passwword ar empty provide error
            if (isset($_POST['username']) && isset($_POST['password']))
                {
                //Check the provided credentials are correct
                if (!$this->login($_POST['username'], $_POST['password']))
                    {
                    throw new Exception("<p>Invalid Credentials</p>");
                    }
                //If authentication was successful
                header('Location: ?page=home');
                }
            } catch (Exception $ex)
            {
            //If caught, make error_string available to view
            $this->registry->View_Template->error_string = $ex->getMessage();
            }

        //Does the errror string have to be in the registry? yes
        $this->registry->View_Template->show('login');
        }

    /*
     * Function to run login and set $_SESSION variables
     * All parameters are passed from the login screen
     * @param (String) $user        This is the username provided
     * @param (String) $password    This is the password provided
     * 
     * @return (bool)               True if credentials are correct, false otherwise.
     */

    private
            function login($user, $password)
        {
//Default - set session to null
        $_SESSION['user'] = null;
// Get the account from the database
        $acc = Account_Model::getUser($user);
//Ensure password is correct
        if (isset($acc))
            {
//Unhash t
            if (PassHash::check_password($acc->password, $password))
                {
//Log in successful, set up new session and set boolean to false
                $_SESSION['user'] = $acc;
                return true;
                }
            }
        return false;
        }

    }

?>
