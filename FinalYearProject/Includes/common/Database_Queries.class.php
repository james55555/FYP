<?php

/**
 * Description of Database_Queries
 *
 * @author James
 */
class Database_Queries extends Database
    {
    /*
     * Function to run a dynamic query against connecting tables to return an id
     * @param $model    this should be set to null if only one column is selected, 
     *                  otherwise set to as String to the name of the model.
     * @param $reqCol   this is the collumn to return
     * @param $table    this is the table to run the query against
     * @param $colCheck this is the collumn to check against
     * @param $paramID  this is the provided id to be checked in $colCheck
     * 
     * @return  $result this is the required row(s) or value corresponding with $paramID in $reqCol
     * @return null     null result is returned if query has failed
     */

    public static function selectFrom($model, $reqCol, $table, $colCheck, $paramID)
        {
        $db = new Database();
        //Ensure paramaters are set up correctly
        $filter = array($reqCol, $table, $colCheck, $paramID);
        $check = $db->filterParameters($filter);
        if (is_array($check[0]))
            {
            $check[0] = implode(", ", $check[0]);
            }
        $query = "SELECT distinct " . $check[0]
                . " FROM " . $check[1]
                . " WHERE " . $check[2]
                . "='" . $check[3] . "'";

        //Process result and return object
        $result = Database_Queries::processResult($query, $model);
        return $result;
        }

    private static function processResult($query, $model)
        {
        $db = new Database();
        $db->connect();
        $result = mysql_query($query);
        //If the query returns successful then
        if ($db->querySuccess($result))
            {
            //if the query returns one row
            if (mysql_num_rows($result) === 1)
                {
                $row = mysql_fetch_object($result);
                }//End of mysql num rows === 1
            elseif (mysql_num_rows($result) > 1)
                {
                $objects = array();
                while ($row = mysql_fetch_object($result))
                    {
                    array_push($objects, new $model($row));
                    }
                $db->close();
                return $objects;
                }//End of mysql num rows > 1
            else
                {
                return null;
                }
            }//End of query success
        else
            {
            throw new Exception("Query Error: " . mysql_error());
            }
        $db->close();
        return $row;
        }

//End of class

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

        if (!isset($setQuery))
            {
            $paramID = trim($paramID, "'");

            $check = array($table, $colCheck, $paramID);
            $db->filterParameters($check);
            //Before any deletes are run, archive the data

            $archSuccess = self::archive($check[0], $check[1], $check[2]);
            if (!$archSuccess)
                {
                return false;
                }
//Query uses a transactional statement to allow rollback if 
//scaled to an automated process
            $query = "DELETE FROM " . $check[0]
                    . " WHERE " . $check[1]
                    . " ='" . $check[2] . "';";
            } else
            {
            $query = $setQuery;
            }
        echo "<br/> {$query} </br>";
        //Start the delete transaction 
        mysql_query("START TRANSACTION;");
        //Run the query to delete
        $result = mysql_query($query);
        //Assign true or false based on returned result
        $success = $db->querySuccess($result);
        if ($success)
            {
            mysql_query("COMMIT;");
            } else
            {
            mysql_query("ROLLBACK;");
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

        /*
         * 
         */
    public static function archive($table, $colCheck, $id)
        {
        $db = new Database();
        $db->connect();
        //Start transaction to archive data
        mysql_query("START TRANSACTION;");
        //Chec if the project exists in PROJECT
        $rowExists = mysql_query("SELECT COUNT(*)"
                . " FROM " . $table
                . " WHERE " . $colCheck
                . " ='" . $id . "';");
        if (mysql_num_rows($rowExists) === 0)
            {
            $tableFields = mysql_list_fields("ARCHIVE", $table);
            //Set up archive query insert
            $archive_query = "INSERT INTO archive." . $table
                    . " (SELECT " . $tableFields
                    . " FROM " . $table
                    . " WHERE " . $colCheck
                    . " ='" . $id . "');";

            $archive_result = mysql_query($archive_query);
            } else
            {
            $archive_result = null;
            }

        //Validate whether these queries have returned expected results
        if ($archive_result)
            {
            mysql_query("COMMIT;");
            $success = true;
            } elseif (!isset($archive_result) || !$archive_result)
            {
            mysql_query("ROLLBACK;");
            $success = false;
            } else
            {
            throw new Exception("This shouldn't happen");
            }
        $db->close();
        return $success;
        }

    }
