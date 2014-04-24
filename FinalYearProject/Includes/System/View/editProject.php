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
        <!--Include jQuery library-->
        <script type="text/javascript" src="Includes/common/Scripts/jQuery_lib/jquery_v1.11.1.js"></script>
        <script type="text/javascript" src="Includes/common/Scripts/confirmAction.js"></script>
        <script type="text/javascript" src="Includes/common/Scripts/resetFields.js"></script>

        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/ProjectAction.css"/>

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
                      method="post">
                    <div id="details">
                        <h2>Details</h2>
                        <!--Print out current project name-->
                        <label>Name: </label>
                        <input type="text" name="pName" value="<?php echo $project->proj_nm(); ?>"/> 

                        <!--Print out current project description-->
                        <label>Description:  </label><textarea 
                            maxlength="200"
                            name="pDescr"
                            placeholder="Limit of 200 characters"><?php echo $project->proj_descr(); ?></textarea>
                    </div> <!--End of details-->
                    <div id="projDates">
                        <h2>Project Dates</h2>

                        <label title="When will the project start?">
                            Start Date: </label>
                        <input type="date" name="pStart" value="<?php echo $estimation->start_dt_AM(); ?>">

                        <label title="The actual hours assigned to the project">
                            Actual hours: 
                        </label><input type="text" name="act_hr" placeholder="Must be a whole number" value="<?php echo $estimation->act_hr(); ?>"/>

                        <label title="The date the project actxually finished">
                            Actual End Date: 
                        </label><input type="date" name="pActEnd" value="<?php echo $estimation->act_end_dt_AM(); ?>"/>

                        <label>
                            Deadline: 
                        </label><input type="date" name="pDeadline" 
                                       value="<?php echo $estimation->est_end_dt_AM(); ?>"/>

                        <label>
                            Estimate: 
                        </label><input type="text" name="pln_hr" placeholder="Must be a whole number" value="<?php echo $estimation->pln_hr(); ?>"/>                    
                    </div> <!--End of projDates-->
                    <div id="actions">
                        <input type="hidden" value="<?php echo $_GET['proj_id']; ?>" name="proj_id"/>
                        <input type="button" value="Cancel" class="button" id="cancel"
                               onclick="history.go(-1);"/>
                        <input type="submit" value="Submit" class="button" id="submit"/>
                        <button type="button" class="button" id="reset">Reset</button>
                        <span style="clear:both"></span>
                    </div>
                </form>    
            </div><!--End of content-->
            <?php
            include("footer.php");
            ?>
        </div><!--End of container-->
    </body>
</html>