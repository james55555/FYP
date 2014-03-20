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
                $task = $this->registry->task;
                $taskStaff = $this->registry->taskStaff;
                $taskEstimation = $this->registry->taskEstimation;
                $dependencies = $this->registry->taskDependencies;
                $noEstimate = "No estimate set!";
                ?>
                <h1>Details for: <?php echo $task->tsk_nm(); ?></h1>
                <div class="upper" id="start">
                    <p>Task Start Date: 
                        <?php
                        if (is_object($taskEstimation))
                            {
                            echo $taskEstimation->start_dt();
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
                        if (is_object($taskEstimation))
                            {
                            echo $taskEstimation->est_end_dt();
                            } else
                            {
                            echo $noEstimate;
                            }
                        ?>
                    </p>
                </div> <!--End of end date div-->
                <button name="up" type="submit" onclick="history.go(-1);">
                    <img src="Includes/CSS/img/Icons/up.png" 
                         alt="up" title="Return to task list"
                         width="20" height="20"/>
                </button>
            </div> <!--End of upper class-->

            <div id="content">
                <div class="details" id="taskDetails">
                    <ul>
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
                        <li>Task Description: 
                            <?php
                            $descr = $task->tsk_dscr();
                            $web = $task->web_addr();
                            if (isset($descr) || isset($web))
                                {
                                echo $descr . "<br/>"
                                . "Web Link: " . $web;
                                } else
                                {
                                echo "No task description available.";
                                }
                            ?>
                        </li>
                </div> <!--End of direct task info-->
                <div class="details" id="staff">
                    <li><div class="infoTitle">Staff associated: </div>
                        <div class="info">
                            <?php
                            if (is_object($taskStaff))
                                {
                                echo $taskStaff->staff_first_nm()
                                . " " . $taskStaff->staff_last_nm();
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
                    if (is_object($taskEstimation))
                        {
                        ?>
                        <li><div class="infoTitle">Planned Hours: </div>
                            <div class="info">
                                <?php
                                $planned_hours = $taskEstimation->pln_hr();
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
                                $actual_hours = $taskEstimation->act_hr();
                                if (isset($actual_hours))
                                    {
                                    echo $actual_hours;
                                    } else
                                    {
                                    echo "Not set";
                                    }
                                ?>
                            </div>
                        </li>
                        <li><div class="infoTitle">Actual End Date: </div>
                            <div class="info">
                                <?php
                                $actual_end_date = $taskEstimation->act_end_dt();
                                if (isset($actual_end_date))
                                    {
                                    echo $actual_end_date;
                                    } else
                                    {
                                    echo "Not set";
                                    }
                                } //End of is_object if statement
                            ?>
                        </div>
                    </li>
                </div>

                <div class="details" id="dependencies">
                    <li><div class="infoTitle">Dependent on this task: </div>
                        <div class="info">
                            <?php
                            if (isset($dependencies))
                                {
                                $dependency = $dependencies->dpnd_on();
                                }
                            if (isset($dependency))
                                {
                                echo $dependency;
                                } else
                                {
                                echo "Not set";
                                }
                            ?>
                        </div>
                    </li>

                </div> <!--End of dependencies-->
                </ul>
            </div> <!--End of content-->

            <?php include("footer.php"); ?>
        </div> <!--End of container-->
    </body>
</html>
