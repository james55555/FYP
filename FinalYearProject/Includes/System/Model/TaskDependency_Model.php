<?php

/**
 * Description of TaskDependency_Model
 *
 * @author James
 */
class TaskDependency_Model extends Dependency_Model
    {

    private $tsk_id;
    private $dp_id;
    private $table = "TASK_DEPENDENCY";

    public function __construct($row)
        {
        if (isset($row))
            {
            $this->tsk_id = $row->TSK_ID;
            $this->dp_id = $row->DEPENDENCY_ID;
            }
        }

    public function tsk_id()
        {
        return $this->tsk_id;
        }

    public function dp_id()
        {
        return $this->dp_id;
        }

    public static function getDpID($tsk_id)
        {
        $id = Database_Queries::selectFrom(null, "DEPENDENCY_ID", "TASK_DEPENDENCY", "TSK_ID", $tsk_id);
        return $id;
        }

    public static function delete($tsk_id)
        {
        $table = $this->table;
        $success = Generic_Model::__delete($tsk_id, $table, $field);
        return $success;
        }

    }
