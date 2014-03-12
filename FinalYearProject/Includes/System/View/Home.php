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

        <!--Information Body-->

        <div id="container">
            <?php
            include("header.php");
            ?>`
            <h1>My Projects</h1>
            <!--Image button to represent add new project-->
            <button type="image" id="addP"
                    action="?page=Home&action=add">
                <img src="Includes/CSS/img/Icons/addNew.png" 
                                     alt="add new" title="Add New Project"
                                     width="20" height="20"/>
            </button>

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
                        <!--Buttons to take users to edit or delete for each project-->
                        <button type="submit" id="editP">
                            <a href="?page=Home&action=edit(<?php $projid ?>)">
                                <img src="Includes/CSS/img/Icons/edit.png" 
                                     alt="edit" title="Edit Project"
                                     width="20" height="20"/>
                            </a>
                        </button>

                        <button type="submit" id="delP">                                
                            <a href="?page=Home&action=delete(<?php $projid ?>)">
                                <img src="Includes/CSS/img/Icons/delete.png" 
                                     alt="edit" title="Delete Project"
                                     width="20" height="20"/>
                            </a>
                        </button>                    
                    </td>



                    <?php
                    echo "</tr>";
                    }
                ?>
            </table>
            <?php
            include("footer.php");
            ?> 
        </div>

    </body>
</html>

