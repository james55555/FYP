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
        <script type="text/javascript" src="Includes/common/Scripts/confirmAction.js"></script>
        
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/editProject.css"/>

        <title>Time Management System for Professionals - Edit Project page</title>
    </head>
    <body>
        <?php
        include("header.php");
        ?>
        <div id="container">
            <div id="content" class="centralBox"> 
                <h1>Edit Project</h1>

                <form id="editProject" action="?page=Edit&action=editProject" 
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
                        <label>
                            Start Date: </label><input type="date" name="pStart"/>
                        <label>
                            Deadline: </label><input type="date" name="pDeadline"/>
                        <label>
                            Estimate: </label><input type="text" name="pln_hr"/>
                    </div> <!--End of projDates-->
                    <input type="hidden" value="<?php echo $_GET['proj_id']; ?>" name="proj_id"/>
                    <input type="button" value="Back" class="button"
                               onclick="history.go(-1);"/>
                    <input type="submit" value="Submit" class="button" id="newProj"/>
                    <input type="reset" value="Reset" class="button" 
                           onclick="return confirmAction('reset',
                           'all values')"/>
                </form>    
            </div><!--End of content-->
        </div><!--End of container-->
        <?php
        include("footer.php");
        ?>
    </body>
</html>