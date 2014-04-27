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
        try
            {
            $row = $this->get($staff_id);
            if (!isset($row))
                {
                throw new Exception("NULL");
                }
            foreach ($row as $key => $val)
                {
                $key = strtolower($key);
                if ($val === "NULL")
                    {
                    $val = null;
                    }
                    $this->$key = $val;
                }
/*            $this->staff_id = $row->STAFF_ID;
            $this->staff_first_nm = $row->STAFF_FIRST_NM;
            $this->staff_last_nm = $row->STAFF_LAST_NM;
            $this->staff_phone = $row->STAFF_PHONE;
            $this->staff_email = $row->STAFF_EMAIL;
*/
            } catch (Exception $e)
            {
            $var = $e->getMessage();
            //Insert four values of "NULL" into $fields
            $fields = array();
            for ($i = 0; $i !== 4; $i++)
                {
                array_push($fields, $var);
                }
            //Add a new, empty staff object
            $this->addStaffMember($fields);
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
     * Inherit method to set a new variable
     */

    public function set($variable, $newValue)
        {
        try
            {
            $variable = strtolower($variable);

            $this->$variable = $newValue;
            if ($this->$variable !== $newValue)
                {
                throw new Exception("Error setting new value");
                }
            } catch (Exception $ex)
            {
            echo $ex->getMessage() . "<br/>" . $ex->getTraceAsString();
            }
        }

    public function setEmptyNull($row)
        {
        foreach ($row as $key => $val)
            {
            if ($val === "NULL")
                {
                $this->set($key, null);
                }
            }
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
        //Cast stdObject to array
        if (isset($staff) && is_object($staff))
            {
            $staffArr = (array) $staff;
            } else
            {
            $staffArr = $staff;
            }
        return $staffArr;
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
            $result = mysqli_query($query);
            $row = mysqli_fetch_object($result);
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

    public static function validateStaffFields($fields)
        {
        $validated = null;
        $optional = true;
        $type = "String";
        foreach ($fields as $key => $value)
            {
            //If the last 5 chars of field are name then run
            if ($key === "stFirst" || $key === "stLast")
                {
                $key = "Staff Name";
                $length = 30;
                } elseif ($key === "stTel")
                {
                if (!is_String(Validator_Model::optionalVar($value, $key)))
                    {
                    $pattern = "[\d{4}]";
                    $match = preg_match($pattern, $value);
                    if (!$match)
                        {
                        $validated = "Invalid staff telephone extension!";
                        }
                    }
                } elseif ($key === "stEmail")
                {
                $key = "Email";
                $length = 200;
                $validated = Validator_Model::validateEmail($value, "Staff email ");
                }

            if (!isset($validated))
                {
                $validated = Validator_Model::variableCheck($key, $value, $type, $length, $optional);
                }
            if (is_array($validated) || is_string($validated))
                {
                return $validated;
                }
            }
        return null;
        }

    public static function addStaffMember($fields)
        {
        $db = new Database();
        $db->connect();

        $db->start();
        //Set insert into STAFF
        $staff_insert = "INSERT INTO STAFF ("
                . " STAFF_ID,"
                . " STAFF_FIRST_NM,"
                . " STAFF_LAST_NM,"
                . " STAFF_PHONE,"
                . " STAFF_EMAIL)"
                . " VALUES ("
                . " NULL,"
                . " '" . $fields[0] . "',"
                . " '" . $fields[1] . "',"
                . " '" . $fields[2] . "',"
                . " '" . $fields[3] . "');";

        //Run query to insert into table and get the STAFF_ID
        $staff_result = $db->query($staff_insert);
        $staff_id = $db->getInsertId();
        if ($db->endStatement($staff_result))
            {
            $staff = new Staff_Model($staff_id);
            } else
            {
            $staff = "Error inserting into staff database";
            }
        $db->close();
        return $staff;
        }

    }
