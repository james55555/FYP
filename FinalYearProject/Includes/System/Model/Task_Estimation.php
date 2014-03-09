<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: Task_Estimation
#@author: James

class Task_Estimation
    {

    private $tsk_id;
    private $est_id;

    public static function __construct($row)
        {
        $this->tsk_id = $row->tsk_id;
        $this->est_id = $row->est_id;
        }

    public function tsk_id()
        {
        return $this->tsk_id;
        }

    public function est_id()
        {
        return $this->est_id;
        }

    public function getEstimation($tsk_id)
        {
        $db = new Database();
        $db->connect();

        $query = "SELECT est_id FROM task_estimation"
                . " WHERE tsk_id='" . $tsk_id . "'";
        $result = mysql_result($query);

        if ($db->querySuccess($result) && mysql_num_rows($result) === 1)
            {
            $row = mysql_fetch_object($result);
            $estimation = Estimation_Model::get($row);
            }
            else    {
                return false;
                }
        return $estimation;
        }

    }

?>