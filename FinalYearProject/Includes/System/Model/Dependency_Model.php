<?php

/*
 * Description of Dependency_Model
 *
 * @author James
 */

class Dependency_Model
    {

    private $dpnd_id;
    private $dpnd_on;

    public function __construct($row)
        {
        if (isset($row))
            {
            $this->dpnd_id = $row->DEPENDENCY_ID;
            $this->dpnd_on = $row->DEPENDENT_ON;
            }
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
        $dependency = Database_Queries::getOneCol($columns, "DEPENDENCY", "DEPENDENCY_ID", $dpnd_id);
        return $dependency;
        }

    }