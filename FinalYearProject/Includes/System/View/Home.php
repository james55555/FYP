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
    <head>
        <script type ="script/javascript" src="Includes/common/Scripts/getValue.js"></script>

        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/home.css"/>
        <title>Time Management System for Professionals - Home Page</title>

    </head>

    <body>
        <?php
        include("header.php");
        ?> 
        <!--Information Body-->

        <div id="container">

            <h1>My Projects</h1>

            <button type="submit" id="addP"
                                action="?page=Home&action=delete">
                            <img src="Includes/CSS/img/Icons/addNew.png" 
                                 alt="edit" title="Delete Project"
                                 width="20" height="20"/>
            </button>
    <!--<input class="button" id="addProj" type="button" value="Add"
           onlcick="location.href='?page=addProject'"/>-->
            <table id="myProjects" class="table">
                <tr>
                    <th>Project Id</th>
                    <th>Project Name</th>
                    <th>Project Description</th>
                    <th>Action</th>
                </tr>
                <?php
                //print out project details project-by-project

                foreach ($this->registry->projects as $project)
                    {
                    $projid = ($project->proj_id());

                    echo "<!--Print out project information for each project into a table-->
                <tr>
                
                    <td><a href=\"?page=Task&proj_id=" . $projid . "\" \">
                    $projid"
                    . "</a></td>"
                    . "<td>{$project->proj_nm()}</td>
                    <td>{$project->proj_descr()}</td>";
                    ?>
                    <td>
                        <!--Buttons to prompt user with javascript edit/delete screen (see use cases)-->
                        <button type="submit" id="editP"
                                action='?page=Home&action=edit'>
                            <img src="Includes/CSS/img/Icons/edit.png" 
                                 alt="edit" title="Edit Project"
                                 width="20" height="20"/>
                        </button>

                        <button type="submit" id="delP" 
                                action="?page=Home&action=delete">
                            <img src="Includes/CSS/img/Icons/delete.png" 
                                 alt="edit" title="Delete Project"
                                 width="20" height="20"/>
                        </button>
                    </td>



                    <?php
                    echo "</tr>";
                    }
                ?>
            </table>

        </div>
        <?php
        include("footer.php");
        ?> 
    </body>
</html>

