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
        <title>Time Management System for Professionals - Add New Project page</title>

    </head>
    <body>
        <div id="container">
            <?php
            include("header.php");
            ?>
            <div class="centralBox" id="content"> 
                <h1>Add Project</h1>

                <form id="addProject" action="?page=addProject&action=submitForm" 
                      method="post" onsubmit="return projectValidation()">
                    <div id="details">
                        <label>Name: <input type="text" name="pName"/></label><br/>
                        <label>Description:  <textarea 
                                form="addProject"
                                rows="4"
                                coles="50"
                                maxlength="200"
                                name="pDescr"></textarea></label><br/>
                    </div> <!--End of details-->
                    <div class="regInput" id="projDates">
                        <h2>Project Dates</h2>
                        <label>Start Date: <input type="date" name="pStart"/></label>
                        <label>Deadline: <input type="date" name="pDeadline"/></label>
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