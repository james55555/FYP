<?php

/*
 *  Namespace       : Vendor
 *  Document        : index.php
 *  Author          : James Graham
 *  Description     : initiate master class @autload
 * 
 */
require "configuration.php";

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
