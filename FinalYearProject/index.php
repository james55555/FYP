<?php

/*
 *  Namespace       : Vendor
 *  Document        : index.php
 *  Author          : James Graham
 *  Description     : initiate master class @autload
 * 
 */


/*
 * Turn error reporting on and start session
 */
error_reporting(E_ALL);

//Set up path constant for site
$site_path = realpath(dirname(__FILE__));
$sitePath = str_replace('\\', '/', $site_path);
define('__SITE_PATH', $sitePath);

$site_url = $_SERVER['REQUEST_URI'];
//Set up path to parent/abstract classes
define('__COMMON_PATH', __SITE_PATH . '/Includes/common/');

//Set up path to Models
define('__MODEL_PATH', __SITE_PATH . '/Includes/System/Model/');

//Set up path to Controllers
define('__CONTROLLER_PATH', __SITE_PATH . '/Includes/System/Controller/');

//Set up path to Views
define('__VIEW_PATH', __SITE_PATH . '/Includes/System/View/');

include __SITE_PATH .'/vendor/autoload.php';

//Start session
session_start();
//load router into registry
$registry->router = new router($registry);
//Set the path of the controller
$registry->router->setPath(__CONTROLLER_PATH);
//Load the template based on action object
$registry->View_Template = new View_Template($registry); 
//run loader function in router to load controller
$registry->router->loader();

?>
