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
        try
            {
            if (!isset($row))
                {
                throw new Exception("Empty row");
                }
            } catch (Exception $ex)
            {
            echo $ex->getMessage() . "<br/>" . $ex->getTraceAsString();
            return false;
            }
        $this->tsk_id = $row->TSK_ID;
        $this->dp_id = $row->DEPENDENCY_ID;
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
        if (is_object($row))
            {
            $dpId = $row->dependency_id;
            } elseif (is_array($row))
            {
            $dpId = $row['dependency_id'];
            } else
            {
            $dpId = null;
            }
        return $dpId;
        }

    /*
     * Function to delete a dependency based on the provided task_id
     */

    public static function delete($tsk_id)
        {

        $table = "TASK_DEPENDENCY";
        $field = "DEPENDENCY_ID";
        $success = Generic_Model::__delete($tsk_id, $table, $field);
        return $success;
        }

    }
