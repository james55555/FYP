<?php

/*
 * Description of Dependency_Model
 *
 * @author James
 */

class ProjectTasks_Model extends Generic_Model
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
        $task = Database_Queries::selectFrom("Task_Model", $columns, "TASK", 
                "PROJ_ID", $proj_id);
        return $task;
        }

    public static function deleteTask($tsk_id)
        {
        $table = "TASK";
        $field = "TSK_ID";

        $success = parent::__delete($tsk_id, $table, $field);

        return $success;
        }

    }
