<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: Task_Estimation
#@author: James

class TaskEstimation_Model extends Estimation_Model
    {

    private $tsk_id;
    private $est_id;

    public function __construct($row)
        {
        $this->est_id = $row->est_id;
        $this->tsk_id = $row->tsk_id;
        }

    public function tsk_id()
        {
        return $this->tsk_id;
        }

    public function est_id()
        {
        return $this->est_id;
        }

    public static function getEstimationId($tsk_id)
        {
        $row = Database_Queries::selectFrom(null, "est_id", 
                "TASK_ESTIMATION", "tsk_id", $tsk_id);
        
        $est_id = $row->est_id;
        return $est_id;
        }
        /*$db = new Database();
        $db->connect();
        
        $query = "SELECT distinct est_id"
                . " FROM task_estimation"
                . " WHERE tsk_id='" . $tsk_id . "'";


        if ($db->querySuccess($query))
            {
            $result = mysql_query($query);

            $row = mysql_fetch_object($result);

            if (is_object($row))
                {
                $est_id = $row->est_id;
                var_dump($est_id);
                } else
                {
                return null;
                }

            $db->close();

            return $est_id;
         
         
            }*/

    public static function delete($tsk_id)
        {
        $table = "TASK_ESTIMATION";
        $field = "tsk_id";

        //Run deletion with passed parameters
        $success = Generic_Model::__delete($tsk_id, $table, $field);

        return $success;
        }

    }

?>