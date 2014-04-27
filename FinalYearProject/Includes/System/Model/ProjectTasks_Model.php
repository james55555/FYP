<?php

/*
 * Description of Dependency_Model
 *
 * @author James
 */

class ProjectTasks_Model
    {

    private $proj_id;
    private $tsk_id;

    public function __construct($row)
        {
        $this->proj_id = $row->PROJ_ID;
        $this->tsk_id = $row->TSK_ID;
        }

    public function proj_id()
        {
        return $this->proj_id;
        }

    public function tsk_id()
        {
        return $this->tsk_id;
        }

    public static function getTask($proj_id)
        {
        $columns = array("PROJ_ID", "TSK_ID");
        $task = Database_Queries::selectFrom("Task_Model", $columns, "TASK", "PROJ_ID", $proj_id);
        return $task;
        }

    /*
     * Function to return a project id given the task id
     */

    public static function getProj_id($task_id)
        {
        $db = new Database();
        $db->connect();
        $db->start();
        $query = "SELECT proj_id FROM project "
                . "WHERE proj_id IN "
                . "(SELECT proj_id FROM task "
                . "WHERE tsk_id ='" . $task_id . "');";
        $result = mysqli_query($query);
        $success = $db->endStatement($result);
        $db->close();
        if (!$success)
            {
            return null;
            }
        return mysqli_fetch_object($result);
        }

    public static function deleteTask($tsk_id)
        {
        $table = "TASK";
        $field = "TSK_ID";

        $success = Generic_Model::__delete($tsk_id, $table, $field);

        return $success;
        }

    }
