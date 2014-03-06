<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: addProject
#@author: James

?>
<html>
    <head>
        <script tpye="text/javascript" src="Includes/common/Scripts/Validation.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/register.css"/>
        <title>Time Management System for Professionals - Add New Project page</title>

    </head>
    <body>
        <div id="container">
            <?php
            include("header.php");
            ?>
            <h1>Add Project</h1>
            <div id="addProjForm">
                <form id="addProject" action="?page=addProject&action=submitForm" method="post" onsubmit="return projectValidation()">
                    <label>Name: <input type="text" name="pName"/></label><br/>
                    <label>Description: <input type="text" name="pDescr"/></label><br/>
                    <label>Choose any Project Dependencies: </label>
                    <?php 
                    foreach($this->registry->projects as $proj){
                                                
                        echo "<input type=\"checkbox\" name=\"pDpnd\" "
                        . "value=\"{$proj->proj_id()}\">{$proj->proj_nm()}<br/>";
                        }  
                        ?>
                    <br>
                    <h2>Project Dates</h2>
                    <label>Start Date: <input type="date" name="pStart"</label>
                    <label>Deadline: <input type="date" name="pDeadline"</label>
                    <br>

                    <input type="submit" value="Submit" class="button" id="newUser"/>

                </form>
            </div>
            <?php
            include("footer.php");
            ?>
        </div>
    </body>
</html>