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
    <!--DOCTYPE HTML-->
    <head>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>

        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/home.css"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="container">
            <div id="title">
            <h1>Tasks for project: <?php echo $_GET['proj_id'];?></h1><br/>
            <?php $projEstimate = $this->registry->projectEstimation;?>
            <p>Project Start Date: <?php echo $projEstimate->start_dt();?></p><br/>
            <p>Project Deadline: <?php echo $projEstimate->est_end_dt();?></p>
            </div>
            <br/>
            <input type="button" id="addTask" class="button" value="Add"/>
            
            <div class="details" id="task">
            <?php
            if (is_object($this->registry->project_tasks))
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

                        <table id="myTaskTimes" class="table"><tr>
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
                                echo "<td>This task isn't assigned to anyone.'</td>";
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
    </body>
</html>
