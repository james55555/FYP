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
        //Assign path to view name
        if (substr($viewName, 0, 3) !== 'err')   {
            $fullViewName = __VIEW_PATH . DIRECTORY_SEPARATOR .
                $viewName . '.php';
            }
        else    {
            $fullViewName = __VIEW_PATH . DIRECTORY_SEPARATOR . 'ErrorMessages' 
                    . DIRECTORY_SEPARATOR .
                $viewName . '.php';
            }

        if (file_exists($fullViewName))
            {
            //Load variables
            foreach ($this->variables as $key => $value)
                {
                //variable declaration within function hence $$
                $$key = $value;
                }
            }
        else
            {
            throw new Exception('<br/>View not found in ' . $fullViewName);
            
            }
            include $fullViewName;
        }

    }

?>
