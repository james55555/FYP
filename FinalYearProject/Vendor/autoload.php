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
//Autoload undefined class
//@param className
function __autoload($className)
    {
    if (substr($className, -5) == 'Model')
        {
        $fileName = str_replace('\\', '/', (__MODEL_PATH . 
                $className . '.php'));
        }
        else if (substr($className, -10) == 'Controller')    {
            echo "controller";
            $fileName = str_replace('\\', '/', (__CONTROLLER_PATH . 
                $className . '.php'));
            }
    else
        {
        $fileName = str_replace('\\', '/', (__SITE_PATH . DIRECTORY_SEPARATOR . $className . '.class.php'));
        }


//Run this class
    if (file_exists($fileName))
        {
        require $fileName;
        }
    else
        {
        echo "file doesn't exist: " . $fileName;
        return false;
        }
    }

//Create new registry object
$registry = new registry();
//$this->registry->Database->connect();


?>