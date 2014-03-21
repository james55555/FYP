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
    private $estimation;
    private $staff;
    private $dpnd;

    /*
     * construct new task object
     */

    public
            function __construct($row)
        {
        $this->tsk_id = $row->TSK_ID;
        //Get the project corresponding to the linked id
        if (isset($_GET['proj_id']))
            {
            $_assocProj = Project_Model::getProject($_GET['proj_id']);
            //Assign the associated
            $this->proj_id = $_assocProj->proj_id();
            } else
            {
            $this->proj_id = $this->proj_id();
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
        $db = new Database();
        $db->connect();

        $query = "SELECT DISTINCT TSK_ID, PROJ_ID, "
                . "STATUS, TASK_NM, WEB_ADDR, TSK_DESCR"
                . " FROM TASK "
                . "WHERE tsk_id='$tsk_id'";

        if ($db->querySuccess($query))
            {
            $qResult = mysql_query($query);
            $row = mysql_fetch_object($qResult);
            $task = new Task_Model($row);
            } else
            {
            throw new Exception("query error... " . mysql_error());
            }
        $db->close();
        return $task;
        }

    public static
            function getAllTasks($proj_id)
        {
        $db = new Database();
        $db->connect();
        
         
        $query = "SELECT DISTINCT TSK_ID, PROJ_ID, STATUS, TASK_NM, WEB_ADDR, TSK_DESCR"
                . " FROM task"
                . " WHERE proj_id =''" . $proj_id . "'";
        $result = mysql_query($query);
        if($result !== false)
            {
        $project_tasks = array();
        while ($row = mysql_fetch_object($result))
            {
            array_push($project_tasks, new Task_Model($row));
            }
            }
            else {
                throw new Exception("Query error: " . mysql_error()
                        . "<br/>Variable vardump: " . var_dump($result));
                }
        $db->close();
        return $project_tasks;
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
        //Prepare queries
        //Bind staff queries together
        $deleteStaff = Database_Queries::deleteFrom_String("STAFF", "staff_id")
                . " IN(SELECT staff_id"
                . " FROM STAFF_TASK"
                . " WHERE TSK_ID='" . $task_id . "');";
        $deleteStaffTask = Database_Queries::deleteFrom_String("STAFF_TASK", "TSK_ID")
                . "='" . $task_id . "';";
        //Bind estimation queries together
        $deleteEstimation = Database_Queries::deleteFrom_String("ESTIMATION", "est_id")
                . " IN(SELECT est_id"
                . " FROM TASK_ESTIMATION"
                . " WHERE TSK_ID='" . $task_id . "');";
        $deleteTaskEstimation = Database_Queries::deleteFrom_String("TASK_ESTIMATION", "TSK_ID")
                . "='" . $task_id . "';";
        //Bind dependency queries together
        $deleteDependency = Database_Queries::deleteFrom_String("DEPENDENCY", "DEPENDENCY_ID")
                . " IN(SELECT dependency_id"
                . " FROM TASK_DEPENDENCY"
                . " WHERE TSK_ID='" . $task_id . "');";
        $deleteTaskDependency = Database_Queries::deleteFrom_String("TASK_DEPENDENCY", "TSK_ID")
                . "='" . $task_id . "';";
        //Set up deletion of task from task table
        $deleteTask = Database_Queries::deleteFrom_String("TASK", "TSK_ID")
                . "='" . $task_id . "';";
        //Query used to bind all of the above into a transaction
        $query = "START TRANSACTION;"
                . " {$deleteStaff}"
                . " {$deleteStaffTask}"
                . " {$deleteEstimation}"
                . " {$deleteTaskEstimation}"
                . " {$deleteDependency}"
                . " {$deleteTaskDependency}"
                . " {$deleteTask}"
                . "COMMIT;";
        $result = Database_Queries::deleteFrom(null, null, null, $query);
        if (!$result)
            {
            return false;
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
