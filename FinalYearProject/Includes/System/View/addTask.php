<?php
#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: addTask
#@author: James
?>
<html>
    <head>
        <script type="text/javascript" src="Includes/common/Scripts/Validation.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/register.css"/>
        <title>Time Management System for Professionals - Add New Task page</title>
    </head>
    <body>
        <div id="container">
            <?php
            include("header.php");
            ?> 
            <h1>Add Project</h1>
            <form id="addTask" action="?page=Add&action=addTask" 
                      method="post" onsubmit="return taskValidation()">
            <div id="details">
                <h2>Details</h2>
                    <label>Name: </label><input type="text" name="tName"/><br/>
                    <label>Description:  </label><textarea 
                        maxlength="200"
                        name="tDescr"
                        placeholder="Limit of 200 characters"></textarea>
            </div> <!--End of details div-->
            <div id="dependencies">
                    <?php
                    //only show task dependencies if their are tasks associated
                    //with the project in question
                    if (isset($this->registry->projTasks))
                        {
                        echo "<label>Choose any Task Dependencies: </label>";
                       //Set up checkbox for all tasks in the same project
                        foreach ($this->registry->projTasks as $task)
                            {
                            echo "<label>{$task->task_nm()}</label>"
                            . "<input type=\"checkbox\" name=\"tDpnd\" "
                            . "id=\"{$task->tsk_id()}\"/>";
                            }
                        }
                    ?>
            </div><!--End of dendendencies-->
            <div id="estimation">
                    <h2>Project Dates</h2>
                    <label title="When will the task start?">
                        Start Date: </label><input type="date" name="pStart"/>
                    <label title="When will the task end?">
                        Deadline: </label><input type="date" name="pDeadline"/>
                    <label title="How many hours will be assigned to the task?">
                        Estimate</label><input type="text" name="pln_hr"/>
            </div>
            <!--Optional for user-->
            <div id="staff">
                <h2>Associated Staff Members</h2>
                <label>First Name: </label><input type="text" name="stF_nm"/>
                <label>Last Name: </label><input type="text" name="stL_nm"/>
                <label>Phone number: </label><input type="tel" name="stTel"/>
                <label>Email: </label><input type="text" name="stEmail"/>
            </div> <!--End of staff-->
            
                    <input type="submit" value="Submit" class="button" id="newUser"/>

                </form>
        </div> <!--End of container-->
        <?php
        include("footer.php");
        ?>
    </body>
</html>