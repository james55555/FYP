<?php
#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: addProject
#@author: James
?>
<html>
    <!DOCTYPE html>
    <head>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/addProject.css"/>

        <title>Time Management System for Professionals - Add New Project page</title>
    </head>
    <body>
        <?php
        include("header.php");
        ?>
        <div id="container">
            <div id="content" class="centralBox"> 
                <h1>Add Project</h1>

                <form id="addProject" action="?page=add&action=addProject&isProj=true" 
                      method="post"> <!--onsubmit="return projectValidation()"-->
                    <div id="details">
                        <h2>Details</h2>
                        <label>Name: </label><input type="text" name="pName"/><br/>
                        <label>Description:  </label><textarea 
                            maxlength="200"
                            name="pDescr"
                            placeholder="Limit of 200 characters"></textarea>
                    </div> <!--End of details-->
                    <div id="projDates">
                        <h2>Project Dates</h2>
                        <label title="When will the project start?">
                            Start Date: </label><input type="date" name="pStart"/>
                        <label title="When will the project end?">
                            Deadline: </label><input type="date" name="pDeadline"/>
                        <label title="How many hours will be assigned to the project?">
                            Estimate: </label><input type="text" name="pln_hr"/>
                    </div> <!--End of projDates-->

                    <input type="submit" value="Submit" class="button" id="newProj"/>
                </form>    
            </div><!--End of content-->
        </div><!--End of container-->
        <?php
        include("footer.php");
        ?>
    </body>
</html>