<?php

/**
 * Description of Project_Model
 *
 * @author James
 */
class Project_Model extends Validator_Model
    {

    private
            $proj_id;
    private
            $proj_nm;
    private
            $proj_descr;
    private
            $estimate;

    /*
     * construct new project object
     */

    public
            function __construct($proj_id)
        {
        $row = $this->getProject($proj_id);
        if (!$row)
            {
            $row = null;
            }
        $this->proj_id = $row->proj_id;
        $this->proj_nm = $row->proj_nm;
        $this->proj_descr = $row->proj_descr;
        $this->estimate = ProjectEstimation_Model::getEstimationId($row->proj_id);
        }

    public
            function proj_id()
        {
        return $this->proj_id;
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

    public function estimation()
        {
        return $this->estimate;
        }

    /*
     * Function to get a project given its id.
     * @param integer proj_id
     * @return object project
     */

    public static
            function getProject($proj_id)
        {
        $fields = array("proj_id","proj_nm","proj_descr");
        $project = Database_Queries::selectFrom("Project_Model", $fields, "PROJECT", "proj_id", $proj_id);
        return $project;
        }

    public static
            function getAllUserProj($acc_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT PR.proj_id, PR.proj_nm, PR.proj_descr"
                . " FROM PROJECT PR"
                . " WHERE PR.proj_id IN"
                . " (SELECT PROJ_ID FROM USER_PROJECT UP"
                . " WHERE UP.user_id='" . $acc_id . "')";

        $result = mysql_query($query) or die("error: " . mysql_error());

        $projects = array();
        while ($row = mysql_fetch_object($result))
            {
            array_push($projects, new Project_Model($row->proj_id));
            }
        $db->close();
        return $projects;
        }

    public static function deleteProject($proj_id)
        {
        $db = new Database();
        $db->connect();
        //Archive project
        $proj_id = trim($proj_id);

        $archiveQuery = "START TRANSACTION;"
                //Archive project - initial project
                . " INSERT INTO archive.project"
                . " (SELECT proj_id,"
                . " proj_nm,"
                . " proj_descr,"
                . " null"
                . " FROM fyp.project"
                . " WHERE proj_id='" . $proj_id . "');"
                //Archive user reference to project
                . " INSERT INTO archive.user_project"
                . " (SELECT user_id,"
                . " proj_id,"
                . " null"
                . " FROM fyp.user_project"
                . " WHERE proj_id='" . $proj_id . "');"
                . " COMMIT;";
        $archiveResult = mysql_query($archiveQuery);
        if (!$db->querySuccess($archiveResult))
            {
            return false;
            }
        $project = self::getProject($proj_id);

        //Delete project from base table - PROJECT
        $projectDelete = Database_Queries::deleteFrom("PROJECT", "proj_id", $proj_id, null);
        //Disassociate project reference to user in USER_PROJECT
        $user_projectDelete = Database_Queries::deleteFrom("USER_PROJECT", "proj_id", $proj_id, null);
        if ($projectDelete && $user_projectDelete)
            {
            
            }
        $estimation = Estimation_Model::delete($project->estimation());
        if ($estimation)
            {
            $estRef = ProjectEstimation_Model::delete($project->estimation());
            }
        if (!$estRef)
            {
            return false;
            }
        //Delete from reference table between PROJECT and ESTIMATION
        elseif (isset($estRef) && $estRef)
            {
            //Loop through all tasks associated with the project and remove each one
            $deleteTask = Task_Model::getAllTasks($proj_id);
            if (!$deleteTask)
                {
                return false;
                }
            foreach ($deleteTask as $delete)
                {
                $taskResult = Task_Model::deleteTask($delete->tsk_id());
                if (!$taskResult)
                    {
                    return false;
                    }
                }
            $del = true;
            $db->close();
            return $del;
            }
        }

    public static function addProject($fields)
        {

        $db = new Database();
        $db->connect();
        $db->filterParameters($fields);
//This will be a multi-dimensional array due to the checkbox field.
        $proj_nm = $fields['pName'];
        $htmlDescr = $fields['pDescr'];
        $proj_descr = Validator_Model::htmlChar($htmlDescr);

        $arrayError = array(
//Project name validation
//String length needs to be between 1 and 30
            array(Validator_Model::variableCheck($proj_nm, 'string', 30)),
            //Project description validation
//string length needs to be between 1 and 200
            array(Validator_Model::variableCheck($proj_descr, 'string', 200)),
                //Project start date errors
//Project deadline date errors
        );


        if (sizeof($arrayError) === 0)
            {
            $projInsert = "START TRANSACTION;"
                    //Insert into project table
                    . "INSERT INTO  `fyp`.`project` ("
                    . " `proj_id` ,"
                    . " `proj_nm` ,"
                    . " `proj_descr`"
                    . ") VALUES ("
                    . "NULL,"
                    . " '" . $proj_nm . "',"
                    . " '" . $proj_descr . "');"
                    //Insert new project into user_project table
                    . " INSERT INTO `fyp`.`user_project` ("
                    . " `proj_id` , "
                    . " `user_id`)"
                    . " VALUES ("
                    . " LAST_INSERT_ID(),"
                    . " `" . $_SESSION['user']->userId() . "`);"
                    . "COMMIT;"
            ;

            $result = mysql_query($projInsert);
            if (!$db->querySuccess($result))
                {
                echo "Error inserting data into database."
                . "MYSQL Error: " . mysql_error();
                }
            }
        }

    }
