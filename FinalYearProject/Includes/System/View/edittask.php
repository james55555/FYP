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
        <title>Time Management System for Professionals - Edit Task page</title>
    </head>
    <body>
        <div id="container">
            <?php
            include("header.php");
            ?> 
            <div id="content" class="centralBox">
                <h1>Edit Task - <?php echo $task->tsk_nm(); ?></h1>
                <form id="addTask" action="?page=Edit&action=editTask" 
                      method="post">
                    <div id="details" class="section">
                        <h2>Details</h2>
                        <label>Name: </label><input type="text" name="tName" value="<?php echo $task->tsk_nm(); ?>"/>
                        <label>Description:  </label><textarea 
                            maxlength="200"
                            name="tDescr"><?php echo $task->tsk_descr(); ?></textarea>
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
                        //only show task dependencies if there are tasks associated
                        //with the project in question
                        if (isset($projTasks))
                            {
                            echo "<h2>Choose Task Dependencies: </h2>";
                            //Set up checkbox for all tasks in the same project
                            foreach ($projTasks as $dpdTask)
                                {
                                $dpnt = $dependencies->dpnd_on();
                                try
                                    {
                                    $chckBoxStr = "<label id=\"dpndNm\">{$task->tsk_nm()}</label>"
                                            . "<input type=\"checkbox\" name=\"tDpnd[]\" "
                                            . "value=\"{$task->tsk_id()}\"";
                                    if (is_array($dpnt))
                                        {
                                        throw new Exception($chckBoxStr);
                                        }
                                    if ($dpnt === $dpdTask->tsk_id())
                                        {
                                        $selected = " checked/>";
                                        } else
                                        {
                                        $selected = "/>";
                                        }
                                    echo $chckBoxStr . $selected;
                                    } catch (Exception $e)
                                    {
                                    foreach ($dpnt as $id)
                                        {
                                        if ($id === $dpdTask->tsk_id())
                                            {
                                            $selected = "checked/>";
                                            } else
                                            {
                                            $selected = "/>";
                                            }
                                        echo $chckBoxStr . $selected;
                                        }
                                    }
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
                            Start Date: </label><input type="date" name="tStart" value="<?php echo $estimation->start_dt_AM(); ?>"/>
                        <label title="When did the task end?">
                            Actual End date: </label><input type="date" name="tActEnd" value="<?php echo $estimation->act_end_dt_AM(); ?>"/>
                        <label title="When will the task end?">
                            Deadline: </label><input type="date" name="tDeadline" value="<?php echo $estimation->est_end_dt_AM(); ?>"/>
                        <label title="How many hours were assigned to the project?">
                            Actual Hours: </label><input type="text" name="tAct_hr" value="<?php echo $estimation->act_hr(); ?>"/>
                        <label title="How many hours will be assigned to the task?">
                            Estimate</label><input type="text" name="tPln_hr" value="<?php echo $estimation->pln_hr(); ?>"/>
                    </div>
                    <!--Optional for user-->
                    <?php
                    //Localise variable
                    ?>
                    <div id="staff" class="section">
                        <h2>Associated Staff Members</h2>
                        <label>First Name: </label><input type="text" name="stFirst" value="<?php echo $staff->staff_first_nm(); ?>"/>
                        <label>Last Name: </label><input type="text" name="stLast" value="<?php echo $staff->staff_last_nm(); ?>"/>
                        <label>Phone Extension: </label><input type="tel" name="stTel" value="<?php echo $staff->staff_phone(); ?>"/>
                        <label>Email: </label><input type="text" name="stEmail" value="<?php echo $staff->staff_email(); ?>"/>
                    </div> <!--End of staff-->
                    <input type="hidden" value="<?php echo $task->proj_id(); ?>"
                           name="proj_id"/>
                    <input type="hidden" value="<?php echo $task->tsk_id(); ?>" 
                           name="task_id"/>
                    <input type="hidden" value="<?php echo $estimation->est_id(); ?>" 
                           name="est_id"/>
                    <input type="hidden" value="<?php echo $staff->staff_id(); ?>" 
                           name="staff_id"/>
                    <div id="actions" class="section">
                        <input type="button" value="Cancel" class="button" id="cancel"
                               onclick="history.go(-1);"/>
                        <input type="submit" value="Submit" class="button" id="submit"/>
                        <button type="button" class="button" id="reset">Reset</button>
                        <span style="clear:both;"></span>
                    </div><!--End of actions-->
                </form>  
            </div> <!--End of content-->
            <?php
            include("footer.php");
            ?>
        </div><!--End of container-->
    </body>
</html>