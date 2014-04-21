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
        <link rel="stylesheet" type="text/css" href="Includes/CSS/TaskAction.css"/>
        <title>Time Management System for Professionals - Add New Task page</title>
    </head>
    <body>
        <?php
        $task = $this->registry->task;
        
        include("header.php");
        ?> 
        <div id="container" class="centralBox">
            <h1>Edit Task</h1>
            <form id="addTask" action="?page=Edit&action=editTask" 
                  method="post" onsubmit="return taskValidation()">
                <div id="details" class="section">
                    <h2>Details</h2>
                    <label>Name: </label><input type="text" name="tName" value="<?php echo $task->tsk_nm(); ?>"/>
                    <label>Description:  </label><textarea 
                        maxlength="200"
                        name="tDescr"><?php echo $task->tsk_dscr(); ?></textarea>
                    <label>Web Address: </label><input type="text" name="web_addr"
                                                       value="<?php echo $task->web_addr(); ?>"/>                    
                    <label>Status: </label>
                    <select name="status">
                        <?php
                        //Set option to default selected status of the task
                        $options = array('Not Started', 'In Progress', 'Finished');
                        foreach ($options as $option)
                            {
                            if ($option === $task->tsk_status())
                                {
                                echo "<option selected=\"selected\">{$option}</option>";
                                } else
                                {
                                echo "<option>{$option}</option>";
                                }
                            }
                        ?>
                    </select>
                </div> <!--End of details div-->
                <div id="dependencies" class="section">
                    <?php
                    //only show task dependencies if their are tasks associated
                    //with the project in question
                    if (isset($this->registry->dependencies))
                        {
                        echo "<h2>Choose Task Dependencies: </h2>";
                        //Set up checkbox for all tasks in the same project
                        foreach ($this->registry->dependencies as $dpnd)
                            {
                            //This identifies this is an existing dependency or not
                            if ($dpnd === $task->dpnd())
                                {
                                $checked = " checked";
                                } else
                                {
                                $checked = "";
                                }
                            //This doesn't work. Logic needs to be reworked regarding dependencies.
                            echo "<label>{$task->task_nm()}</label>"
                            . "<input type=\"checkbox\" name=\"tDpnd[]\" "
                            . "value=\"{$task->tsk_id()}\"{$checked}/>";
                            }
                        }
                        $estimation = $this->registry->estimation;
                    ?>
                </div><!--End of dependencies-->
                <div id="estimation" class="section">
                    <h2>Project Dates</h2>
                    <label title="When will the task start?">
                        Start Date: </label><input type="date" name="tStart" value="<?php echo $estimation->start_dt(); ?>"/>
                    <label title="When did the task end?">
                        Actual End date: </label><input type="date" name="tActEnd" value="<?php echo $estimation->act_end_dt(); ?>"/>
                    <label title="When will the task end?">
                        Deadline: </label><input type="date" name="tDeadline" value="<?php echo $estimation->est_end_dt(); ?>"/>
                    <label title="How many hours were assigned to the project?">
                        Actual Hours: </label><input type="text" name="tAct_hr" value="<?php echo $estimation->act_hr(); ?>"/>
                    <label title="How many hours will be assigned to the task?">
                        Estimate</label><input type="text" name="tPln_hr" value="<?php echo $estimation->pln_hr(); ?>"/>
                </div>
                <!--Optional for user-->
                <?php
                //Localise variable
                $staff = $this->registry->staff;
                
                ?>
                <div id="staff" class="section">
                    <h2>Associated Staff Members</h2>
                    <label>First Name: </label><input type="text" name="stFirst" value="<?php echo $staff->staff_first_nm(); ?>"/>
                    <label>Last Name: </label><input type="text" name="stLast" value="<?php echo $staff->staff_last_nm(); ?>"/>
                    <label>Phone Extension: </label><input type="tel" name="stTel" value="<?php echo $staff->staff_phone(); ?>"/>
                    <label>Email: </label><input type="text" name="stEmail" value="<?php echo $staff->staff_email(); ?>"/>
                    <input type="hidden" value="<?php echo $task->proj_id(); ?>"
                           name="proj_id"/>
                    <input type="hidden" value="<?php echo $task->tsk_id(); ?>" 
                           name="task_id"/>
                    <input type="hidden" value="<?php echo $estimation->est_id(); ?>" 
                           name="est_id"/>
                    <input type="hidden" value="<?php echo $staff->staff_id(); ?>" 
                           name="staff_id"/>
                </div> <!--End of staff-->

                <div id="actions" class="section">
                    <input type="button" value="Cancel" class="button"
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