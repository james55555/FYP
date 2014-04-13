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
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/addTask.css"/>
        <title>Time Management System for Professionals - Add New Task page</title>
    </head>
    <body>
        <?php
        include("header.php");
        ?> 
        <div id="container" class="centralBox">
            <h1>Add Task</h1>
            <form id="addTask" action="?page=Add&action=addTask" 
                  method="post" onsubmit="return taskValidation()">
                <div id="details" class="section">
                    <h2>Details</h2>
                    <label>Name: </label><input type="text" name="tName"/>
                    <label>Description:  </label><textarea 
                        maxlength="200"
                        name="tDescr"
                        placeholder="Limit of 200 characters"></textarea>
                    <label>Web Address: </label><input type="text" name="web_addr"
                                                       placeholder="(Optional)"/>                    
                    <label>Status: </label>
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
                    if (isset($this->registry->projTasks))
                        {
                        echo "<h2>Choose Task Dependencies: </h2>";
                        //Set up checkbox for all tasks in the same project
                        foreach ($this->registry->projTasks as $task)
                            {
                            echo "<label>{$task->task_nm()}</label>"
                            . "<input type=\"checkbox\" name=\"tDpnd[]\" "
                            . "value=\"{$task->tsk_id()}\"/>";
                            }
                        }
                    ?>
                </div><!--End of dependencies-->
                <div id="estimation" class="section">
                    <h2>Project Dates</h2>
                    <label title="When will the task start?">
                        Start Date: </label><input type="date" name="tStart"/>
                    <label title="When will the task end?">
                        Deadline: </label><input type="date" name="tDeadline"/>
                    <label title="How many hours will be assigned to the task?">
                        Estimate</label><input type="text" name="tPln_hr"/>
                </div>
                <!--Optional for user-->
                <div id="staff" class="section">
                    <h2>Associated Staff Members</h2>
                    <label>First Name: </label><input type="text" name="stFirst"/>
                    <label>Last Name: </label><input type="text" name="stLast"/>
                    <label>Phone Extension: </label><input type="tel" name="stTel"/>
                    <label>Email: </label><input type="text" name="stEmail"/>
                    <input type="hidden" value="<?php echo $_GET['proj_id']; ?>"
                           name="proj_id"/>
                </div> <!--End of staff-->
                <div id="actions" class="section">
                    <input type="button" value="Back" class="button"
                           onclick="history.go(-1);"/>
                    <input type="submit" value="Submit" class="button" id="newUser"/>
                    <input type="reset" value="Reset" class="button" 
                           onclick="return confirmAction('reset',
                                       'all values')"/>
                </div><!--End of actions-->
            </form>
        </div> <!--End of container-->
        <?php
        include("footer.php");
        ?>
    </body>
</html>