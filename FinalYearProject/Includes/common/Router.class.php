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

        if (is_dir($path))
            {
            $this->path = $path;
            }
        else
            {
            throw new Exception("Incorrect Path");
            }
        }

/*
 * Loader function
 */
    public
            function loader()
        {
//assign controller from getController to this->controller
            $this->controller = $this->getController();

            //Check if the fileName is available
            if (!!!is_readable($this->fileName))
                {
                //added echo and else if
                echo "Filename not readable: <br/>" 
                . var_dump($this->fileName);
                //$this->controller = 'Error';
                }
            elseif (is_readable($this->fileName))
                {
                //include the controller
                include_once($this->fileName);
                }
            //name controller class i.e. Login_Controller
            $class = $this->controller . '_Controller';
            // new Login_Controller
            $controller = new $class($this->registry);
            //verify that the contents of the array can be called as a function
            if (is_callable(array($controller, $this->action)) == false)
                {
                $action = 'main';
                //if the action is callable then run the action
                }
            else
                {
                $action = $this->action;
                }
            //run action
            $controller->$action();
        }

    /*
     * Gets controller based on url location.
     */

    protected
            function getController()
        {
        $this->controller = empty($_GET['page']) ? 'Login' : $_GET['page'];

        //Store action action in @var action
        $this->action = $this->getAction();


        //get the controller source file.
        //use ? delimiter to exit concatenation and concatenate earlier?
        $this->fileName = trim(__CONTROLLER_PATH . $this->controller . '_Controller.php');
        if (is_readable($this->fileName))
            {
            include_once $this->fileName;
            }
        else
            {
            $this->controller = 'Error';
            $this->fileName = trim(__CONTROLLER_PATH . $this->controller . '_Controller.php');
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
            $this->action = 'index';
            }
        else
            {
            $this->action = $_GET['action'];
            }
        return $this->action;
        }

    }
