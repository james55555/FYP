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
        $fields = array("proj_id", "proj_nm", "proj_descr");
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

        //Set up archive query insert
        $archiveProj = "INSERT INTO archive.project"
                . " (SELECT proj_id,"
                . " proj_nm,"
                . " proj_descr,"
                . " null"
                . " FROM fyp.project"
                . " WHERE proj_id='" . $proj_id . "');";

        $archiveProj_result = mysql_query($archiveProj);
        $projExist = Database_Queries::selectFrom(null, "COUNT(*)", "PROJECT", "PROJ_ID", $proj_id);

        //Archive user reference to project **ERROR
        $archiveUser_Proj = "INSERT INTO archive.user_project"
                . " (SELECT user_id,"
                . " proj_id,"
                . " null"
                . " FROM fyp.user_project"
                . " WHERE proj_id='" . $proj_id . "');";
        //Get query results
        $archiveUser_Proj_result = mysql_query($archiveUser_Proj);
        $user_projExist = Database_Queries::selectFrom(null, "COUNT(*)", "USER_PROJECT", "PROJ_ID", $proj_id);

//Start transaction to archive data
        mysql_query("START TRANSACTION;");
//Error handling to check if the project has already been archived
        if ($archiveProj_result && mysql_num_rows($projExist) !== 1)
            {
            mysql_query("SAVEPOINT proj_insert;");
            if ($archiveUser_Proj_result && mysql_num_rows($user_projExist !== 1))
                {
                mysql_query("COMMIT;");
                } else
                {
                mysql_query("ROLLBACK TO proj_insert;");
                }
            } else
            {
            mysql_query("ROLLBACK;");
            echo "query rolled back";
            }

        $project = self::getProject($proj_id);

        //Delete project from base table - PROJECT
        $projectDelete = Database_Queries::deleteFrom("PROJECT", "proj_id", $proj_id, null);
        //Disassociate project reference to user in USER_PROJECT
        $user_projectDelete = Database_Queries::deleteFrom("USER_PROJECT", "proj_id", $proj_id, null);
        if ($projectDelete && $user_projectDelete)
            {
            $estimation = Estimation_Model::delete($project->estimation);
            }
        if (!isset($estimation))
            {
            return false;
            }
        if ($estimation)
            {
            $estRef = ProjectEstimation_Model::delete($project->estimation);
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
            }

        $db->close();
        return $del;
        }

    public static function addProject($fields)
        {

        $db = new Database();
        $db->connect();
        $fields = $db->filterParameters($fields);
        //This will be a multi-dimensional array due to the checkbox field.
        $proj_nm = $fields['pName'];
        $proj_descr = $fields['pDescr'];
        //GET estimation vairables
        $proj_start = $fields['pStart'];
        $proj_deadline = $fields['pDead'];
        $pln_hr = $fields['pln_hr'];
        //GET user who is adding project
        $account = $_SESSION['user'];


        $valid = Project_Model::validateArray($fields);
        if (is_array($valid) || is_string($valid))
            {
            return $valid;
            }
        //Start the transaction
        mysql_query("START TRANSACTION;");
        //Set insert into PROJECT String
        $proj_insert = "INSERT INTO PROJECT ("
                . " proj_id,"
                . " proj_nm,"
                . " proj_descr"
                . ") VALUES ("
                . "NULL,"
                . " '" . $proj_nm . "',"
                . " '" . $proj_descr . "'); ";
        //Run the query and get the project id
        $project_result = mysql_query($proj_insert);
        $proj_insert_id = $db->getInsertId();
        //Set insert into USER_PROJECT
        $userProj_insert = "INSERT INTO USER_PROJECT ("
                . " user_id, "
                . " proj_id)"
                . " VALUES ("
                . " '" . $account->user_id . "',"
                . " '" . $proj_insert_id . "');";
        //Run query
        $userProject_result = mysql_query($userProj_insert);
        //Set insert into ESTIMATION
        $estimation_insert = "INSERT INTO ESTIMATION ("
                . "EST_ID, "
                . "ACT_HR, "
                . "PLN_HR, "
                . "START_DT, "
                . "ACT_END_DT, "
                . "EST_END_DT) "
                . "VALUES( "
                . "NULL, "
                . "NULL, "
                . "'" . $pln_hr . "', "
                . "'" . $proj_start . "', "
                . "NULL, "
                . "'" . $proj_deadline . "');";
        //Run query and get estimation id.
        $estimation_result = mysql_query($estimation_insert);
        $est_insert_id = $db->getInsertId();
        //Set insert into PROJECT_ESTIMATION
        $proj_est = "INSERT INTO PROJECT_ESTIMATION"
                . " (proj_id,"
                . " est_id)"
                . " VALUES ("
                . " '" . $proj_insert_id . "',"
                . " '" . $est_insert_id . "');";
        $projectEstimation_result = mysql_query($proj_est);

        //If all queries are successful then commit the changes
        if ($project_result && $userProject_result && $estimation_result && $projectEstimation_result)
            {
            mysql_query("COMMIT;");
            }
        //If any of the queries fail then rollback the query and print out error details
        else
            {
            mysql_query("ROLLBACK;");
            return "Error inserting into the database<br/>";
            }
        return true;
        }

    private static function validateArray($fields)
        {
        //Set var validation variables
        $type = "String";
        $validated = null;

        foreach ($fields as $field => $content)
            {
            if ($field === "pName")
                {
                $length = 30;
                $field = "Project Name";
                } elseif ($field === "pDescr")
                {
                $length = 200;
                $field = "Project Description";
                } elseif ($field === "pln_hr")
                {
                $length = 4;
                $field = "Planned Hours";
                //Assign field to numeric type as it is form input
                $type = "numeric";
                } elseif ($field === "pStart" || $field === "pDead")
                {
                $field = "Project Dates";
                $validated = Validator_Model::validateDate($content);
                }
            $validated = Validator_Model::variableCheck($field, $content, $type, $length);
            if (is_array($validated) || is_string($validated))
                {
                return $validated;
                }
            }
        return null;
        }

    }
