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
                            echo $taskEstimation->end_dt();
                            } else
                            {
                            echo $noEstimate;
                            }
                        ?>
                    </p>
                </div>
                <input type="button"
            </div>
            <br/>

            <div id="taskDetails">
                <div id="heading">
                    <ul>
                        <li>Status: </li>
                        <li>Task Description: </li>
                        <li>Staff Member Associated: $</li>
                        <?php
                        if (is_object($taskEstimation))
                            {
                            ?>
                            }
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
<?php } ?>
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
