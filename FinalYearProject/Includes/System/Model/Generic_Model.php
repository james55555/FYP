<?php

/**
 * Description of Generic_Model
 *
 * @author James
 */
abstract class Generic_Model
    {
    /*
     * Function to delete from specified table based on var in field
     * @param (String) $var     Usually an ID to use for deletion of row
     * @param (String) $table   The table to delete from
     * @param (String) $field   The field that the $var exists in
     * @return boolean          If the deletion has been successful then return true
     */

    public static function __delete($var, $table, $field)
        {
        //Trim beginning and end of $var for ' character
        if (is_array($var))
            {
            foreach ($var as $vTrim)
                {
                $var = trim($vTrim, "'");
                }
            } else
            {
            $var = trim($var, "'");
            }
        //Run the query
        $success = Database_Queries::deleteFrom($table, $field, $var);
        //If the query hasn't been succesful then alert.
        if (!$success)
            {
            throw new Exception($table . " table delete error"
            . "<br/>Error: " . mysqli_error());
            }
        return true;
        }

    /*
     * Function to set any String values as NULL (used for insert) to PHP null
     */

    public abstract function setEmptyNull($row);
    /*
     * @abstract set
     * Setter method to set any values to a new value
     * This method cannot be used within this class due to the use of $this->
     * @param (var) $variable 
     */

    public abstract function set($variable, $newValue);
    /*
     * Function to cast stdClass object as an array (used mainly in getObj functions)
     * @param (object) $obj     This is the object to be converted
     * 
     * @return (array) $array   This is the converted object
     */

    public static function castStdObj($obj)
        {
        if (isset($obj) && is_object($obj))
            {
            $array = (array) $obj;
            } else
            {
            $array = $obj;
            }
        return $array;
        }

    }
