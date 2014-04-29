<?php

/*
 *  Namespace       : Vendor
 *  Document        : autoload.php
 *  Author          : James Graham
 *  Description     : Autoload classes
 * 
 */

/*
 * Include classes in common directory
 */

// include base_controller
include __COMMON_PATH . 'Main_Controller.class.php';

// include  registry class
include __COMMON_PATH . 'Registry.class.php';

// include  viewTemplate class
include __COMMON_PATH . 'View_Template.class.php';

// include  router class
include __COMMON_PATH . 'Router.class.php';

//include Database class
include __COMMON_PATH . 'Database.class.php';

//include password hashing class
include __COMMON_PATH . 'PassHash.class.php';

//include database generic queries class
include __COMMON_PATH . 'Database_Queries.class.php';

/*
 * Autoload undefined class
 * @param className
 */

function __autoload($className)
    {
    try
        {
        if (substr($className, -5) === 'Model')
            {
            $fileName = str_replace('\\', '/', (__MODEL_PATH .
                    $className . '.php'));
            } elseif (substr($className, 10) === 'Controller')
            {
            $fileName = str_replace('\\', '/', (__CONTROLLER_PATH . $className . '.php'));
            } else
            {
            $fileName = $className;
            }
//If the class exists then load, else run the error controller.
        if (file_exists($fileName))
            {
            require $fileName;
            } else
            {
            throw new Exception("Error404");
            }
        } catch (Exception $e)
        {
        $fileName = str_replace('\\', '/', (__CONTROLLER_PATH . $e->getMessage()
                . '.php'));
        }
    }

//Create new registry object
$registry = new registry();
?>