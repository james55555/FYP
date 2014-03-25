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
    if(substr($className, -5 == 'Model'))
        {
        $fileName = str_replace('\\', '/', (__MODEL_PATH .
                $className . '.php'));
        }  else
        {
        $fileName = str_replace('\\', '/', (__SITE_PATH . $className . '.class.php'));
        }
//If the class exists then load, else run the error controller.
    if (file_exists($fileName))
        {
        require $fileName;
        } else
        {
            
        throw new Exception("File not found: " . $className
        . " // Location: " . $fileName);
        }
    }

//Create new registry object
$registry = new registry();
?>