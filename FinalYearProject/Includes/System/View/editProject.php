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
        $project = $this->registry->project;
        $estimation = $this->registry->estimation;
        ?>
        <div id="container">
            <div id="content" class="centralBox"> 
                <h1>Edit Project</h1>

                <form id="editProject" action="?page=Edit&action=editProject" 
                      method="post"> <!--onsubmit="return projectValidation()"-->
                    <div id="details">
                        <h2>Details</h2>
                        <!--Print out current project name-->
                        <label>Name: </label>
                        <input type="text" name="pName" value="<?php echo $project->proj_nm(); ?>"/> 

                        <br/>
                        <!--Print out current project description-->
                        <label>Description:  </label><textarea 
                            maxlength="200"
                            name="pDescr"><?php echo $project->proj_descr(); ?>
                        </textarea>
                    </div> <!--End of details-->
                    <div id="projDates">
                        <h2>Project Dates</h2>
                        <label>
                            Start Date: 
                        </label>
                        <input type="date" name="pStart" value="<?php echo $estimation->start_dt(); ?>">
                        <label title="The actual hours assigned to the project">
                            Actual hours: 
                        </label><input type="text" name="act_hr" value="<?php echo $estimation->act_hr(); ?>"/>
                        <label title="The date the project actually finished">
                            Actual End Date: 
                            <input type="date" name="pActEnd" value="<?php echo $estimation->act_end_dt(); ?>"/>
                        </label>
                        <label>
                            Deadline: 
                        </label><input type="date" name="pDeadline" 
                                       value="<?php echo $estimation->est_end_dt(); ?>"/>
                        <label>
                            Estimate: </label><input type="text" name="pln_hr" value="<?php echo $estimation->pln_hr(); ?>"/>                    </div> <!--End of projDates-->
                    <input type="hidden" value="<?php echo $_GET['proj_id']; ?>" name="proj_id"/>
                    <input type="button" value="Back" class="button"
                           onclick="history.go(-1);"/>
                    <input type="submit" value="Submit" class="button" id="submit"/>
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