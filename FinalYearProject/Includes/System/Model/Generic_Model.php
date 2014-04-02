<?php

/**
 * Description of Generic_Model
 *
 * @author James
 */
class Generic_Model
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
        $var = trim($var, "'");
        //Run the query
        $success = Database_Queries::deleteFrom($table, $field, $var, null);
        //If the query hasn't been succesful then alert.
        if (!$success)
            {
            throw new Exception($table . "table delete error: " . print_r($success)
            . "<br/>Query: " . mysql_error());
            }
        return true;
        }

    }
