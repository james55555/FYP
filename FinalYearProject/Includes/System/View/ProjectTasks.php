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
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
            <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
            <link rel="stylesheet" type="text/css" href="Includes/CSS/projectTasks.css"/>
        </head>
        <body>
            <div id="container">

                <?php include("header.php"); ?>
                <div style="clear: both;"></div>
                <div class="Proj_Details">
                    <h1>Tasks for project: <?php echo $_GET['proj_id']; ?></h1><br/>
                    <?php $projEstimate = $this->registry->projectEstimation; ?>
                    <div class="Proj_Details" id="start">
                        <p>Project Start Date: <?php echo $projEstimate->start_dt(); ?></p><br/>
                    </div>
                    <div class="Proj_Details" id="end">
                        <p>Project Deadline: <?php echo $projEstimate->est_end_dt(); ?></p>
                    </div>
                <input type="button" class="button" value="Add New"/>
                </div>
                <br/>
                

                <div id="tasks">
                    <?php
                    if ($this->registry->project_tasks !== false)
                        {
                        foreach ($this->registry->project_tasks as $task)
                            {
                            ?> 

                            <table id="myTasks" class="table">
                                <tr>
                                    <th>Project ID</th>
                                    <th>Task ID</th>
                                    <th>Task Name</th>
                                    <th>Task Description</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                //for every task obtain it's estimate information
                                $estimate = Estimation_Model::get($task->estimation());
                                //for every task obtain the staff member
                                $staff = Staff_Model::get($task->staff());

                                echo "<td>{$task->proj_id()}</td>" .
                                "<td>{$task->tsk_id()}</td>" .
                                "<td>{$task->tsk_nm()}</td>" .
                                "<td>{$task->tsk_dscr()}</td>" .
                                "<td>{$task->tsk_status()}</td><tr/>";
                                ?>           

                                <table id="myTaskInfo" class="table"><tr>
                                        <th>Expected Finish</th>
                                        <th>Actual Finish</th>
                                        <th>Assigned to</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    echo "<tr>";
                                    if (is_object($estimate))
                                        {
                                        echo "<td>{$estimate->est_end_dt()}</td>" .
                                        "<td>{$estimate->act_end_dt()}</td>";
                                        } else
                                        {
                                        echo "<td>No estimate found!</td>" .
                                        "<td>No estimate found!</td>";
                                        }
                                    if (is_object($staff))
                                        {
                                        $staffName = $staff->staff_first_nm() .
                                                " " . $staff->staff_last_nm();

                                        echo "<td>{$staffName}</td>";
                                        } else
                                        {
                                        echo "<td>This task isn't assigned to anyone.</td>";
                                        }
                                    echo "<td>add or delete</td>" .
                                    "</tr>";
                                    }
                                } else
                                {
                                ?>
                                <p>There are no tasks assigned to this project<p/>
                                    <?php
                                    }
                                ?>
                        </table>

                    </table>
                </div>
                <?php include("footer.php"); ?>
            </div>

        </body>
    </html>
