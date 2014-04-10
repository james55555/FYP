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
     * Constructor class to create new Project object
     */

    public
            function __construct($proj_id)
        {
        $row = $this->getProject($proj_id);

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

        $project = new Project_Model($proj_id);
        if (!isset($project))
            {
            return false;
            }
        //Loop through all tasks associated with the project and remove each one
        $deleteTask = Task_Model::getAllTasks($proj_id);
        //If the task returns false and not null then fail
        if (!$deleteTask && isset($deleteTask))
            {
            return false;
            }
        //If the task is set but not false then it must be valid
        elseif (isset($deleteTask))
            {
            foreach ($deleteTask as $delete)
                {
                Task_Model::deleteTask($delete);
                }
            }


        $estimation = Estimation_Model::delete($project->estimate);
        if (!$estimation && isset($estimation))
            {
            return false;
            }
        $estRef = ProjectEstimation_Model::delete($project->estimate);

        if (isset($estRef) && $estRef)
            {

            //Delete project from base table - PROJECT
            $projectDelete = Database_Queries::deleteFrom("PROJECT", "proj_id", $proj_id, null);
            //Disassociate project reference to user in USER_PROJECT
            $user_projectDelete = Database_Queries::deleteFrom("USER_PROJECT", "proj_id", $proj_id, null);
            } else
            {
            return false;
            }
        if ((!$projectDelete && isset($projectDelete)) || (!$user_projectDelete && isset($user_projectDelete)))
            {
            return false;
            }
        $db->close();
        return true;
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
        if (strtotime($proj_start) > strtotime($proj_deadline))
            {
            return "Start date can't be after the deadline date!";
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
            if (!isset($validated))
                {
                $validated = Validator_Model::variableCheck($field, $content, $type, $length);
                }
            if (is_array($validated) || is_string($validated))
                {
                return $validated;
                }
            }
        return null;
        }

    public static function editProject($fields)
        {
        $db = new Database();

        $fields = $db->filterParameters($fields);

        $proj_id = $fields['proj_id'];
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
        if (strtotime($proj_start) > strtotime($proj_deadline))
            {
            return "Start date can't be after the deadline date!";
            }
        //Connect to database to run queries
        $db->connect();
        //Start the transaction
        mysql_query("START TRANSACTION;");
//Run the the row check to ensure the row to be updated exists
        try
            {
            $rowExists = mysql_query("SELECT * FROM PROJECT"
                    . " WHERE proj_id='" . $proj_id . "';");
            if (mysql_num_rows($rowExists) === 0)
                {
                throw new Exception("Row doesn't exist");
                }
            } catch (Exception $e)
            {
            mysql_query("ROLLBACK;");
            return $e->getMessage() . "<br/>" . mysql_error();
            }
        try
            {
            $project = "UPDATE PROJECT SET"
                    . " proj_nm='" . $proj_nm . "',"
                    . " proj_descr='" . $proj_descr . "'"
                    . " WHERE proj_id='" . $proj_id . "';";
            } catch (Exception $ex)
            {
            
            }
        }

    }
