<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectEstimation_Model
 *
 * @author James
 */
class ProjectEstimation_Model extends Estimation_Model
    {

    private $proj_id;
    private $est_id;

    public function __construct($row)
        {
        $this->est_id = $row->est_id;
        $this->proj_id = $row->proj_id;
        }

    public function proj_id()
        {
        return $this->proj_id;
        }

    public function est_id()
        {
        return $this->est_id;
        }

    public static function getEstimationId($proj_id)
        {
        $columns = array("proj_id", "est_id");
        $estimate = Database_Queries::selectFrom("Estimation_Model", $columns, "PROJECT_ESTIMATION", 
                "PROJ_ID", $proj_id);
        $est_id = $estimate->est_id;
        return $est_id;
        }
        
       public static function delete($est_id)
        {
        
    $table = "PROJECT_ESTIMATION";
    $field = "est_id";
        $success = Generic_Model::__delete($est_id, $table, $field);
        return $success;
        }

    }
