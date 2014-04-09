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
            if (substr($viewName, 0, 3) !== 'err')
                {
                $fullViewName = __VIEW_PATH . DIRECTORY_SEPARATOR .
                        $viewName . '.php';
                } else
                {
                throw new Exception(0);
                }

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
                throw new Exception(1);
                }
                //If there are errors then catch the exceptions and redirect 
                //the user to the show message page and display error
            } catch (Exception $e)
            {
            $this->registry->error = true;
            if ($e->getCode() === 0)
                {
                $this->registry->heading = "Error 404 - Redirect Error";
                $this->registry->message = "There has been an issue taking you to this page."
                        . "<br/>Error here: " . $fullViewName;
                } elseif ($e->getCode() === 1)
                {
                $this->registry->heading = "File doesn't exist!";
                $this->registry->message = "The view attempted to load but the file didn't exist."
                        . "<br/>Error here: " . $fullViewName;
                }
                $fullViewName = $this->show('showMessage');
            }
        include $fullViewName;
        }

    }

?>
