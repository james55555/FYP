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
     * @param $reqCol   this is the collumn to return
     * @param $table    this is the table to run the query against
     * @param $colCheck this is the collumn to check against
     * @param $paramID  this is the provided id to be checked in $colCheck
     * @return  $col    this is the required value corresponding with $paramID in $reqCol
     */

    public static function selectFrom($reqCol, $table, $colCheck, $paramID)
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
        if ($db->querySuccess($query))
            {
            $result = mysql_query($query);
            $row = mysql_fetch_object($result);
            if (is_object($row))
                {
                $col = $row->$reqCol;
                } else
                {
                return null;
                }
            $db->close();
            return $col;
            } //End of query success
        else
            {
            throw new Exception("mysql error: " . mysql_error());
            }
        }

    }
