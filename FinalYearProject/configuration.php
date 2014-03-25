<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
//Set up autoload path for error handling
define('__AUTOLOAD_PATH', __SITE_PATH . '/Vendor/autoload.php');

include __AUTOLOAD_PATH;

?>
