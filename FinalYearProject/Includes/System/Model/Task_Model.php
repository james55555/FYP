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
        $tasks = Database_Queries::selectFrom("TASK_MODEL", $fields, "TASK", "PROJ_ID", $proj_id);
        if (!isset($tasks))
            {
            $tasks = null;
            }
        return $tasks;
        }

    /*
     * Function to edit/update a task given the provided parameters
     * @param int tsk_id, int proj_id, int status_id, String tsk_nm, String web_addr, String tsk_descr, obj Model estimation, obj Model dependency
     */

    public static
            function editTask($fields)
        {
        
        }

    /*
     * Function to recursively remove tasks and references to tasks
     * based on provided id
     */

    public static function deleteTask($task_id)
        {
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

    public static function addTask($fields)
        {
        $db = new Database();
        $db->connect();
        $fields = $db->filterParameters($fields);
        $proj_id = $fields['proj_id'];
        //TASK data
        $tName = $fields['tName'];
        $tDescr = $fields['tDescr'];
        $web_addr = $fields['web_addr'];
        $dpnd = $fields['tDpnd'];
        $status = $fields['status'];
        //ESTIMATION data
        $tStart = $fields['tStart'];
        $tDeadline = $fields['tDeadline'];
        $pln_hr = $fields['pln_hr'];
        //STAFF data
        $stFirst = $fields['stFirst'];
        $stLast = $fields['stLast'];
        $stTel = $fields['stTel'];
        $stEmail = $fields['stEmail'];

        $valid = Task_Model::validateArray($fields);
        if (is_array($valid) || is_string($valid))
            {
            return $valid;
            }

        $project = new Project_Model($proj_id);
        $projEstimate = Estimation_Model::get($project->estimation());
        //Check that tasks dates are between project dates and start is before end
        if (strtotime($projEstimate->start_dt()) < strtotime($tStart) && strtotime($projEstimate->est_end_dt() > strtotime($tDeadline) && strtotime($tStart) < strtotime($tDeadline)))
            {
            return "Ensure dates are correct</br>"
                    . "Remember task dates must be within the time span of their project.";
            }
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
        foreach ($dpnd as $id)
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
            $taskDpnd_result = mysql_query($dpnd_insert);
            }

        //Set insert into STAFF
        $staff_insert = "INSERT INTO STAFF ("
                . "STAFF_ID,"
                . " STAFF_FIRST_NM,"
                . " STAFF_LAST_NM,"
                . " STAFF_PHONE,"
                . " STAFF_EMAIL)"
                . " VALUES ("
                . " NULL,"
                . " '" . $stFirst . "',"
                . " '" . $stLast . "',"
                . " '" . $stTel . "',"
                . " '" . $stEmail . "');";
        //Run query to insert into table and get the STAFF_ID
        $staff_result = mysql_query($staff_insert);
        $staff_id = $db->getInsertId();
        //Set insert into STAFF_TASK
        $staffTask_insert = "INSERT INTO STAFF_TASK ("
                . "TSK_ID,"
                . " STAFF_ID)"
                . " VALUES ("
                . " '" . $task_id . "',"
                . " '" . $staff_id . "');";
        //Run the query to insert into table
        $staffTask_result = mysql_query($staffTask_insert);

        if ($task_result && $estimation_result && $taskEst_result && $dpnd_result && $taskDpnd_result && $staff_result && $staffTask_result)
            {
            mysql_query("COMMIT;");
            } else
            {
            mysql_query("ROLLBACK;");
            return "Error inserting into the database<br/>";
            }
        return true;
        }

    public static function validateArray($fields)
        {
        $type = "string";
        $validated = null;

        foreach ($fields as $field => $content)
            {
            //run through task details information
            if ($field === "tName")
                {
                $length = 30;
                $field = "Task Name";
                } elseif ($field === "tDescr")
                {
                $length = 200;
                $field = "Task description";
                }
            //Run through task estimation dates
            elseif ($field === "tStart")
                {
                $field = "Start date";
                $validated = Validator_Model::validateDate($content);
                } elseif ($field === "tDeadline")
                {
                $field = "Deadline";
                $validated = Validator_Model::validateDate($content);
                } elseif ($field === "pln_hr")
                {
                $field = "Estimated hours";
                $length = 4;
                $type = "numeric";
                } elseif ($field === "stFirst" || $field = "stLast")
                {
                $field = "Staff name";
                $length = 30;
                } elseif ($field === "stEmail")
                {
                $field = "Staff email";
                $validated = Validator_Model::validateEmail($content, $field);
                } elseif ($field === "web_addr")
                {
                if (!filter_var($content, FILTER_VALIDATE_URL) &&
                        ($content !== '' || isset($content)))
                    {
                    $validated = "Web address provided is invalid!";
                    }
                } elseif ($field === "stTel")
                {
                $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
                $match = preg_match($pattern, $content);
                if (!$match)
                    {
                    $validated = "Invalid phone number!";
                    }
                } elseif ($field === "status")
                {
                
                }
            //DEPENDENCY && WEB ADDR NEED SPECIAL VALIDATION
            elseif ($field === "dpnd")
                {
                
                }
            if (isset($validated))
                {
                return $validated;
                }
            }
        }

    /* public static
      function addNewTask($row)
      {
      $db = new Database();
      $db->connect();
      if (!isset($row->web_addr()))
      {
      $row->web_addr() = null;
      }
      if (!isset($row->tsk_descr()))
      {
      $row->tsk_descr() = null;
      }
      $query = "INSERT INTO task VALUES ('$row')";
      }
     */
    }
