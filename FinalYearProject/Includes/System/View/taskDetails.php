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
        <link rel="stylesheet" type="text/css" href="Includes/CSS/home.css"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="container">
            <h1>Project is... **<?php echo "**" . htmlentities($_GET['proj_id']) . "**";?>**</h1>
            <input type="button" id="addTask" class="button" value="Add"/>
            <table id="myTasks" class="table">
                <tr>
                    <th>Project ID</th>
                    <th>Task ID</th>
                    <th>Task Name</th>
                    <th>Task Description</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <?php
                    if ($this->registry->project_tasks !== false)
                        {
                        foreach ($this->registry->project_tasks as $task)
                            {
                            //Issue with status

                            echo "<td>{$task->proj_id()}</td>" .
                            "<td>{$task->tsk_id()}</td>" .
                            "<td>{$task->tsk_nm()}</td>" .
                            "<td>{$task->tsk_dscr()}</td>" .
                            "<td>{$task->tsk_status()}</td><tr/>";
                            //temp
                            }
                        }
                    ?>           

            </table>
            <table id="myTaskTimes" class="table"><tr>
                    <th>Expected Finish</th>
                    <th>Actual Finish</th>
                    <th>Assigned to</th>
                    <th>Action</th>
                </tr>


            </table>
            <?php include("footer.php"); ?>
    </body>
</html>
