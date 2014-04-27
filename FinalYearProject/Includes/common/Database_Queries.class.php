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
     * @param $min      this is the min limit value - used for pagination
     * @param $max      this is the max limit value - used for pagination
     * 
     * @return  $result this is the required row(s) or value corresponding with $paramID in $reqCol
     * @return null     null result is returned if query has failed
     */

    public static function selectFrom($model, $reqCol, $table, $colCheck,
            $paramID, $operand = "=", $num = 0, $asc = true)
        {
        $db = new Database();
        $db->connect();
        //Ensure paramaters are set up correctly
        $filter = array($reqCol, $table, $colCheck, $paramID);
        $check = $db->filterParameters($filter);
        if (is_array($check[0]))
            {
            $check[0] = strtolower(implode(", ", $check[0]));
            } else
            {
            $check[0] = strtolower($check[0]);
            }
        if (is_object($check[3]))
            {
            if (property_exists($check[3], $colCheck))
                {
                $colCheck = strtolower($colCheck);
                $id = $check[3]->$colCheck;
                } else
                {
                $id = $check[3]->strtolower($colCheck);
                }
            } elseif (is_array($check[3]))
            {
            $id = strtolower($check[3][0]);
            } else
            {
            $id = strtolower($check[3]);
            }
        //Format vars for insert
        $qId = "'$id'";
        //If limit is 0 then return unlimited
        $limit = $num === 0 ? '' : "LIMIT $num";
        $query = "SELECT distinct " . $check[0]
                . " FROM " . $check[1]
                . " WHERE " . $check[2]
                . $operand . $qId
                . " " . $limit . ";";
        //Process result and return object
        $result = Database_Queries::processResult($query, $model);

        return $result;
        }

    private static function processResult($query, $model)
        {
        $db = new Database();
        $db->connect();
        $result = mysqli_query($db->getConn(), $query);
        try
            {
            //If the query returns successful then
            if ($db->querySuccess($result))
                {
                //if the query returns one row
                if (mysqli_num_rows($result) === 1)
                    {
                    $row = mysqli_fetch_object($result);
                    }//End of mysql num rows === 1
                elseif (mysqli_num_rows($result) > 1)
                    {
                    $objects = array();
                    while ($row = mysqli_fetch_object($result))
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
                throw new Exception("Query Error: " . mysqli_error() .
                "<br/>Query: " . $query);
                }
            } catch (Exception $e)
            {
            echo $e->getMessage();
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

    public static function deleteFrom($table, $colCheck, $paramID,
            $setQuery = null)
        {
        $db = new Database();
        $db->connect();
        if (!isset($setQuery) && isset($paramID))
            {
            //Filter the variables
            $paramID = trim($paramID, "'");

            $filter = array($table, $colCheck, $paramID);
            $check = $db->filterParameters($filter);
            //Before any deletes are run, archive the data
            $archSuccess = self::archive($check[0], $check[1], $check[2]);
            if (!$archSuccess)
                {
                echo "<br/>" . $table . " was already archived.<br/>";
                }
            //Reconnect to the database
            $db->connect();

            //Query uses a transactional statement to allow rollback if 
            //scaled to an automated process
            $query = " DELETE FROM " . $check[0]
                    . " WHERE " . $check[1]
                    . " ='" . $check[2] . "'; ";
            //If a query has been provided run that.
            } elseif (isset($setQuery))
            {
            $query = $setQuery;
            }
        //If paramID isn't set then there is nothing in the table to delete
        elseif (!isset($paramID))
            {
            return true;
            }
        //Start the delete transaction 
        $db->start();
        //Run the query to delete
        $result = $db->query($query);

        //Assign true or false based on returned result
        $success = $db->endStatement($result);
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
     * Function to archive data
     * @param $table (String)       This is the table data is being taken from
     * @param $colCheck (String)    This is the column in which the identifier is stored
     * @param $id (String)          This is the field to be searched in $colCheck
     * 
     * @return boolean  This is either true or false depending on whether the query has been rolled back or not.
     */

    public static function archive($table, $colCheck, $id)
        {
        $db = new Database();
        $db->connect();
        //Start transaction to archive data
        $db->start();
        //Check if the row alreadys exists in PROJECT in ARCHIVE DB
        $rowExists = $db->query(" SELECT *"
                . " FROM ARCHIVE." . $table
                . " WHERE " . $colCheck
                . " ='" . $id . "'; ");
        //The statement to identify if it exists
        if (mysqli_num_rows($rowExists) === 0)
            {
            $fields = array();
            $sql_fields = mysqli_fetch_fields($rowExists);
            foreach ($sql_fields as $field)
                {
                array_push($fields, $field->name);
                }
            //Insert null value to be updated to current timestamp
            array_push($fields, "NULL");
            //Implode array components for use in query string
            $tableFields = implode(", ", $fields);
            //Set up archive query insert
            $archive_query = "INSERT INTO ARCHIVE." . $table
                    . " (SELECT " . $tableFields
                    . " FROM " . $table
                    . " WHERE " . $colCheck
                    . " ='" . $id . "')"
                    . " ON DUPLICATE KEY UPDATE "
                    . $colCheck . "='" . $id . "';";

            $archive_result = mysqli_query($db->getConn(), $archive_query);
            } else
            {
            $archive_result = null;
            }
        //Validate whether these queries have returned expected results
        if ($archive_result)
            {
            $db->commit();
            } elseif (!isset($archive_result) || !$archive_result)
            {
            $db->rollback();
            } else
            {
            throw new Exception("This shouldn't happen");
            }
        $db->close();
        return true;
        }

    }
