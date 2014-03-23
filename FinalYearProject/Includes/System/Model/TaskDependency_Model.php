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

    public static function delete($dpnd_id, $tsk_id)
        {
        $table = $this->table;
        if(isset($dpnd_id)){
            $var = $dpnd_id;
            $field = "DEPENDENCY_ID";
            }
            else {
                $var = $tsk_id;
                $field = "TSK_ID";
                }
        //Run deletion with passed parameters
        $success = __delete($var, $table, $field);

        return $success;
        }

    }
