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
    <!DOCTYPE html>
    <head>
        <script type="text/javascript" src="Includes/common/Scripts/confirmAction.js"></script>

        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/taskDetails.css"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="container">
            <div class="upper">
                <div class="upper" id="start">
                    <p>Task Start Date: 
                        <?php
                        echo $taskEstimation->start_dt();
                        ?>
                    </p>
                </div> <!--End of start date div-->
                <div class="upper" id="end">
                    <p>Task Deadline: 
                        <?php
                        echo $taskEstimation->est_end_dt();
                        ?>
                    </p>
                </div> <!--End of end date div-->
                <a href='?page=Task&proj_id=<?php echo $project->proj_id(); ?>'
                   class="button" id="up"
                   title="Return to task list for project: <?php echo $project->proj_nm(); ?>">Task List
                </a>
            </div> <!--End of upper class-->
            <div id="content" class="centralBox">
                <h1>Details for: <?php echo $task->tsk_nm(); ?></h1>
                <ul>
                    <li><div class="infoTitle">Status: </div>
                        <div class="info">
                            <?php
                            echo $task->tsk_status();
                            ?>
                        </div>
                    </li>
                    <li><div class="infoTitle">Task Description: </div>
                        <div class="info">
                            <?php
                            echo $task->tsk_descr();
                            ?>
                        </div>
                    </li>
                    <li><div class="infoTitle">Web Address: </div>
                        <div class="info">
                            <?php
                            echo $task->web_addr();
                            ?>
                        </div>
                    </li>
                    <li><div class="infoTitle">Staff associated: </div>
                        <div class="info">
                            <?php
                            echo $staff->staff_first_nm()
                            . " " . $staff->staff_last_nm();
                            ?>
                        </div>
                    </li>

                    <div class="details" id="estimation">
                        <li><div class="infoTitle">Planned Hours: </div>
                            <div class="info">
                                <?php
                                echo $taskEstimation->pln_hr();
                                ?>
                            </div>
                        </li>
                        <li><div class="infoTitle">Actual Hours: </div>
                            <div class="info">
                                <?php
                                echo $taskEstimation->act_hr();
                                ?>
                            </div>
                        </li>
                        <li><div class="infoTitle">Actual End Date: </div>
                            <div class="info">
                                <?php
                                echo $taskEstimation->act_end_dt();
                                ?>
                            </div>
                        </li>
                        <div class="details" id="dependencies">
                            <li><div class="infoTitle">Dependent on this task: </div>
                                <div class="info">
                                    <?php
                                    foreach ($dependencies as $dp_on)
                                        {
                                        echo "<br/>";
                                        echo $dp_on;
                                        }
                                    ?>
                                </div>
                            </li>
                        </div> <!--End of dependencies-->
                </ul>
                <span id="clear:both;"></span>
                <div id="actions">
                    <!--Buttons to take users to edit or delete for each project-->
                    <!--Edit button-->
                    <a href="?page=Edit&is_project=false&task_id=<?php echo $task->tsk_id(); ?>">
                        <button type="submit" id="editT" class="button">
                            <img src="Includes/CSS/img/Icons/edit.png" 
                                 alt="edit" title="Edit Task"
                                 width="30" height="30"/>
                        </button>
                    </a>
                    <!--Delete button-->
                    <a href="?page=Task&action=delete&task_id=<?php echo $task->tsk_id(); ?>">
                        <button type="submit" id="delT" class="button" onclick="return confirmAction('delete',
                                        '<?php echo $task->tsk_nm(); ?>')">                             
                            <img src="Includes/CSS/img/Icons/delete.png" 
                                 alt="edit" title="Delete Task"
                                 width="30" height="30"/>
                        </button>
                    </a>
                    <div id="iconCopyright">
                        Icons made by <a href="http://www.flaticon.com/free-icon/pencil-striped-symbol-for-interface-edit-buttons_34022" title="SimpleIcon" target="_blank">SimpleIcon</a>
                        from <a href="http://www.flaticon.com" title="Flaticon" target="_blank">www.flaticon.com</a>
                    </div>
                </div><!--End of actions-->
                <span style="clear:both;"></span>
            </div> <!--End of content-->      
            <?php
            include("footer.php");
            ?>
        </div> <!--End of container-->
    </body>
</html>
