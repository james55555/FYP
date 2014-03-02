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
        if (isset($_POST['username']))
            {
            $this->user = $_POST['username'];
            if (isset($_POST['password']))
                {
                $this->pwd = $_POST['password'];

                $this->login($this->user, $this->pwd);
                }
            if ($this->success)
                {
                header('Location: .');
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
        if ($acc !== null && $acc->password() === $password)
            {
//Log in successful, set up new session and set boolean to false
            $_SESSION['user'] = $acc;
            $this->success = true;
            } else
            {
//unsuccessful login, reset session id and set boolean to true
            $_SESSION['user'] = null;
            }
        return $this->success;
        }

    }
?>
