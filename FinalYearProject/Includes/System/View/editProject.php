<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: editProject
#@author: James
?>
<html>
    <!DOCTYPE html>
    <head>
        <script type="text/javascript" src="Includes/common/Scripts/Validation.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
        <title>Time Management System for Professionals - Add New Project page</title>
    </head>
    <body>
        <div id="container">
            <?php
            include("header.php");
            ?>
            <div class="centralBox" id="content"> 
                <h1>Add Project</h1>

                <form id="addProject" action="?page=add&action=addProject&isProj=true" 
                      method="post" onsubmit="return projectValidation()">
                    <div id="details">
                        <label>Name: <input type="text" name="pName"/></label><br/>
                        <label>Description:  <textarea 
                                rows=4
                                cols=50
                                maxlength="200"
                                name="pDescr"
                                placeholder="Limit of 200 characters"></textarea></label>
                    </div> <!--End of details-->
                    <div class="regInput" id="projDates">
                        <h2>Project Dates</h2>
                        <label>Start Date: <input type="date" name="pStart"/></label>
                        <label>Deadline: <input type="date" name="pDeadline"/></label>
                        <label>Estimated Hours assigned: <input type="text" name="pln_hr"></label>
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