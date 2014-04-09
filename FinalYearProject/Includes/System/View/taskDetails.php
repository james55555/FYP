<?php
/*
 *  Namespace       : Include
 *  File name       : taskDetails 
 *  File extension  : php
 *  Author          : James Graham
 *  Description     : Show the tasks associated with selected project
 * 
 */
?>
<html>
    <!--DOCTYPE HTML-->
    <head>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/taskDetails.css"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="container">
            <div class="upper">
                <?php
                //Set easier to use variables throughout the view
                $project = $this->registry->project;
                $task = $this->registry->task;
                $taskStaff = $this->registry->taskStaff;
                $taskEstimation = $this->registry->taskEstimation;
                $dependencies = $this->registry->taskDependencies;
                $noEstimate = "No estimate set!";
                ?>

                <div class="upper" id="start">
                    <p>Task Start Date: 
                        <?php
                        if (isset($taskEstimation))
                            {
                            echo $taskEstimation->start_dt;
                            } else
                            {
                            echo $noEstimate;
                            }
                        ?>
                    </p>
                </div> <!--End of start date div-->
                <div class="upper" id="end">
                    <p>Task Deadline: 
                        <?php
                        if (isset($taskEstimation))
                            {
                            echo $taskEstimation->est_end_dt;
                            } else
                            {
                            echo $noEstimate;
                            }
                        ?>
                    </p>
                </div> <!--End of end date div-->
                <button id="up" 
                        onclick="javascript:location.href = '?page=Task&proj_id=\n\
                        <?php echo $project->proj_id(); ?>'">
                    <img src="Includes/CSS/img/Icons/up.png" 
                         alt="up" title="Return to task list"
                         width="20" height="20"/>
                </button>
            </div> <!--End of upper class-->

            <div id="content">
                <h1>Details for: <?php echo $task->tsk_nm(); ?></h1>
                <ul>
                    <div class="details" id="taskDetails">
                        <li><div class="infoTitle">Status: </div>
                            <div class="info">
                                <?php
                                $status = $task->tsk_status();
                                if (isset($status))
                                    {
                                    echo $status;
                                    } else
                                    {
                                    echo "Not set. 
                                    <a href=\"?page=task&action=update\"
                                    value=\"Add a status?\"/>";
                                    }
                                ?>
                            </div>
                        </li>
                        <li><div class="infoTitle">Task Description: </div>
                            <div class="info">
                                <?php
                                $descr = $task->tsk_dscr();
                                $web = $task->web_addr();
                                if (isset($descr))
                                    {
                                    echo $descr;
                                    } else
                                    {
                                    echo "No task description available.";
                                    }
                                ?>
                            </div>
                        </li>
                        <?php
                        if (isset($web) && $web !== '')
                            {
                            ?>
                            <li><div class="infoTitle">Web Address: </div>
                                <div class="info">
                                    <?php
                                    echo $web;
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                    </div> <!--End of direct task info-->

                    <div class="details" id="staff">
                        <li><div class="infoTitle">Staff associated: </div>
                            <div class="info">
                                <?php
                                if (isset($taskStaff))
                                    {
                                    echo $taskStaff->STAFF_FIRST_NM
                                    . " " . $taskStaff->STAFF_LAST_NM;
                                    } else
                                    {
                                    echo "No staff member associated with task";
                                    }
                                ?>
                            </div>
                        </li>
                    </div><!--End of staff div-->

                    <div class="details" id="estimation">
                        <?php
                        if (isset($taskEstimation))
                            {
                            ?>
                            <li><div class="infoTitle">Planned Hours: </div>
                                <div class="info">
                                    <?php
                                    $planned_hours = $taskEstimation->pln_hr;
                                    if (isset($planned_hours))
                                        {
                                        echo $planned_hours;
                                        } else
                                        {
                                        echo "Not set.";
                                        }
                                    ?>
                                </div>
                            </li>
                            <li><div class="infoTitle">Actual Hours: </div>
                                <div class="info">
                                    <?php
                                    $actual_hours = $taskEstimation->act_hr;
                                    if (isset($actual_hours))
                                        {
                                        echo $actual_hours;
                                        } else
                                        {
                                        echo "Not set.";
                                        }
                                    ?>
                                </div>
                            </li>
                            <li><div class="infoTitle">Actual End Date: </div>
                                <div class="info">
                                    <?php
                                    $actual_end_date = $taskEstimation->act_end_dt;
                                    if (isset($actual_end_date))
                                        {
                                        echo $actual_end_date;
                                        } else
                                        {
                                        echo "Not set";
                                        }
                                    } //End of isset if statement
                                ?>
                            </div> <!--End of info-->
                        </li>
                    </div> <!--End of estimation-->

                    <div class="details" id="dependencies">
                        <li><div class="infoTitle">Dependent on this task: </div>
                            <div class="info">
                                <?php
                                if (isset($dependencies))
                                    {
                                    echo "<a href=\"?page=Task&action=details&task_id=
                                        {$dependencies->DEPENDENCY_ID}\">
                                            {$dependencies->DEPENDENCY_ID}</a>";
                                    } else
                                    {
                                    echo "Not set";
                                    }
                                ?>
                            </div>
                        </li>
                    </div> <!--End of dependencies-->
                </ul>
                <div id="down">
                    <div id="actions">
                        <!--Buttons to take users to edit or delete for each project-->
                        <!--Edit button-->
                        <button type="submit" id="editT">
                            <a href="?page=edit&isProj=false&task_id=<?php echo $task->tsk_id();?>">
                                <img src="Includes/CSS/img/Icons/edit.png" 
                                     alt="edit" title="Edit Task"
                                     width="30" height="30"/>
                            </a>
                        </button>
                        <!--Delete button-->
                        <button type="submit" id="delT" onclick="return confirmAction('delete',
                                        '<?php echo $task->tsk_nm(); ?>')">
                            <a href="?page=task&action=delete&task_id=
                               <?php echo $task->tsk_id(); ?>">                                
                                <a href="?page=Task&action=delete&task_id=<?php echo $task->tsk_id();?>">
                                    <img src="Includes/CSS/img/Icons/delete.png" 
                                         alt="edit" title="Delete Task"
                                         width="30" height="30"/>
                                </a>
                        </button>    
                    </div>
                </div>
            </div> <!--End of content-->
        </div> <!--End of container-->
        <?php
        include("footer.php");
        ?>
    </body>
</html>
