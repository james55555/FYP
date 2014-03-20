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
            <div class="details">
                <?php
                //Set easier to use variables throughout the view
                $task = $this->registry->task;
                echo "vardump tasks: " .var_dump($task);
                $taskStaff = $this->registry->taskStaff;
                $taskEstimation = $this->registry->taskEstimation;
                $noEstimate = "No estimate set!";
                ?>
                <h1>Details for: <?php echo $task->tsk_nm(); ?></h1>
                <div class="details" id="start">
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
                </div>
                <div class="details" id="end">
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
                </div>
                <button name="up" type="submit" onclick="history.go(-1);">
                    <img src="Includes/CSS/img/Icons/up.png" 
                         alt="up" title="Return to task list"
                         width="20" height="20"/>
                </button>
            </div>
            <br/>

            <div id="taskDetails">
                <div id="heading">
                    <ul>
                        <li>Status: 
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
                        </li>
                        <li>Task Description: 
                            <?php
                            $descr  = $task->tsk_dscr();
                            $web    = $task->web_addr();
                            if (isset($descr) || isset($web))
                                {
                                echo $task->tsk_dscr() . "<br/>"
                                        . "Web Link: " . $task->web_addr();
                                } else
                                {
                                echo "No task description available.";
                                }
                            ?>
                        </li>
                        <li>Staff associated: 
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
                        </li>
                        <?php
                        if (is_object($taskEstimation))
                            {
                            ?>
                            <div id="estimation">
                                <li>Planned Hours: 
                                    <?php
                                    if (isset($taskEstimation->pln_hr))
                                        {
                                        echo $taskEstimation->pln_hr();
                                        } else
                                        {
                                        echo "Not set.";
                                        }
                                    ?>
                                </li>
                                <li>Actual Hours: 
                                    <?php
                                    if (isset($taskEstimation->act_hr))
                                        {
                                        echo $taskEstimation->act_hr();
                                        } else
                                        {
                                        echo "Not set";
                                        }
                                    ?>
                                </li>
                                <li>Actual End Date:
                                    <?php
                                    if (isset($taskEstimation->act_end_dt))
                                        {
                                        echo $taskEstimation->act_end_dt();
                                        } else
                                        {
                                        echo "Not set yet";
                                        }
                                    } //End of is_object if statement
                                ?>
                            </li>
                        </div>

                        <div id="dependencies">
                            <li>Dependent on this task: </li>
                            <li>This task is dependent on: </li>
                        </div>
                    </ul>
                </div>
            </div>

<?php include("footer.php"); ?>
    </body>
</html>
