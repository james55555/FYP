<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Estimation_Model
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
    private $est_id;

    public
            function __construct($row)
        {
        $this->est_id = $row->est_id;
        $this->act_hr = $row->act_hr;
        $this->pln_hr = $row->pln_hr;
        $this->start_dt = $row->start_dt;
        $this->act_end_dt = $row->act_end_dt;
        $this->est_end_dt = $row->est_end_dt;
        $this->tsk_id = Task_Model::getTask($row->tsk_id());
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
        return $this->start_hr;
        }

    public function act_end_dt()
        {
        return $this->act_end_hr;
        }

    public function est_end_dt()
        {
        return $this->est_end_hr;
        }

    public function est_id()
        {
        return $this->est_id;
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

//  Query returns all estimation models for all associated tasks whcih are associated with projects which are associated with users in the current session

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
            echo var_dump($result) . "<br/>";
            $estimations = array();
            echo var_dump($estimations) . "<br/>";
            while ($row = mysql_fetch_object($result))
                {
                array_push($estimations, new Estimation_Model($row));
                }
            }
        else
            {
            echo "no estimation for proj id";
            }
        $db->close();
        return $estimations;
        }

    }

?>
