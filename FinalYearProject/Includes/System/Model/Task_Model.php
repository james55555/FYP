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
            }
            else{
                $this->proj_id = $this->proj_id();
                }

        $this->status = $row->STATUS;
        $this->task_nm = $row->TASK_NM;
        $this->web_addr = $row->WEB_ADDR;
        $this->tsk_dscr = $row->TSK_DESCR;

        $this->estimation = TaskEstimation_Model::getEstimationId($row->TSK_ID);
        $this->staff = StaffTask_Model::getStaffId($row->TSK_ID);
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
                . " WHERE proj_id = '$proj_id'";
        $result = mysql_query($query);

        $project_tasks = array();
        while ($row = mysql_fetch_object($result))
            {
            array_push($project_tasks, new Task_Model($row));
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
