<?php

/*
 * Description of Task_Model
 *
 * @author James
 */

class Task_Model
    {

    private
            $tsk_id;
    private
            $proj_id;
    private
            $status;
    private
            $task_nm;
    private
            $web_addr;
    private
            $tsk_dscr;
    private
            $estimation;
    private
            $staff;
    private
            $dpnd;

    /*
     * construct new task object
     */

    public
            function __construct($tsk_id)
        {
        $row = $this->getTask($tsk_id);
        $this->tsk_id = $row->TSK_ID;
        //Get the project corresponding to the linked id
        if (isset($_GET['proj_id']))
            {
            $_assocProj = Project_Model::getProject($_GET['proj_id']);
            $this->proj_id = $_assocProj->proj_id;
            } else
            {
            $this->proj_id = $row->PROJ_ID;
            }

        $this->status = $row->STATUS;
        $this->task_nm = $row->TASK_NM;
        $this->web_addr = $row->WEB_ADDR;
        $this->tsk_dscr = $row->TSK_DESCR;
        //Set up associated objects with task
        $this->estimation = TaskEstimation_Model::getEstimationId($row->TSK_ID);
        $this->staff = StaffTask_Model::getStaffId($row->TSK_ID);
        $this->dpnd = TaskDependency_Model::getDpID($row->TSK_ID);
        }

    public
            function tsk_id()
        {
        return $this->tsk_id;
        }

    public
            function proj_id()
        {
        return $this->proj_id;
        }

    public
            function tsk_status()
        {
        return $this->status;
        }

    public
            function tsk_nm()
        {
        return $this->task_nm;
        }

    public
            function web_addr()
        {
        return $this->web_addr;
        }

    public
            function tsk_dscr()
        {
        return $this->tsk_dscr;
        }

    public function estimation()
        {
        return $this->estimation;
        }

    public function staff()
        {
        return $this->staff;
        }

    public function dpnd()
        {
        return $this->dpnd;
        }

    /*
     * method to get a task by its id.
     * Task is to be returned. If task is null then there are no task for @param tsk_id
     * @param String tsk_id
     * @return obj task
     */

    public static
            function getTask($tsk_id)
        {
        $fields = array("TSK_ID, PROJ_ID, STATUS, "
            . "TASK_NM, WEB_ADDR", "TSK_DESCR");
        $task = Database_Queries::selectFrom("TASK_MODEL", $fields, "TASK", "TSK_ID", $tsk_id);
        return $task;
        }

    /*
     * Function to return all tasks in an array for a given project
     * @param $proj_id (String) This is the project id, used to identify associated tasks
     * 
     * @return $tasks array     This is the array of tasks returned
     */

    public static
            function getAllTasks($proj_id)
        {
        $fields = array("TSK_ID, PROJ_ID, STATUS, "
            . "TASK_NM, WEB_ADDR", "TSK_DESCR");
        $databaseTasks = Database_Queries::selectFrom("TASK_MODEL", $fields, "TASK", "PROJ_ID", $proj_id);
        //If database tasks isn't an array and issset then create one
        if (!is_array($databaseTasks) && isset($databaseTasks))
            {
            $tasks = array($databaseTasks);
            } else
            {
            $tasks = $databaseTasks;
            }
        return $tasks;
        }

    /*
     * Function to edit/update a task given the provided parameters
     * @param (array) $fields       These are the fields passed from the Controller
     * 
     * @param (bool || String)      This is true if successful and error message otherwise.
     * 
     */

    public static
            function editTask($fields)
        {
        $db = new Database();
        $fields = $db->filterParameters($fields);
        //Optional field
        if (isset($fields['tDpnd[]']))
            {
            $dpnds = $fields['tDpnd[]'];
            } else
            {
            $dpnds = "NULL";
            }
        $staffFields = array();
        $DatesForUpdate = array();
        foreach ($fields as $key => $field)
            {
            if (substr($key, -2) === "id")
                {
                //Assign hidden varaibles (not validated) to the $key name
                ${$key} = $field;
                //Then remove them for array processsing
                unset($fields[$key]);
                }
            if (substr($key, 0, 2) === "st" && ($key !== "status" && $key !== "staff_id"))
                {
                $staffFields[$key] = $field;
                //array_push($staffFields, $key[$field]);
                unset($fields[$key]);
                }
            if ($key === "tStart" || $key === "tDeadline" || $key === "tActEnd")
                {
                $DatesForUpdate[$key] = $field;
                //Clean up from $fields array
                unset($fields[$key]);
                }
            }
        /*
         * !Key ID variables are now $est_id, $proj_id and $task_id
         * VarList: tName
          tDescr
          web_addr
          status
          tStart
          tActEnd
          tDeadline
          tAct_hr
          tPln_hr
          stFirst
          stLast
          stTel
          stEmail
         */


        //Validate all task dates    
        $validDates = Task_Model::validateDates($proj_id, $DatesForUpdate['tStart'], $DatesForUpdate['tDeadline']);
        $validAct = Validator_Model::validateDate($DatesForUpdate['tActEnd'], true);
        if (is_string($validDates))
            {
            return $validDates;
            } elseif (is_string($validAct))
            {
            return $validAct;
            }
        //Validate staff fields
        $validStaff = Staff_Model::validateStaffFields($staffFields);
        if (is_string($validStaff) || is_array($validStaff))
            {
            return $validStaff;
            }
        //Run main task validation
        $valid = Task_Model::validateArray($fields);
        if (is_string($valid) || is_array($valid))
            {
            return $valid;
            }

        //Loop through $fields and set empty values to null
        foreach ($fields as $field => $val)
            {
            if (is_string(Validator_Model::optionalVar($val, $field)))
                {
                $fields[$field] = "NULL";
                }
            }
        //Loop through $DatesForUpdate and set empty values to null
        foreach ($DatesForUpdate as $date => $val)
            {
            if (is_string(Validator_Model::optionalVar($val, $date)))
                {
                $DatesForUpdate[$date] = "NULL";
                }
            }
        //Loop through $staffFields and set empty values to null
        foreach ($staffFields as $staff => $val)
            {
            if (is_string(Validator_Model::optionalVar($val, $staff)))
                {
                $staffFields[$staff] = "NULL";
                }
            }
        //Processing complete, now run update statement
        $db->connect();
        mysql_query("START TRANSACTION;");
//Run the row checker against all tables affected by the update
        try
            {
            //Check TASK table
            $taskExists = mysql_query("SELECT * FROM TASK "
                    . "WHERE TSK_ID='" . $task_id . "';");
            if (mysql_num_rows($taskExists) === 0)
                {
                throw new Exception("Task doesn't exist");
                }
            //Check ESTIMATION table
            $estimationExists = mysql_query("SELECT * FROM ESTIMATION "
                    . "WHERE EST_ID='" . $est_id . "';");
            if (mysql_num_rows($estimationExists) === 0)
                {
                throw new Exception("Estimation doesn't exist'");
                }
            } catch (Exception $ex)
            {
            mysql_query("ROLLBACK;");
            return $ex->getMessage() . "<br/>" . mysql_error();
            }
        try
            {
            //Run the update query against the PROJECT table
            $task_update = "UPDATE TASK SET"
                    . " STATUS='" . $fields['status'] . "',"
                    . " TASK_NM='" . $fields['tName'] . "',"
                    . " WEB_ADDR='" . $fields['web_addr'] . "',"
                    . " TSK_DESCR='" . $fields['tDescr'] . "',"
                    . " TSK_ID='" . $task_id . "';";
            $task_result = mysql_query($task_update);
            if (!$task_result && mysql_affected_rows() === 0)
                {
                throw new Exception("No task rows updated!"
                . "<br/>" . mysql_error());
                }
            //Run update query against ESTIMATION table
            $est_update = "UPDATE ESTIMATION SET "
                    . "ACT_HR='" . $fields['tAct_hr'] . "',"
                    . " PLN_HR='" . $fields['tPln_hr'] . "',"
                    . " START_DT='" . $DatesForUpdate['tStart'] . "',"
                    . " ACT_END_DT='" . $DatesForUpdate['tActEnd'] . "',"
                    . " EST_END_DT='" . $DatesForUpdate['tDeadline'] . "',"
                    . " WHERE EST_ID='" . $est_id . "';";
            $est_result = mysql_query($est_update);
            if (!$est_result && mysql_affected_rows() === 0)
                {
                throw new Exception("No ESTIMATION rows updated!"
                . "<br/>" . mysql_error());
                }
            //Run update query against STAFF table
            $staff_update = "UPDATE STAFF SET "
                    . "STAFF_FIRST_NM='" . $staffFields['stFirst'] . "',"
                    . " STAFF_LAST_NM='" . $staffFields['stLast'] . "',"
                    . " STAFF_PHONE='" . $staffFields['stTel'] . "',"
                    . " STAFF_EMAIL='" . $staffFields['stEmail'] . "'"
                    . " WHERE STAFF_ID='" . $staff_id . "';";
            $staff_result = mysql_query($staff_update);

            if (!$staff_result && mysql_affected_rows() === 0)
                {
                throw new Exception("No STAFF rows updated");
                }
            if ($dpnds !== "NULL")
                {
                foreach ($dpnds as $id => $on)
                    {
                    //Run update against DEPENDENCY table foreach dependency
                    //Associative array ($id = DP_ID && $on = DP_ON)

                    $dpnd_update = "UPDATE DEPENDENCY SET "
                            . "DEPENDENCY_ON='" . $on . "'"
                            . "WHERE DEPENDENCY_ID='" . $id . "';";
                    if (!$dpnd_update && mysql_affected_rows() === 0)
                        {
                        throw new Exception("Dependency update failed!");
                        }
                    }
                }
            } catch (Exception $ex)
            {
            mysql_query("ROLLBACK;");
            return $ex->getMessage();
            }
        mysql_query("COMMIT;");
        return true;
        }

    /*
     * Function to recursively remove tasks and references to tasks
     * based on provided id
     */

    public static function deleteTask($task_id)
        {
        if(is_object($task_id)){
            $task_id = $task_id->tsk_id();
            }
        $task = new Task_Model($task_id);
//Prepare queries
//Delete staff data
        $staffRef = StaffTask_Model::delete($task_id);
        $staff = Staff_Model::delete($task->staff());
        if (!$staff || !$staffRef)
            {
            return false;
            }
//Delete estimation data
        $estimateRef = TaskEstimation_Model::delete($task_id);
        $estimate = Estimation_Model::delete($task->estimation());
        if (!$estimateRef || !$estimate)
            {
            return false;
            }
//Delete dependency data
        $dpndRef = TaskDependency_Model::delete($task_id);
        $dependency = Dependency_Model::delete($task->dpnd());
        if (!$dpndRef || !$dependency)
            {
            return false;
            }
        $result = Database_Queries::deleteFrom("TASK", "TSK_ID", $task_id, null);

        if (!$result)
            {
            return false;
            }
        return true;
        }

    /*
     * Function to addTask and return the newly added task for use in the Controller
     * @param (array) $fields           These are the fields passed from the Controller
     * 
     * @return (object) new Task_Model  This is the newly added task to be made available to the controller
     */

    public static function addTask($fields)
        {
        $db = new Database();
        $db->connect();
        $fields = $db->filterParameters($fields);
        //Close database connection for encapsulation purposes
        $db->close();
        $proj_id = $fields['proj_id'];
        //TASK data
        $tName = $fields['tName'];
        $tDescr = $fields['tDescr'];
        $web_addr = $fields['web_addr'];
        $status = $fields['status'];
        //ESTIMATION data
        $tStart = $fields['tStart'];
        $tDeadline = $fields['tDeadline'];
        $pln_hr = $fields['pln_hr'];

        //Assign dependencies to an array
        $dependencies = array();
        //Sanitise $fields array and remove ID fields (these should be unchangeable)
        foreach ($fields as $key => $field)
            {
            if (substr($key, -2) === "id")
                {
                //Assign hidden varaibles (not validated) to the $key name
                ${$key} = $field;
                //Then remove them for array processsing
                unset($fields[$key]);
                }
            }
        //If the posted dependencies are set then validate each one
        if (!empty($fields['tDpnd']))
            {
            foreach ($fields['tDpnd'] as $dpnd)
                {
                array_push($dependencies, $dpnd);
                }
            }
        //Remove the tDpnd index from $fields array
        unset($fields['tDpnd']);
        $validDependencies = Task_Model::ValidateDependencies($dependencies);

        //Check that tasks dates are between project dates and start is before end
        $validDates = Task_Model::validateDates($proj_id, $tStart, $tDeadline);
        unset($fields['tStart']);
        unset($fields['tDeadline']);
        //Run the fields through validation
        $valid = Task_Model::validateArray($fields);
        //If errors are returned from then return the provided error message
        if (is_array($valid) || is_string($valid))
            {
            return $valid;
            } elseif (is_array($validDependencies) ||
                is_string($validDependencies))
            {
            return $validDependencies;
            } elseif (is_string($validDates))
            {
            return $validDates;
            }

        //Re-open database connection to run queries agains
        $db->connect();
        //Start insert transaction
        mysql_query("START TRANSACTION;");

        //Set insert into TASK string
        $task_insert = "INSERT INTO TASK ("
                . " TSK_ID,"
                . " PROJ_ID,"
                . " STATUS,"
                . " TASK_NM,"
                . " WEB_ADDR,"
                . " TSK_DESCR"
                . ") VALUES ("
                . "NULL,"
                . " '" . $proj_id . "',"
                . " '" . $status . "',"
                . " '" . $tName . "',"
                . " '" . $web_addr . "',"
                . " '" . $tDescr . "');";
        //Run the query and get the task ID
        $task_result = mysql_query($task_insert);
        $task_id = $db->getInsertId();

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
                . "'" . $tStart . "', "
                . "NULL, "
                . "'" . $tDeadline . "');";

        //Run query and get estimation id.
        $estimation_result = mysql_query($estimation_insert);
        $est_id = $db->getInsertId();
        //Set query to create link between TASK and ESTIMATION
        $taskEst_insert = "INSERT INTO TASK_ESTIMATION ("
                . "tsk_id,"
                . " est_id)"
                . " VALUES( "
                . " '" . $task_id . "',"
                . " '" . $est_id . "');";
        $taskEst_result = mysql_query($taskEst_insert);
        //Foreach dependency selected, insert into DEPENDENCY tables
        // Tables: DEPENDENCY, TASK_DEPENDENCY
        foreach ($dependencies as $id)
            {
            //Set query for DEPENDENCY insert
            $dpnd_insert = "INSERT INTO DEPENDENCY ("
                    . "DEPENDENCY_ID,"
                    . " DEPENDENCY_ON)"
                    . " VALUES ( "
                    . "NULL, "
                    . "'" . $id . "');";
            //Insert into DEPENDENCY table
            $dpnd_result = mysql_query($dpnd_insert);
            $dpnd_id = $db->getInsertId();
            //Set query for TASK_DEPENDENCY insert
            $taskDpnd_insert = "INSERT INTO TASK_DEPENDENCY ("
                    . "DEPENDENCY_ID,"
                    . " TSK_ID)"
                    . " VALUES ("
                    . " '" . $task_id . "',"
                    . " '" . $dpnd_id . "');";
            //Insert into TASK_DEPENDENCY table
            $taskDpnd_result = mysql_query($taskDpnd_insert);
            }
        //Set insert into STAFF
        $staffFields = array($fields['stFirst'], $fields['stLast'], $fields['stTel'], $fields['stEmail']);
        $staff_result = Staff_Model::addStaffMember($staffFields);
        if (is_object($staff_result))
            {
            $staff_id = $staff_result->staff_id();
            } else
            {
            throw new Exception($staff_result);
            }
        //Set insert into STAFF_TASK
        $staffTask_insert = "INSERT INTO STAFF_TASK ("
                . "TSK_ID,"
                . " STAFF_ID)"
                . " VALUES ("
                . " '" . $task_id . "',"
                . " '" . $staff_id . "');";
        //Run the query to insert into table
        $staffTask_result = mysql_query($staffTask_insert);
        if (!isset($dpnd_result) || !isset($taskDpnd_result))
            {
            $dpnd_result = true;
            $taskDpnd_result = true;
            }
        //If all queries have returned true then COMMIT the TRANSACTION
        if ($task_result && $estimation_result && $taskEst_result && $dpnd_result && $taskDpnd_result && $staff_result && $staffTask_result)
            {
            mysql_query("COMMIT;");
            } else
            {
            mysql_query("ROLLBACK;");
            $db->close();
            return "Error inserting into the database<br/>";
            }
        $db->close();
        return new Task_Model($task_id);
        }

    public static function validateArray($fields)
        {
        $validated = null;
        foreach ($fields as $field => $content)
            {
            $type = "string";
            $optional = false;
            //Run through task details information
            if ($field === "tName")
                {
                $length = 30;
                $field = "Task Name";
                } elseif ($field === "tDescr")
                {
                $length = 200;
                $field = "Task description";
                } elseif ($field === "web_addr")
                {
                $optional = true;
                $field = "Web Address";
                $length = 200;
                } elseif ($field === "status")
                {
                if (!in_array($content, array("", "Not Started", "In Progress", "Finished")))
                    {
                    return "Correct status needs to be supplied";
                    }
                } elseif ($field === "tPln_hr" || $field === "tAct_hr")
                {
                $length = 4;
                $type = "numeric";
                $optional = true;
                if (!isset($content))
                    {
                    $content = 0;
                    }
                } elseif ($field === "tActEnd")
                {
                $field = "Actual End Date";
                $optional = true;
                $validated = Validator_Model::validateDate($content, $optional);
                }
            //!Important - The logic requires that the Validator_Model 
            //function is run before the @return
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

    /*
     * Funtion to run through provided dependencies array and 
     * validate each provided value
     * @param $array (array)    This is the values provided
     * 
     * @return boolean          This returns an error or true
     */

    private static function ValidateDependencies($array)
        {
        $type = "numeric";
        $length = 10;
        foreach ($array as $field => $content)
            {
            $field = "dependencies";
            $validated = Validator_Model::variableCheck($field, $content, $type, $length);
            if (isset($validated))
                {
                return $validated;
                }
            }
        return false;
        }

    /*
     * Function to validate dates provided for either the add or edit query
     * @param $proj_id     (String)     This is the ID for the Project object 
     *                                  that holds the information to be used 
     *                                  to ensure the task is within the project timeline.
     * @param $start       (date)       This is the start date for the task
     * @param $end         (date)       This is the actual end date for the task
     * @param $deadline    (date)       This is the date the task was 
     *                                  predicted to be completed on
     * 
     * @return $valid      (Boolean)   This is true on success, false otherwise
     */

    private static function validateDates($proj_id, $start, $deadline)
        {
        //Assign dates to an array for ease of processing
        $dates = array($start, $deadline);
//Create new Estimation object using the project ID as an estimate identifier 
        $project_estimation = new Estimation_Model(ProjectEstimation_Model::getEstimationId($proj_id));
        //Validate date formats
        foreach ($dates as $date)
            {
            $validFormat = Validator_Model::validateDate($date, true);
            //If the value is a string it contains an error
            if (is_string($validFormat))
                {
                return $validFormat;
                //If the value is true continue to date  check
                } elseif ($validFormat)
                {
                //Format for this date has been validted, now check the timing
                $validTiming = Task_Model::isDateBetween($date, $project_estimation->est_end_dt(), $project_estimation->start_dt());
                if (is_string($validTiming))
                    {
                    return "Supplied: " . $date . "<br/>" . $validTiming;
                    }
                }
            }
        }

    /*
     * Helper function to check whether a date is between the two provided project dates
     * @param (date)    $date       This is the date to be checked
     * @param (date)    $endDate    This is the date that $date should be before
     * @param (date)    $startDate  This is the date that $date should be after
     * 
     * @return (Boolean || String)  This returns true or an error message if incorrect
     */

    private static function isDateBetween($date, $endDate, $startDate)
        {
        //Create error message to return
        $errorMsg = "Dates must be within the project timeline!"
                . "<br/>Project start date is: " . $startDate
                . "<br/>Project deadline is: " . $endDate;
        //If date is outside of start and end date then return error message
        if (strtotime($startDate) > $date ||
                strtotime($endDate) < $date)
            {
            return $errorMsg;
            } else
            {
            return true;
            }
        }

    }
