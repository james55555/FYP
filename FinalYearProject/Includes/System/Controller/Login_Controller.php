<?php

/*
 *  Controller to log the user into the system.
 *  @author James Graham
 */
class Login_Controller extends Main_Controller
    {

private $invalidLogin = true;
    public
            function main()
        {
        //if the username/password are set then the form has been submitted.
        if (isset($_POST['username']) && isset($_POST['password']))
            {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $this->login($user, $pass);
            }

        // Double negative - if login isn't invalid then log them in.
        if ($this->invalidLogin === false)
            {
            ?>
<script type="text/javascript">
alert("Username/ Password isn\'t valid!!");
</script>
<?php

            header('Location: .');
                        }
            
        $this->registry->View_Template->show('login');
        }

    /*
     * Method to create a new session for given username
     */

    private
            function login($user, $password)
        {
        // Get the account from the database
        $acc = Account_Model::getUser($user);

        //Ensure password is correct
        if (isset($acc) && $acc->password() == $password)
            {
            //Log in successful, set up new session and set boolean to false
            $_SESSION['user'] = $acc;
            $this->invalidLogin = false;
            
            }
        else
            {
            //unsuccessful login, reset session id and set boolean to true
            $_SESSION['user'] = null;
            $this->invalidLogin = true;
            }
        }
        
    }

?>
