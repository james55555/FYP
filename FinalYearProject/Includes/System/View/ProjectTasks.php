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
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
            <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
            <link rel="stylesheet" type="text/css" href="Includes/CSS/projectTasks.css"/>
        </head>
        <body>
            <div id="container">

                <?php
                include("header.php");
                ?>
                <div class="Proj_Details">
                    <h1 id="title">Tasks for project: <?php echo $_GET['proj_id']; ?></h1><br/>
                    <?php
                    $projEstimate = $this->registry->projectEstimation;
                    $stCheck = $projEstimate->start_dt();
                    $edCheck = $projEstimate->est_end_dt();
                    $noEstimate = "No estimate set.";
                    ?>
                    <div class="Proj_Details" id="start">
                        <p>Project Start Date: <?php
                            if (isset($stCheck))
                                {
                                echo $projEstimate->start_dt();
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
                                echo $projEstimate->est_end_dt();
                                } else
                                {
                                echo $noEstimate;
                                }
                            ?></p>
                    </div>
                    <input type="button" class="button" value="Add New"/>
                </div>
                <br/>


                <div id="tasks">
                    <table id="myTasks" class="table">
                        <tr>
                            <th>Task ID</th>
                            <th>Task Name</th>
                            <th>Task Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        if ($this->registry->project_tasks !== null)
                            {
                            foreach ($this->registry->project_tasks as $task)
                                {
                                //for every task obtain the staff member
                                $staff = Staff_Model::get($task->staff());
                                $tsk_id = $task->tsk_id();
                                echo "<tr><td>"
                                . "<a href=\"?page=task&action=details&task_id=$tsk_id\" \">"
                                . $tsk_id
                                . "</a>"
                                . "</td>" .
                                "<td>{$task->tsk_nm()}</td>" .
                                "<td>{$task->tsk_dscr()}</td>" .
                                "<td>{$task->tsk_status()}</td>";
                                ?>    
                                <td>
                                    <div id="actions">
                                        <!--Buttons to take users to edit or delete for each project-->
                                        <button type="submit" id="editT">
                                            <a href="?page=Home&action=edit(<?php $projid ?>)">
                                                <img src="Includes/CSS/img/Icons/edit.png" 
                                                     alt="edit" title="Edit Project"
                                                     width="20" height="20"/>
                                            </a>
                                        </button>

                                        <button type="submit" id="delT">                                
                                            <a href="?page=Home&action=delete(<?php $projid ?>)">
                                                <img src="Includes/CSS/img/Icons/delete.png" 
                                                     alt="edit" title="Delete Project"
                                                     width="20" height="20"/>
                                            </a>
                                        </button>    
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

                </div>
            </div>
            <?php
            include("footer.php");
            ?>
        </body>
    </html>
