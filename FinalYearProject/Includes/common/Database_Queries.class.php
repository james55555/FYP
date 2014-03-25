<?php

/**
 * Description of Database_Queries
 *
 * @author James
 */
class Database_Queries
    {
    /*
     * Function to run a dynamic query against connecting tables to return an id
     * @param $model    this should be set to null if only one column is selected, 
     *                  otherwise set to as String to the name of the model.
     * @param $reqCol   this is the collumn to return
     * @param $table    this is the table to run the query against
     * @param $colCheck this is the collumn to check against
     * @param $paramID  this is the provided id to be checked in $colCheck
     * @return  $col    this is the required value corresponding with $paramID in $reqCol
     */

    public static function selectFrom($model, $reqCol, $table, $colCheck, $paramID)
        {
        $db = new Database();
        $db->connect();
        //Ensure paramaters are set up correctly
        $check = array($reqCol, $table, $colCheck, $paramID);
        $db->filterParameters($check);

        $query = "SELECT distinct " . $check[0]
                . " FROM " . $check[1]
                . " WHERE " . $check[2]
                . "='" . $check[3] . "'";
        $result = mysql_query($query);
        if ($db->querySuccess($result))
            {
            $row = mysql_fetch_object($result);
            if (!isset($model))
                {
                if (is_object($row))
                    {
                    $col = $row->$reqCol;
                    } else
                    {
                    return null;
                    }
                } else
                {
                if (is_object($row))
                    {
                    $col = new $model($row);
                    } else
                    {
                    return null;
                    }
                }

            $db->close();
            return $col;
            } //End of query success
        else
            {
            throw new Exception("mysql error: " . mysql_error());
            }
        }

        /*
         * Functon to delete from one table using one id
         * @param $table (String)       Name of table to delete from
         * @param $colCheck (String)    Name of column to check field in
         * @param $paramID (int)        Field to check in column
         * @return (boolean)    Field to represent whether query has been successful or not
         */
    public static function deleteFrom($table, $colCheck, $paramID, $setQuery)
        {
        $db = new Database();
        $db->connect();

        if(!isset($setQuery)){
        $paramID = trim($paramID, "'");

        $check = array($table, $colCheck, $paramID);
        $db->filterParameters($check);

        //Query uses a transactional statement to allow rollback if 
        //scaled to an automated process
        $query = "START TRANSACTION;"
                . "DELETE FROM " . $check[0]
                . " WHERE " . $check[1]
                . " ='" . $check[2] . "';"
                . "COMMIT;";
        }
        else {
            $query = $setQuery;
            }
        $result = mysql_query($query);
        if ($db->querySuccess($result))
            {
            $success = true;
            } else
            {
            $success = false;
            }
        $db->close();
        return $success;
        }
        /*
         * Delete query to return delete string for transactional SQL statements
         * @param $table (String)       Name of table to delete from
         * @param $colCheck (String)    Column to use for id cross-referencing
         * 
         * @return $query (String)      Query string to return 
         */
        public static function deleteFrom_String($table, $colCheck)
            {
            $db = new Database();
            $check = array($table, $colCheck);
            
            $db->filterParameters($check);
            $query = "DELETE FROM " . $check[0] .
                    " WHERE " . $check[1];
            
            return $query;
            }
    }
