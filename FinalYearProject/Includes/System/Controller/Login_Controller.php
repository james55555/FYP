<?php

/*
 *  Controller to log the user into the system.
 *  @author James Graham
 */

class Login_Controller extends Main_Controller
    {

    protected $success;
    protected $user;
    protected $pwd;

    public
            function main()
        {
       //if the username/password are set then the form has been submitted.
            //only attempt to log in if user id and pwd are set.
            if (isset($_POST['username']) && isset($_POST['password']))
                {
                //If authentication was successful
                $success = $this->login($_POST['username'], $_POST['password']);
                if ($success)
                    {
                    header('Location: ?page=home');
                    } else
                    {
                    ?>
                    <script type="text/javascript">
                      alert("Username or Password are not valid!!");
                    </script>
                    <?php

                    }
                }
                $this->registry->View_Template->show('login');
            }
        
    /*
     * Method to create a new session for given username
     */

    private
            function login($user, $password)
        {
        $this->success = false;
// Get the account from the database
        $acc = Account_Model::getUser($user);
//Ensure password is correct
        if (isset($acc))
            {
            if ($acc->password() === $password)
                {
//Log in successful, set up new session and set boolean to false
                $_SESSION['user'] = $acc;
                $this->success = true;
                }
            }
        return $this->success;
        }

    }
?>
