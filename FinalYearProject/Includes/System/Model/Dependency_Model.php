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
        //Get the row for the provided id
        $row = $this->get($dpnd_id);

        try
            {
            if (!!!isset($row) || count($row) === 0)
                {
                throw new Exception("NULL");
                }
            $this->dpnd_id = $row['dependency_id'];
            $this->dpnd_on = $row['dependent_on'];
            } catch (Exception $e)
            {
            $var = $e->getMessage();
            //Insert four values of "NULL" into $fields
            $fields = array();
            for ($i = 0; $i !== 2; $i++)
                {
                array_push($fields, $var);
                }
            //Add a new, empty staff object (re-run constructor with id)
            $new = self::add($fields);
            //As the object is empty the only field we need is the DB generated ID
            $this->dpnd_id = $new->dpnd_id();
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
     * Function to return dependency object
     */

    public static function get($dpnd_id)
        {
        $fields = array("DEPENDENCY_ID", "DEPENDENT_ON");
        $dependency = Database_Queries::selectFrom("Dependency_Model", $fields, "dependency", "DEPENDENCY_ID", $dpnd_id);
        $dpnd = Generic_Model::castStdObj($dependency);
        return $dpnd;
        }

    public static function delete($dpnd_id)
        {
        $table = "DEPENDENCY";
        $field = "DEPENDENCY_ID";

        if (!!!is_array($dpnd_id))
            {
            $dpnd_id = array($dpnd_id);
            }
        foreach ($dpnd_id as $var)
            {
            $success = Database_Queries::archive($table, $field, $var);
            if (!!!$success)
                {
                return "Dependency archive failed!<br/>"
                        . "At dependency id: " . $var;
                }
            }
        return true;
        }

    public static function add($fields)
        {
        $db = new Database();
        $db->connect();
        //start transaction
        $taskDpnd_insert = "INSERT INTO dependency ("
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
                $taskDpnd_insert = "INSERT INTO dependency ("
                        . "DEPENDENCY_ID,"
                        . " DEPENDENT_ON)"
                        . " VALUES ("
                        . " '" . $fields[0] . "',"
                        . " '" . $dpnd . "');" . " " . $taskDpnd_insert;
                }
            }
        //Run the query
        $taskDpnd_result = $db->query($taskDpnd_insert);
        $dpnd_id = $db->getInsertId();
        if ($db->endStatement($taskDpnd_result))
            {
            $dependencies = new Dependency_Model($dpnd_id);
            } else
            {
            $dependencies = "Error inserting into dependency database!" . mysqli_error();
            }
        $db->close();
        return $dependencies;
        }
    public static function archive($dp_id)
        {
        $success = Database_Queries::archive("DEPENDENCY", "DEPENDENCY_ID", $dp_id);
        if (!!!$success)
            {
            return "Error archiving staff data!";
            }
        return true;
        }
    public static function update($id, $fields)
        {
        $db = new Database();
        $db->connect();

        //Run update against DEPENDENCY table foreach dependency
        $dpnd_update = "UPDATE DEPENDENCY SET "
                . "DEPENDENCY_ON='" . $fields[0] . "'"
                . "WHERE DEPENDENCY_ID='" . $id . "';";

        if(!!!$db->query($dpnd_update)){
            return "Error updating dependency!";
            }
        
        $db->close();
        return true;
        }

    }
