<?php

/**
 * Description of Project_Model
 *
 * @author James
 */
class Project_Model
    {

    private
            $proj_id;
    private
            $acc_id;
    private
            $proj_nm;
    private
            $proj_descr;

    /*
     * construct new project object
     */

    public
            function __construct($row)
        {
        $this->acc_id = Account_Model::getUser($row->acc_id);
        $this->proj_id = $row->proj_id;
        $this->proj_nm = $row->proj_nm;
        $this->proj_descr = $row->proj_descr;
        }

    public
            function proj_id()
        {
        return $this->proj_id;
        }

    public
            function acc_id()
        {
        return $this->acc_id;
        }

    public
            function proj_nm()
        {
        return $this->proj_nm;
        }

    public
            function proj_descr()
        {
        return $this->proj_descr;
        }

    /*
     * Function to get a project given its id.
     * @param integer proj_id
     * @return object project
     */

    public static
            function getProject($proj_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT DISTINCT * FROM project WHERE proj_id='$proj_id'";

        if ($db->querySuccess($query))
            {
            $qResult = mysql_query($query);
            $row = mysql_fetch_object($qResult);
            $project = new Project_Model($row);
            // var_dump('vardump db:' .$db);
            /* @var $result type */
            }
        else
            {
            var_dump($project);
            die("object is false");
            }
        $db->close();
        return $project;
        }

    public static
            function getAllUserProj($acc_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT * FROM project
                WHERE acc_id='" . $acc_id . "'";

        $result = mysql_query($query) or die("error: " . mysql_error());

        $projects = array();
        while ($row = mysql_fetch_object($result))
            {
            array_push($projects, new Project_Model($row));
            }
        $db->close();
        return $projects;
        }

    public static function deleteProject($proj_id)
        {
        $db = new Database();
        $db->connect();
        //Archive project 
        $archiveQuery = "INSERT INTO archived_project "
                . "SELECT * FROM projects "
                . "WHERE proj_id='" . $proj_id . "'";
        $archiveResult = mysql_query($archiveQuery);


        //Delete project from projects
        $query = "DELETE FROM projects where proj_id='" . $proj_id . "'";
        $result = mysql_query($query);

        if ($db->querySuccess($archiveResult) && $db->querySuccess($result))
            {
            $del = true;
            }
        else
            {
            $del = false;
            }
        $db->close();
        return $del;
        }

    public static function addProject($fields)
        {
        $db = new Database();
        $db->connect();

        $errors = array();
        //validation
        //Check if the user session is active
        if (empty($fields['acc_id']))
            {
            $errors[] = 'Need to be signed in to create project!';
            }
//Get project name and validate it for insert
        $project_name = $fields['proj_nm'];
        if (!isset($project_name))
            {
            $errors[] = "Project Name needs to be filled in";
            }
        if (strlen($project_name) > 30)
            {
            $errors[] = "Check Project Name length! It can't be longer than 30 characters.";
            }
            
            $project_description = htmlspecialchars($fields['proj_descr']);
            if (strlen($project_description > 200)){
                $errors[] = "Description can't be long than 200 characters!";
                }
                //Need to resolve acc_id issue in mysql
                $query = "INSERT INTO PROJECT VALUES("
                        . "'". $_SESSION['user']->userId() . "'"
                        . ", null,"
                        . "'" . $project_name . "',"
                        . "'" . $project_description . "')";
        }

    }
