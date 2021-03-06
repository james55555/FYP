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
        try
            {
            $db = new Database();
            $db->connect();

            $query = "SELECT PR.proj_id, PR.proj_nm, PR.proj_descr"
                    . " FROM project PR"
                    . " WHERE PR.proj_id IN"
                    . " (SELECT proj_id FROM user_project UP"
                    . " WHERE UP.user_id='" . $acc_id . "');";
            $result = $db->query($query);
            if (!$result)
                {
                throw new Exception("Error finding projects");
                }
            } catch (Exception $e)
            {
            return $e->getMessage();
            }
        $projects = array();
        while ($row = mysqli_fetch_object($result))
            {
            array_push($projects, new Project_Model($row->proj_id));
            }
        $db->close();
        return $projects;
        }

    /*
     * Function to delete Project
     * @param (String) $proj_id     This will correspond with the proj_id field in the database
     * 
     * @return (bool)               Return true if successful, false otherwise
     */

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
            //Loop through all project tasks and remove each one
            foreach ($deleteTask as $delete)
                {
                if (is_array($delete))
                    {
                    $success = Task_Model::deleteTask($delete['tsk_id']);
                    if (!$success)
                        {
                        return false;
                        }
                    } elseif (is_object($delete))
                    {
                    $success = Task_Model::deleteTask($delete->tsk_id());
                    if (!$success)
                        {
                        return false;
                        }
                    } else
                    {
                    return false;
                    }
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
        $db->start();
        //Set insert into PROJECT String
        $proj_insert = "INSERT INTO project ("
                . " proj_id,"
                . " proj_nm,"
                . " proj_descr"
                . ") VALUES ("
                . "NULL,"
                . " '" . $proj_nm . "',"
                . " '" . $proj_descr . "'); ";
        //Run the query and get the project id
        $project_result = $db->query($proj_insert);
        $proj_insert_id = $db->getInsertId();
        //Set insert into USER_PROJECT
        $userProj_insert = "INSERT INTO user_project ("
                . " user_id, "
                . " proj_id)"
                . " VALUES ("
                . " '" . $account->user_id . "',"
                . " '" . $proj_insert_id . "');";
        //Run query
        $userProject_result = $db->query($userProj_insert);
        //Set insert into ESTIMATION
        $estimation_insert = "INSERT INTO estimation ("
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
        $estimation_result = $db->query($estimation_insert);
        $est_insert_id = $db->getInsertId();
        //Set insert into PROJECT_ESTIMATION
        $proj_est = "INSERT INTO project_estimation"
                . " (proj_id,"
                . " est_id)"
                . " VALUES ("
                . " '" . $proj_insert_id . "',"
                . " '" . $est_insert_id . "');";
        $projectEstimation_result = $db->query($proj_est);
        //If all queries are successful then commit the changes
        if ($project_result && $userProject_result && $estimation_result && $projectEstimation_result)
            {
            $db->commit();
            }
        //If any of the queries fail then rollback the query and print out error details
        else
            {
            $db->rollback();
            return "Error inserting into the database<br/>" . $db->getMysql_err();
        }
        }

    /*
     * Function to edit a project based on the fields provided by the controller (taken from form in view)
     * @param (array) $fields      Array of fields passed from view
     */

    public static function editProject($fields)
        {
        $db = new Database();
$db->connect();
        $fields = $db->filterParameters($fields);
        //GET project variables
        $proj_id = $fields['proj_id'];
        $proj_nm = $fields['pName'];
        $proj_descr = $fields['pDescr'];
        //GET estimation vairables
        $proj_start = $fields['pStart'];
        $pAct_hr = $fields['act_hr'];
        $pAct_End = $fields['pActEnd'];
        $proj_deadline = $fields['pDeadline'];
        $pln_hr = $fields['pln_hr'];

        //Get the esimation ID for use in the ESTIMATION table insert
        $est_id = ProjectEstimation_Model::getEstimationId($proj_id);

        unset($fields['proj_id']);
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
        $db->start();
//Run the the row check to ensure the row to be updated exists
        try
            {
            $rowExists = $db->query("SELECT * FROM project"
                    . " WHERE proj_id='" . $proj_id . "';");
            if (is_string($rowExists) || mysqli_num_rows($rowExists) === 0)
                {
                throw new Exception("Row doesn't exist");
                }
            } catch (Exception $e)
            {
            $db->rollback();
            return $e->getMessage() . "<br/>" . mysqli_error();
            }
        try
            {
            //Run the update query against the PROJECT table
            $project_update = "UPDATE project SET"
                    . " proj_nm='" . $proj_nm . "',"
                    . " proj_descr='" . $proj_descr . "'"
                    . " WHERE proj_id='" . $proj_id . "';";
            $project_result = $db->query($project_update);

            if (!$project_result)
                {
                throw new Exception("Updated no project rows!<br/>" . $project_update);
                }
            //Run the update query against the ESTIMATION table    
            if (!!!isset($est_id) || !!!$est_id)
                {
                throw new Exception("EST_ID wasn't set!");
                }
            $estimation_update = "UPDATE estimation SET"
                    . " ACT_HR='" . $pAct_hr . "',"
                    . " PLN_HR='" . $pln_hr . "',"
                    . " START_DT='" . $proj_start . "',"
                    . " ACT_END_DT='" . $pAct_End . "',"
                    . " EST_END_DT='" . $proj_deadline . "'"
                    . " WHERE EST_ID='" . $est_id . "';";
            $estimation_result = $db->query($estimation_update);
            if (!!!$estimation_result && mysqli_affected_rows($db->getConn()) === 0)
                {
                throw new Exception("Updated no estimation rows!");
                }
            } catch (Exception $ex)
            {
            $db->rollback();
            return $ex->getMessage();
            }
        $db->start();
        return true;
        }

    /*
     * Function to sanitize an array of fields to be used with the database.
     * @param (array) $fields       Array of fields to sanitize
     * 
     * @return (String || null)     Return String if error found, null otherwise.
     */

    private static function validateArray($fields)
        {
        //Set var validation variables
        $type = "String";
        $validated = null;

        foreach ($fields as $field => $content)
            {
            $optional = false;
            if ($field === "pName")
                {
                $length = 30;
                $field = "Project Name";
                } elseif ($field === "pDescr")
                {
                $length = 200;
                $field = "Project Description";
                $optional = true;
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
                $validated = Validator_Model::variableCheck($field, $content, $type, $length, $optional);
                }
            if (is_array($validated) || is_string($validated))
                {
                return $validated;
                }
            }
        return null;
        }

    }
