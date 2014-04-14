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

    /*
     * Function to get all dependency ID's associated with task in an array
     * @param (String) $tsk_id          This is the task ID the ID's are associated with
     * 
     * @return (array) $dependencies    This is the array of task ID's that the provided $tsk_id is dependent on
     */

    public static function getDpID($tsk_id)
        {
        $row = Database_Queries::selectFrom("DEPENDENCY_MODEL", "DEPENDENCY_ID", "TASK_DEPENDENCY", "TSK_ID", $tsk_id);
        if (isset($row))
            {
            //Create array to store rows in
            $dpIds = array();
            //Assign list of Id's to the new array
            foreach ($row as $id)
                {
                $dpIds = $id->DEPENDENCY_ID;
                }
            } else
            {
            //If nothing is found return null
            $dpIds = null;
            }
        return $dpIds;
        }

    public static function delete($tsk_id)
        {

        $table = "TASK_DEPENDENCY";
        $field = "DEPENDENCY_ID";
        $success = Generic_Model::__delete($tsk_id, $table, $field);
        return $success;
        }

    }
