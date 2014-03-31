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
            <div id="addTaskForm">
                <form id="adddTask" action="?page=Add&action=addTask" 
                      method="post" onsubmit="return projectValidation()">
                    <label>Name: <input type="text" name="tName"/></label><br/>
                    <label>Description:  <textarea 
                            form="Task"
                            rows="4"
                            coles="50"
                            maxlength="200"
                            name="tDescr"></textarea></label><br/>
                    <label>Choose any Task Dependencies: </label>
                    <?php
                    foreach ($this->registry->user_tasks as $task)
                        {

                        echo "<label><input type=\"checkbox\" name=\"pDpnd\" "
                        . "id=\"{$task->tsk_id()}\"/>{$task->task_nm()}/></label><br/>";
                        }
                    ?>
                    <br>
                    <h2>Project Dates</h2>
                    <label>Start Date: <input type="date" name="pStart"/></label>
                    <label>Deadline: <input type="date" name="pDeadline"/></label>
                    <br>

                    <input type="submit" value="Submit" class="button" id="newUser"/>

                </form>
            </div><!--end of form-->
        </div>
<?php
include("footer.php");
?>
</body>
</html>