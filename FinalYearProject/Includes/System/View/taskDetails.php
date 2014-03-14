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
                $task = $this->registry->task;
                $taskEstimation = $this->registry->taskEstimation;
                ?>
                <h1>Task is... <?php echo $task->tsk_nm(); ?></h1>
                <div class="details" id="start">
                    <p>Task Start Date: <?php echo $taskEstimation->start_dt(); ?></p>
                </div>
                <div class="details" id="end">
                    <p>Task Deadline: <?php echo $taskEstimation->end_dt(); ?></p>
                </div>

            </div>
            <br/>

            <div id="taskDetails">
                <div id="heading">
                    <ul>
                        <li>Status: </li>
                        <li>Task Description: </li>
                        <li>Staff Member Associated: </li>
                        <div id="estimation">
                            <li>Planned Hours: </li>
                            <li>Actual Hours: </li>
                            <?php
                            if (isset($taskEstimation->act_end_dt))
                                {
                                echo "<li>Actual End Date: </li>";
                                }
                            ?>
                        </div>
                        }
                        <div id="dependencies">
                            <li>Dependant on this task: </li>
                            <li>This task is dependent on: </li>
                        </div>
                    </ul>
                </div>
            </div>

<?php include("footer.php"); ?>
    </body>
</html>
