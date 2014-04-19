<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff_Model extends Generic_Model
    {

    private
            $staff_id;
    private
            $staff_first_nm;
    private
            $staff_last_nm;
    private
            $staff_phone;
    private
            $staff_email;

    public
            function __construct($staff_id)
        {
        try {
        $row = $this->get($staff_id);
        if(!isset($row)){
            throw new Exception("No Staff_Model found!");
            }
        $this->staff_id = $row->STAFF_ID;
        $this->staff_first_nm = $row->STAFF_FIRST_NM;
        $this->staff_last_nm = $row->STAFF_LAST_NM;
        $this->staff_phone = $row->STAFF_PHONE;
        $this->staff_email = $row->STAFF_EMAIL;
        }
        catch(Exception $e){
            echo $e->getMessage();
            echo "<br/>" . $e->getTraceAsString();
            return null;
            }
        }

    public
            function staff_id()
        {
        return $this->staff_id;
        }

    public
            function staff_first_nm()
        {
        return $this->staff_first_nm;
        }

    public
            function staff_last_nm()
        {
        return $this->staff_last_nm;
        }

    public
            function staff_phone()
        {
        return $this->staff_phone;
        }

    public
            function staff_email()
        {
        return $this->staff_email;
        }

    /*
     * Function to return the staff member for a given id
     * @param String staff_id
     * @return obj staff
     */

    public
    static function get($staff_id)
        {
        $fields = array("STAFF_ID", "STAFF_FIRST_NM", "STAFF_LAST_NM",
            "STAFF_PHONE", "STAFF_EMAIL");
        $staff = Database_Queries::selectFrom("Staff_Model", $fields, "STAFF", "STAFF_ID", $staff_id);
        return $staff;
        }

    public static function getStaffForProject($proj_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT ST.STAFF_ID, STAFF_FIRST_NM, STAFF_LAST_NM, STAFF_PHONE, STAFF_EMAIL\n"
                . " FROM STAFF ST\n"
                . " INNER JOIN STAFF_TASK TSK \n"
                . " ON ST.STAFF_ID = TSK.STAFF_ID\n"
                . "INNER JOIN TASK TS\n"
                . "ON TS.TSK_ID=TSK.TSK_ID\n"
                . " INNER JOIN PROJECT PRJ\n"
                . " ON PRJ.PROJ_ID = TS.PROJ_ID\n"
                . " and PRJ.PROJ_ID ='" . $proj_id . "'";

        if ($db->querySuccess($query))
            {
            $result = mysql_query($query);
            $row = mysql_fetch_object($result);
            $staff = new Staff_Model($row);
            } else
            {
            return false;
            }
        $db->close();
        return $staff;
        }

    public static function delete($staff_id)
        {

        $table = "STAFF";
        $field = "STAFF_ID";
        $success = parent::__delete($staff_id, $table, $field);
        return $success;
        }

    }
