<?php
/*
 *  Namespace       : Vendor
 *  Document        : index.php
 *  Author          : James Graham
 *  Description     : initiate master class @autoload
 * 
 */

 //Load up the configuration (inc site_path and error reporting)
require "configuration.php";

//Start the session
session_start();

//Load the router
$registry->router = new router($registry);

//Set the path of the controller
$registry->router->setPath(__CONTROLLER_PATH);

//Load the template
$registry->View_Template = new View_Template($registry); 

//Load the controller
$registry->router->loader();

?>
