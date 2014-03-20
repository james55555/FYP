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
                $taskStaff = $this->registry->taskStaff;
                $taskEstimation = $this->registry->taskEstimation;
                $noEstimate = "No estimate set!";
                ?>
                <h1>Task is... <?php echo $task->tsk_nm(); ?></h1>
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
                <button name="up" class=button onclick="history.go(-1);">
                </button>
            </div>
            <br/>

            <div id="taskDetails">
                <div id="heading">
                    <ul>
                        <li>Status: 
                            <?php
                            if (isset($task->tsk_status))
                                {
                                echo $task->tsk_status();
                                } else
                                {
                                echo "Not set!";
                                }
                            ?>
                        </li>
                        <li>Task Description: 
                            <?php if (isset($task->tsk_dscr))
                                {
                                echo $task->tsk_dscr();
                                }
                                else {
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
                                <li>Planned Hours: </li>
                                <li>Actual Hours: </li>
                                <?php
                                if (isset($taskEstimation->act_end_dt))
                                    {
                                    echo "<li>Actual End Date: " .
                                    $taskEstimation->act_end_dt() . "</li>";
                                    }
                                } //End of is_object if statement
                            ?>

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
