<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Estimation_Model extends Generic_Model
    {

    private
            $act_hr;
    private
            $pln_hr;
    private
            $start_dt;
    private
            $act_end_dt;
    private
            $est_end_dt;
    private
            $est_id;
    //Dates in American formatting (for use in HTML)
    private $start_dt_AM;
    private $act_end_dt_AM;
    private $est_end_dt_AM;

    public
            function __construct($est_id)
        {
        try
            {
            $row = $this->get($est_id);
            if (!isset($row))
                {
                throw new Exception("NULL");
                }
            foreach ($row as $key => $val)
                {
                $key = strtolower($key);
                if ($key === "start_dt" ||
                        $key === "act_end_dt" ||
                        $key === "est_end_dt")
                    {
                    $row->$key = new DateTime($val);
                    }
                }

            //If the no error has been thrown then continue creating object
            $this->est_id = $row->est_id;
            $this->act_hr = $row->act_hr;
            $this->pln_hr = $row->pln_hr;
            $this->start_dt = $row->start_dt->format('d-m-Y');
            $this->start_dt_AM = $row->start_dt->format('Y-m-d');
            $this->act_end_dt = $row->act_end_dt->format('d-m-Y');
            //Format American dates
            $this->act_end_dt_AM = $row->act_end_dt->format('Y-m-d');
            $this->est_end_dt = $row->est_end_dt->format('d-m-Y');
            $this->est_end_dt_AM = $row->est_end_dt->format('Y-m-d');
            //If the value is set as String NULL then set to null value
            foreach ($row as $key => $val)
                {
                if ($val === "NULL")
                    {
                    $this->set($key, null);
                    }
                }
            } catch (Exception $e)
            {
            $var = $e->getMessage();
            //Insert four values of "NULL" into $fields
            $fields = array();
            for ($i = 0; $i !== 5; $i++)
                {
                array_push($fields, $var);
                }
            //Add a new, empty staff object
            $this->add($fields);
            }
        }

    public function est_id()
        {
        return $this->est_id;
        }

    public function act_hr()
        {
        return $this->act_hr;
        }

    public function pln_hr()
        {
        return $this->pln_hr;
        }

    public function start_dt()
        {
        return $this->start_dt;
        }

    public function start_dt_AM()
        {
        return $this->start_dt_AM;
        }

    public function act_end_dt()
        {
        return $this->act_end_dt;
        }

    public function act_end_dt_AM()
        {
        return $this->act_end_dt_AM;
        }

    public function est_end_dt()
        {
        return $this->est_end_dt;
        }

    public function est_end_dt_AM()
        {
        return $this->est_end_dt_AM;
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

    public static function get($est_id)
        {
        $fields = array("est_id", "act_hr", "pln_hr", "start_dt",
            "act_end_dt", "est_end_dt");
        $estimation = Database_Queries::selectFrom("ESTIMATION_MODEL", $fields, "ESTIMATION", "EST_ID", $est_id);
        return $estimation;
        }

    /*
     * Get all the estimates for every task, given a user id passed as a SES
     * @param (String) userid
     * @return (array) estimates
     */

    public static function getAllEstimates($proj_id)
        {
        $db = new Database();
        $db->connect();

        //Query returns all estimation models for all associated tasks whcih are associated with projects which are associated with users in the current session
        $query = "SELECT EST_ID, ACT_HR, PLN_HR, START_DT,"
                . " ACT_END_DT, EST_END_DT, EST.TSK_ID"
                . " FROM ESTIMATION EST"
                . " INNER JOIN TASK TSK"
                . " ON EST.TSK_ID = TSK.TSK_ID"
                . " INNER JOIN PROJECT PROJ"
                . " ON TSK.PROJ_ID = PROJ.PROJ_ID"
                . " and proj.PROJ_ID ='" . $proj_id . "'";

        $result = mysql_query($query);
        if ($result !== false)
            {
            $estimations = array();
            while ($row = mysql_fetch_object($result))
                {
                array_push($estimations, new Estimation_Model($row));
                }
            } else
            {
            echo "no estimation for proj id";
            }
        $db->close();
        return $estimations;
        }

    public static function getEst_Id($row)
        {
        if (is_object($row) && is_string($row->est_id))
            {
            $est_id = $row->est_id;
            } else
            {
            return null;
            }
        return $est_id;
        }

    public static function delete($est_id)
        {
        $table = "ESTIMATION";
        $field = "est_id";

        $success = parent::__delete($est_id, $table, $field);

        return $success;
        }

    public static function add($fields)
        {
        $db = new Database();
        $db->connect();
        //format all null variables with ''
        $fields = $db->createSQLVars($fields);

        $db->start();
        //Set insert into ESTIMATION
        $estimation_insert = "INSERT INTO ESTIMATION ("
                . "EST_ID, "
                . "ACT_HR, "
                . "PLN_HR, "
                . "START_DT, "
                . "ACT_END_DT, "
                . "EST_END_DT) "
                . "VALUES( "
                . "NULL,"
                . " '" . $fields[0] . "',"
                . " '" . $fields[1] . "',"
                . " '" . $fields[2] . "',"
                . " '" . $fields[3] . "',"
                . " '" . $fields[4] . "');";
        //Run query and get estimation id.
        $estimation_result = mysql_query($estimation_insert);
        $est_id = $db->getInsertId();
        if ($db->endStatement($estimation_result))
            {
            $estimation = new Estimation_Model($est_id);
            } else
            {
            $estimation = "Error inserting into estimation<br/>";
            }
        $db->close();
        return $estimation;
        }

    }

?>
