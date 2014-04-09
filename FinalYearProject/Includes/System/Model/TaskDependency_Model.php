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

        //Get dependency id based on the task id provided
    public static function getDpID($tsk_id)
        {
        $row = Database_Queries::selectFrom("DEPENDENCY", "DEPENDENCY_ID", 
                "TASK_DEPENDENCY", "TSK_ID", $tsk_id);
        if(isset($row)){
        $dpId = $row->DEPENDENCY_ID;
        }
        else {
            $dpId = null;
            }
        return $dpId;
        }

    public static function delete($tsk_id)
        {
        
    $table = "TASK_DEPENDENCY";
    $field = "DEPENDENCY_ID";
        $success = Generic_Model::__delete($tsk_id, $table, $field);
        return $success;
        }

    }
