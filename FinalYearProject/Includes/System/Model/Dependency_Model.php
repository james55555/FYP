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
        try
            {
            if (!isset($row))
                {
                throw new Exception("NULL");
                }
            $this->dpnd_id = $row->DEPENDENCY_ID;
            //If there is more than one dependency then add to an array
            if (is_array($row))
                {
                $dependencies = array();
                foreach ($row as $id => $dpnd)
                    {
                    if ($dpnd === "NULL")
                        {
                        $this->set($id, null);
                        }
                    array_push($dependencies, $dpnd);
                    }
                $this->dpnd_on = $dependencies;
                } else
                {
                $this->dpnd_on = $row->DEPENDENT_ON;
                }
            } catch (Exception $e)
            {
            $var = $e->getMessage();
            //Insert four values of "NULL" into $fields
            $fields = array();
            for ($i = 0; $i !== 2; $i++)
                {
                array_push($fields, $var);
                }
            //Add a new, empty staff object
            $this->add($fields);
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
     * Function to return dependency object
     */

    public static function get($dpnd_id)
        {
        $fields = array("DEPENDENCY_ID", "DEPENDENT_ON");
        $dependency = Database_Queries::selectFrom("Dependency_Model", $fields, "DEPENDENCY", "DEPENDENCY_ID", $dpnd_id);

        return $dependency;
        }

    public static function delete($dpnd_id)
        {
        $table = "DEPENDENCY";
        $field = "DEPENDENCY_ID";

        $success = parent::__delete($dpnd_id, $table, $field);

        return $success;
        }

    public static function add($fields)
        {
        $db = new Database();
        $db->connect();
        //format all null variables with ''
        $db->createSQLVars($fields);
        //start transaction
        $taskDpnd_insert = "INSERT INTO DEPENDENCY ("
                . "DEPENDENCY_ID,"
                . " DEPENDENT_ON)"
                . " VALUES ("
                . " '" . $fields[0] . "',"
                . " '" . $fields[1] . "');";
        if (is_array($fields[1]))
            {
            foreach ($fields[1] as $dpnd)
                {
                $db->start();
                $taskDpnd_insert = "INSERT INTO DEPENDENCY ("
                        . "DEPENDENCY_ID,"
                        . " DEPENDENT_ON)"
                        . " VALUES ("
                        . " '" . $fields[0] . "',"
                        . " '" . $dpnd . "');" ." " . $taskDpnd_insert;
                }
            }
        //Run the query
        $taskDpnd_result = mysql_query($taskDpnd_insert);
        $dpnd_id = $db->getInsertId();
        if ($db->endStatement($taskDpnd_result))
            {
            $dependencies = new Dependency_Model($dpnd_id);
            } else
            {
            $dependencies = "Error inserting into dependency database!" . mysql_error();
            }
        $db->close();
        return $dependencies;
        }

    }
