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
            <h1>Tasks for project: </h1>
            <input type="button" id="addTask" class="button" value="Add"/>



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
                            if ($estimate !== false)
                                {
                                echo "<td>{$estimate->est_end_dt()}</td>" .
                                "<td>{$estimate->act_end_dt()}</td>";
                                } else
                                {
                                echo "<td>No estimate found!</td>" .
                                "<td>No estimate found!</td>";
                                }
                            echo "<td>task->staff-></td>" .
                            "<td>add or delete</td>" .
                            "</tr>";
                            }
                        }
                    ?>
                </table>

            </table>
            <?php include("footer.php"); ?>
    </body>
</html>
