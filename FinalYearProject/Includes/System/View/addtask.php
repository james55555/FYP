<?php
#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: addTask
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
        <link rel="stylesheet" type="text/css" href="Includes/CSS/TaskAction.css"/>
        <title>Time Management System for Professionals - Add New Task page</title>
    </head>
    <body>
        <div id="container">
            <?php
            include("header.php");
            ?> 

            <div id="content" class="centralBox">
                <h1>Add Task</h1>
                <form id="addTask" action="?page=Add&action=addTask" 
                      method="post">
                    <div id="details" class="section">
                        <h2>Details</h2>
                        <label>Name: </label><input type="text" name="tName" placeholder="Give the task a name"/>
                        <label title="What will the task involve?">Description:  </label><textarea 
                            maxlength="200"
                            name="tDescr"
                            placeholder="Limit of 200 characters"
                            ></textarea>
                        <label title="Are the any useful websites associated?">Web Address: </label>
                        <input type="text" name="web_addr"
                               placeholder="(Optional)"/>                    
                        <label title="What stage is the project in?">Status: </label>
                        <select name="status">
                            <option>Not Started</option>
                            <option>In Progress</option>
                            <option>Finished</option>
                        </select>
                    </div> <!--End of details div-->
                    <div id="dependencies" class="section">
                        <?php
                        //only show task dependencies if their are tasks associated
                        //with the project in question
                        if (isset($projTasks))
                            {
                            echo "<h2>Choose Task Dependencies: </h2>";
                            //Set up checkbox for all tasks in the same project
                            foreach ($projTasks as $task)
                                {
                                echo $task;
                                }
                            }
                        ?>
                        <span style="clear:both;"></span>
                    </div><!--End of dependencies-->
                    <div id="estimation" class="section">
                        <h2>Task Dates</h2>
                        <p id="projDt">Dates must be between <?php
                            echo $projEst->start_dt()
                            . " and " . $projEst->est_end_dt();
                            ?></p>
                        <label title="When will the task start?">
                            Start Date: </label><input type="date" name="tStart"/>
                        <label title="When will the task end?">
                            Deadline: </label><input type="date" name="tDeadline"/>
                        <label title="How many hours will be assigned to the task?">
                            Estimated Hours: </label><input type="text" name="tPln_hr"
                                                        placeholder="Must be a whole number"
                                                        title="How many hours will you assign to complete this?"/>
                    </div>
                    <!--Optional for user-->
                    <div id="staff" class="section">
                        <h2>Associated Staff Members</h2>
                        <label>First Name: </label><input type="text" name="stFirst"/>
                        <label>Last Name: </label><input type="text" name="stLast"/>
                        <label>Phone Extension: </label><input type="tel" name="stTel"
                                                               placeholder="No more than four numbers"/>
                        <label>Email: </label><input type="email" name="stEmail"/>
                    </div> <!--End of staff-->
                    <input type="hidden" value="<?php echo $_GET['proj_id']; ?>"
                           name="proj_id"/>
                    <div id="actions" class="section">
                        <input type="button" value="Cancel" class="button" id="cancel"
                               onclick="history.go(-1);"/>
                        <input type="submit" value="Submit" class="button" id="submit"/>
                        <button type="button" class="button" id="reset">Reset</button>
                        <span style="clear:both"></span>
                    </div><!--End of actions-->
                </form>
            </div> <!--End of content-->
            <?php
            include("footer.php");
            ?>
        </div><!--End of container-->
    </body>
</html>