<?php
/*
 *  Namespace       : Include
 *  File name       : ProjectTasks 
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
            <link rel="stylesheet" type="text/css" href="Includes/CSS/projectTasks.css"/>
        </head>
        <body>
            <?php
            include("header.php");
            ?>
            <div id="container">
                <div class="Proj_Details">
                    <?php $proj_id = $_GET['proj_id']; ?>
                    <h1 id="title">Tasks for project: <?php echo $proj_id ?></h1><br/>
                    <?php
                    $noEstimate = "No estimate set.";
                        $stCheck = $projectEstimation->start_dt();
                        $edCheck = $projectEstimation->est_end_dt();
                    ?>
                    <div class="Proj_Details" id="start">
                        <p>Project Start Date: <?php
                            if (isset($stCheck))
                                {
                                echo $stCheck;
                                } else
                                {
                                echo $noEstimate;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="Proj_Details" id="end">
                        <p>Project Deadline: <?php
                            if (isset($edCheck))
                                {
                                echo $edCheck;
                                } else
                                {
                                echo $noEstimate;
                                }
                            ?></p>
                    </div>
                    <!--Image button to represent add new project-->
                    <input type="submit" class="button" value="Add New"
                           onclick="javascript:location.href =
                                           '?page=Add&isProj=false&proj_id=<?php echo $proj_id; ?>'"/>
                </div>
                <br/>
                <div id="tasks">
                    <?php
                    if (isset($project_tasks))
                        {
                        $tasks = $project_tasks;
                        ?>
                        <table id="myTasks" class="table">
                            <tr>
                                <th>Task ID</th>
                                <th>Task Name</th>
                                <th>Task Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            foreach ($tasks as $task)
                                {
                                if (is_string($task))
                                    {
                                    $task_id = $task;
                                    } elseif (is_object($task))
                                    {
                                    //Check if the object is a Task_Model or StdClass
                                    if (is_a($task, "Task_Model"))
                                        {
                                        $task_id = $task->tsk_id();
                                        } else
                                        {
                                        $task_id = $task->TSK_ID;
                                        }
                                    } elseif (is_array($task))
                                    {
                                    $task_id = $task['tsk_id'];
                                    }
                                $task = new Task_Model($task_id);

                                //for every task obtain the staff member
                                $staff = Staff_Model::get($task->staff());
                                $tsk_id = $task->tsk_id();
                                echo "<tr><td>"
                                . "<a href=\"?page=task&action=details&task_id=$tsk_id\" \">"
                                . $tsk_id
                                . "</a>"
                                . "</td>" .
                                "<td>{$task->tsk_nm()}</td>" .
                                "<td>{$task->tsk_descr()}</td>" .
                                "<td>{$task->tsk_status()}</td>";
                                ?>    
                                <td>
                                    <div id="actions">
                                        <!--Buttons to take users to edit or delete for each project-->
                                        <a href="?page=edit&proj_id=<?php echo $proj_id; ?>&task_id=<?php echo $task->tsk_id(); ?>">
                                            <button type="submit" id="editT" class="button imgButton">
                                                <img src="Includes/CSS/img/Icons/edit.png" 
                                                     alt="edit" title="Edit Task"
                                                     width="20" height="20"/>
                                            </button>
                                        </a>
                                        <a href="?page=Task&action=delete&task_id=<?php echo $task->tsk_id() ?>">
                                            <button type="submit" id="delT" class="button imgButton" onclick="return confirmAction('delete',
                                                                    '<?php echo $task->tsk_nm(); ?>')">                              
                                                <img src="Includes/CSS/img/Icons/delete.png" 
                                                     alt="edit" title="Delete Task"
                                                     width="20" height="20"/>
                                            </button>    
                                        </a>
                                    </div>
                                </td>
                                </tr>
                                <?php
                                }
                            } else
                            {
                            ?>
                            <p>There are no tasks assigned to this project<p/>
                                <?php
                                }
                            ?>
                    </table><br/>

                </div><!--End of content-->
                <?php
                include("footer.php");
                ?>
            </div><!--End of container-->

        </body>
    </html>
