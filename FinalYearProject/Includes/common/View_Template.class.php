<?php

/*
 *  Namespace       : common
 *  Document        : view.php
 *  Author          : James Graham
 *  Description     : display pages
 * 
 */

Class View_Template
    {

    private
            $registry;
    private
            $variables = array();

    /*
     * Construct registry object
     */

    public
            function __construct($registry)
        {
        $this->registry = $registry;
        }

    /*
     * Set undefined variables
     * @param String $key
     * @param any $value
     */

    public
            function __set($key, $value)
        {
        $this->variables[$key] = $value;
        }

    public
            function show($viewName)
        {
        try
            {
            //Assign path to view name
            
                $fullViewName = __VIEW_PATH . DIRECTORY_SEPARATOR .
                        $viewName . '.php';
            if (file_exists($fullViewName))
                {
                //Load variables
                foreach ($this->variables as $key => $value)
                    {
                    //variable declaration within function hence $$
                    $$key = $value;
                    }
                } else
                {
                throw new Exception("Error 404 - Redirect Error");
                }
                //If there are errors then catch the exceptions and redirect 
                //the user to the show message page and display error
            } catch (Exception $e)
            {
            $this->registry->error = true;
            
                $this->registry->heading = $e->getMessage();
                $this->registry->message = "There has been an issue taking you to this page."
                        . "<br/>File doesn't exist.";
                $this->show('showMessage');
            }
        include $fullViewName;
        }

    }

?>
