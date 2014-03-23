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
    private $table = "STAFF_TASK";

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
            $result = mysql_query($query);

            $row = mysql_fetch_object($result);
            if(is_object($row)){
            $staff_id = $row->STAFF_ID;
            }
            else{
                $staff_id = null;
                }
            } 
        $db->close();


        return $staff_id;
        }
        public static function delete($tsk_id, $staff_id){
            $table = $this->table;
            if(isset($tsk_id)){
                $var = $tsk_id;
                $field = "TSK_ID";
                }
                else {
                    $var = $staff_id;
                    $field = "staff_id";
                    }
            $success = Generic_Model::__delete($var, $table, $field);
            return $success;
            }

    }
