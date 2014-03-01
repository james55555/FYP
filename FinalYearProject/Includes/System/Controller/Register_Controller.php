<?php

/*
 * Controller to validate form data and add user to database
 * @author James Graham
 */
class Register_Controller extends Main_Controller
    {
    /*
     * Inherited method to validate credentials and 
     * return user to /View/Home.php
     */

    public
            function main()
        {
        if (checkUsername($_POST['user']))
            {
            
            }
        else
            {
            echo "cannot get here";

            }
            echo $_GET['page'];
            $this->registry->View_Template->show($_GET['page']);
        }

    public
            function checkUsername($uname)
        {
        $uname = $_POST['user'];
        if (Account_Model::getUser($uname) == null)
            {
            return true;
            }
        else
            {
            return false;
            }
        }

    public
            function register()
        {
        $this->registry->View_Template->show('register');
        }

    }

?>
