<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StaffTask_Model
 *
 * @author James
 */
class StaffTask_Model
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

        public static function getStaffId($tsk_id){
            $db = new Database();
            $db->connect();
            
            $query = "SELECT distinct staff_id"
                    . " FROM staff_task"
                    . " WHERE tsk_id='".$tsk_id."'";
            
            if ($db->querySuccess($query))
            {
            $result = mysql_query($query);

            $row = mysql_fetch_object($result);
            $staff_id = $row->staff_id;
            if (mysql_num_rows($result) !== 1)
                {
                throw new Exception("Why isn't this 1??");
                }
            } else
            {
            throw new Exception("invalid query");
            }
        $db->close();


        return $staff_id;
            }
        
    }
