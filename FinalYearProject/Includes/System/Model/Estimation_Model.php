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

    /*
     * This initializes an Estimation_Model object
     * @param (String)  $est_id      Estimation object identifier
     * @param (Bool)    $amConv      Optional param to identify whether American or English format is needed
     */

    public
            function __construct($est_id, $amConv = false)
        {
        try
            {
            $row = $this->get($est_id);
            if (!isset($row))
                {
                throw new Exception("NULL");
                }
            //If the no error has been thrown then continue creating object
            $this->est_id = $row->est_id;
            $this->act_hr = $row->act_hr;
            $this->pln_hr = $row->pln_hr;
            foreach ($row as $key => $val)
                {

                if (substr(strtolower($key), -2) === "dt" &&
                        ($val !== "NULL" && isset($val)))
                    {
                    //Convert String to date for Formatting
                    $dt = DateTime::createFromFormat("Y-m-d", $val);
                    if (!!!$amConv)
                        {
                        //Format the value to British
                        $row->$key = $dt->format("d-m-Y");
                        } else
                        {
                        $row->$key = $dt->format("Y-m-d");
                        }
                    }
                //If the lue hasn't been set then set it to null
                if ($val === '0000-00-00')
                    {
                    $row->$key = null;
                    }
                }
            $this->act_end_dt = $row->act_end_dt;
            $this->start_dt = $row->start_dt;
            $this->est_end_dt = $row->est_end_dt;
            } catch (Exception $e)
            {
            $var = $e->getMessage();
            //Insert four values of "NULL" into $fields
            $fields = array();
            for ($i = 0; $i !== 6; $i++)
                {
                array_push($fields, $var);
                }
            //Add a new, staff object
            $new = $this->add($fields);
            //As the object is empty the only field we need is the DB generated ID
            $this->est_id = $new->est_id();
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

    public function act_end_dt()
        {
        return $this->act_end_dt;
        }

    public function est_end_dt()
        {
        return $this->est_end_dt;
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

        $result = mysqli_query($query);
        if ($result !== false)
            {
            $estimations = array();
            while ($row = mysqli_fetch_object($result))
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
    public static function archive($est_id)
        {
        $success = Database_Queries::archive("ESTIMATION", "EST_ID", $est_id);
        if (!!!$success)
            {
            return "Error archiving staff data!";
            }
        return true;
        }
    public static function delete($est_id)
        {
        $table = "ESTIMATION";
        $field = "est_id";

        $success = Database_Queries::archive($table, $field, $est_id);
        if (!!!$success)
            {
            return "Error archiving Estimation data!!";
            }
        return $success;
        }

    public static function add($fields)
        {
        $db = new Database();
        $db->connect();
        $db->start();
        //If the variable is a date then format it accordingly.
        foreach ($fields as $key => $val)
            {
            if (!!!is_string($val) && !!!is_numeric($val))
                {
                $fields[$key] = $val->format('Y-m-d');
                }
            }
        //Set insert into ESTIMATION
        $estimation_insert = "INSERT INTO estimation ("
                . "EST_ID, "
                . "ACT_HR, "
                . "PLN_HR, "
                . "START_DT, "
                . "ACT_END_DT, "
                . "EST_END_DT) "
                . "VALUES( "
                . "NULL,"
                . " '" . $fields[1] . "',"
                . " '" . $fields[2] . "',"
                . " '" . $fields[3] . "',"
                . " '" . $fields[4] . "',"
                . " '" . $fields[5] . "');";

//Run query and get estimation id.
        $estimation_result = $db->query($estimation_insert);
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
