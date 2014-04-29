<!DOCTYPE html>
<?php
/*
 *  Namespace       : Include
 *  File name       : Home
 *  File extension  : php
 *  Author          : James Graham
 *  Description     : Show user's home page and current task list
 *
 */
?>

<html>
    <!DOCTYPE html>
    <head>
        <script type="text/javascript" src="Includes/common/Scripts/confirmAction.js"></script>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/home.css"/>
        <title>Time Management System for Professionals - Home Page</title>

    </head>

    <body>
        <?php
        include("header.php");
        ?>`
        <div id="container">
            <div class="upper">
                <h1>My Projects</h1>
                <input type="submit" class="button" value="Add New"
                       onclick="javascript:location.href = '?page=Add&action=addProj&isProj=true'"
                       title="Add a new project"
            </div>
            <?php
            try
                {
                if (!isset($projects) || empty($projects))
                    {
                    throw new Exception("No Projects created yet<br/>"
                    . "<a href='?page=Add&action=addProj&isProj=true'>Add one?</a>");
                    }
                ?>
                <table id="myProjects" class="table">
                    <tr>
                        <th>Project Id</th>
                        <th>Project Name</th>
                        <th>Project Description</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    //print out project details project-by-project
                    foreach ($projects as $project)
                        {
                        $projid = $project->proj_id();
                        //Print out row of information foreach project object that exists for that user.
                        echo "<tr>"
                        //Make project id hyperlink redirecting user to projectDetails.php
                        . "<td><a href=\"?page=Task&proj_id=" . $projid . "\" \">"
                        . "$projid"
                        . "</a></td>"
                        //Get project name from project object
                        . "<td>{$project->proj_nm()}</td>"
                        //Get project description from project object
                        . "<td>{$project->proj_descr()}</td>";
                        ?>
                        <td>
                            <!--Buttons to take users to edit or delete for each project-->

                            <a href="?page=Edit&is_project=true&proj_id=<?php echo $projid; ?>"
                               title="Edit Task">
                                <button type="submit" id="editP" class="button imgButton">
                                    <img src="Includes/CSS/img/Icons/edit.png"
                                         alt="edit" title="Edit Project"
                                         width="20" height="20"/>
                                </button>
                            </a>
                            <a href="?page=Home&action=delete&proj_id=<?php echo $projid; ?>"
                               title="Delete task">
                                <button id="delP" class="button imgButton" onclick="return confirmAction('delete', '<?php echo $project->proj_nm(); ?>')">
                                    <img src="Includes/CSS/img/Icons/delete.png"
                                         alt="edit" title="Delete Project"
                                         width="20" height="20"/>
                                </button>
                            </a>
                        </td> <!--End of actions cell-->
                        <?php
                        //Close table row for each projct
                        echo "</tr>";
                        } //End of foreach loop
                    }//End of try
                catch (Exception $e)
                    {
                    echo $e->getMessage();
                    }
                ?>
                <!-- When foreach loop has ended, end the table-->
            </table>

        </div> <!--End of container div-->
        <?php
        include("footer.php");
        ?>
    </body>
</html>

