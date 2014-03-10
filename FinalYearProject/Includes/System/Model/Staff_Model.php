<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Staff_Model
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
    private $fields = array();

    public
            function __construct($row)
        {
        if ($row === null)
            {
            foreach ($this->fields as $this->field)
                {
                $this->field = null;
                }
            }

        $this->staff_id = $row->staff_id;
        $this->staff_first_nm = $row->staff_first_nm;
        $this->staff_last_nm = $row->staff_last_nm;
        $this->staff_phone = $row->staff_phone;
        $this->staff_email = $row->staff_email;
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
        $db = new Database();
        $db->connect();
        $query = "SELECT staff_id, staff_first_nm, staff_last_nm,"
                . " staff_phone, staff_email"
                . " FROM STAFF"
                . " WHERE STAFF_ID='$staff_id'";
        //echo "<br/><br/>the query running is... ".$query;
        if ($db->querySuccess($query))
            {
            $qResult = mysql_query($query);

            $row = mysql_fetch_object($qResult);
            if (is_object($row))
                {
                $staff = new Staff_Model($row);
                } else
                {
                return null;
                }
            $db->close();
            return $staff;
            }
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

    }
