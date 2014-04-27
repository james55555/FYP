<?php

/*
 * Description of StaffTask_Model
 *
 * @author James
 */

class StaffTask_Model extends Staff_Model
    {

    private $tsk_id;
    private $staff_id;

    public function __construct($row)
        {
        $this->tsk_id = $row->TSK_ID;
        $this->staff_id = $row->STAFF_ID;
        }

    public function tsk_id()
        {
        return $this->tsk_id;
        }

    public function staff_id()
        {
        return $this->staff_id;
        }

    public static function getStaffId($tsk_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT distinct STAFF_ID"
                . " FROM staff_task"
                . " WHERE TSK_ID='" . $tsk_id . "'";

        if ($db->querySuccess($query))
            {
            $result = $db->query($query);

            $row = mysqli_fetch_object($result);
            if (is_object($row))
                {
                $staff_id = $row->STAFF_ID;
                } else
                {
                $staff_id = null;
                }
            }
        $db->close();
        return $staff_id;
        }

    public static function delete($tsk_id)
        {
        $table = "STAFF_TASK";
        $field = "STAFF_ID";
        $success = Generic_Model::__delete($tsk_id, $table, $field);
        return $success;
        }

    }
