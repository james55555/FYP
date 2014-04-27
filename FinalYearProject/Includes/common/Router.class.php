<?php

/*
 * Router class to load correct controller
 */

Class Router
    {

    private
            $registry;
//variables to store Controller path details
//path of controller
    private
            $path;
//array to store controller parameters
    private
            $parms = array();
//file name of controller
    private
            $fileName;
//name of controller without .php suffix
    private
            $controller;
//name of controller class
    private
            $class;
//function to be performed when called
    private
            $action;

//
    public
            function __construct($registry)
        {
        $this->registry = $registry;
        }

    /*
     * Set the directory of the Controllers
     * @param String path
     */

    public
            function setPath($path)
        {
        try
            {
            if (is_dir($path))
                {
                $this->path = $path;
                } else
                {
                throw new Exception($path);
                }
            } catch (Exception $e)
            {
            $this->registry->View_Template->error = true;
            $this->registry->View_Template->heading = "Invalid path provided!";
            $this->registry->View_Template->message = "Path Provided: " . $e->getMessage();
            $this->registry->View_Template->show('showmessage');
            }
        }

    /*
     * Loader function
     */

    public
            function loader()
        {
        //assign controller from getController to this->controller);
        $this->controller = $this->getController();
        
        try
            {
            //Check if the fileName is available
            if (!!!is_readable($this->fileName))
                {
                //added echo and else if
                throw new Exception("<br/>Filename not readable: $this->fileName");
                } elseif (is_readable($this->fileName))
                {
                //include the controller
                include_once($this->fileName);
                }
            //name controller class i.e. Login_Controller
            $class = $this->controller . '_Controller';
            // new Login_Controller
            $controller = new $class($this->registry);
            //verify that the contents of the array can be called as a function
            if (!!!is_callable(array($controller, $this->action)))
                {
                $action = 'main';
                //if the action is callable then run the action
                } else
                {
                $action = $this->action;
                }
            //run action using Controller object
            $controller->$action();
            } catch (Exception $e)
            {
            echo "<a href=\"history.go(-1);\">" . $e->getMessage() . "</a>";
            }
        }

    /*
     * Gets controller based on url location.
     */

    protected
            function getController()
        {
        $this->controller = empty($_GET['page']) ? 'login' : $_GET['page'];
        
//Store action action in @var action
        $this->action = $this->getAction();
        //echo "Action: " . $this->action . "<br/>";
        //Crreate the fileName to call
        $this->fileName = trim(__CONTROLLER_PATH . ucfirst($this->controller) . '_Controller.php');
            //echo "Filename: " . $this->fileName;
        if (is_readable($this->fileName))
            {
            //  echo "<br/>filename readable: " . $this->fileName;
            include_once $this->fileName;
            } else
            {
            $this->controller = 'Error';
            $this->fileName = trim(__CONTROLLER_PATH . ucfirst($this->controller) . '_Controller.php');
            include_once $this->fileName;
            }
        return $this->controller;
        }

    /*
     * function to get the action variable
     */

    protected
            function getAction()
        {


        if (empty($_GET['action']))
            {
            $this->action = 'main';
            } else
            {
            $this->action = $_GET['action'];
            }
        return $this->action;
        }

    }
