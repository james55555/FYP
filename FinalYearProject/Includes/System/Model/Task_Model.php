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
