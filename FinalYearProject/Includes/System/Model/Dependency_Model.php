<?php

/*
 * Description of Dependency_Model
 *
 * @author James
 */

class Dependency_Model extends Generic_Model
    {

    private $dpnd_id;
    private $dpnd_on;

    public function __construct($dpnd_id)
        {
        $row = $this->get($dpnd_id);
            if(!$row){
                $row = null;
                }
            $this->dpnd_id = $row->DEPENDENCY_ID;
            $this->dpnd_on = $row->DEPENDENT_ON;
            
        }

    public function dpnd_id()
        {
        return $this->dpnd_id;
        }

    public function dpnd_on()
        {
        return $this->dpnd_on;
        }

    public static function get($dpnd_id)
        {
        $columns = array("DEPENDENCY_ID", "DEPENDENT_ON");
        print_r($dpnd_id);
        $dependency = Database_Queries::selectFrom("Dependency_Model", 
                $columns, "DEPENDENCY", "DEPENDENCY_ID", $dpnd_id);
        
        return $dependency;
        }

    public static function delete($dpnd_id)
        {
        $table = "DEPENDENCY";
        $field = "DEPENDENCY_ID";

        $success = parent::__delete($dpnd_id, $table, $field);

        return $success;
        }

    }
