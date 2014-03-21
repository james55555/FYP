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

    public static function deleteFrom($table, $colCheck, $paramID)
        {
        $db = new Database();
        $db->connect();

        $paramID = trim($paramID, "'");

        $check = array($table, $colCheck, $paramID);
        $db->filterParameters($check);

        $query = "DELETE FROM " . $check[0]
                . " WHERE " . $check[1]
                . " ='" . $paramID . "'";

        $result = mysql_query($query);
        if ($db->querySuccess($result))
            {
            $this->success = true;
            } else
            {
            $this->success = false;
            }
        $db->close();
        return $this->success;
        }

    }
