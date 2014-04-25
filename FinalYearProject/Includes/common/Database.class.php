<?php

/**
 * Description of Database_Instance
 *
 * @author grahamj1
 */
class Database
    {

    //Database Connection
    protected $conn;
    //Database connection information
    private
            $DB_server = 'localhost';
    private
            $DB_user = 'grahamj1';
    private
            $DB_pwd = 'Water+Spider';
    private
            $DB_nm = 'grahamj1';

    /*
     * Connect to database
     */

    public //static
            function connect()
        {

        $this->conn = mysql_connect($this->DB_server, $this->DB_user, $this->DB_pwd, true) or die("Unable to Connect to MySQL\n" . mysqli_connect_error());
        if (is_resource($this->conn))
            {
            mysql_select_db($this->DB_nm, $this->conn) or die("Unable to Select Database \n" . mysqli_connect_error());
            }
        }

    /*
     * Function to close database connection
     */

    public
            function close()
        {
        if (mysql_ping() !== null)
            {
            if (mysql_close($this->conn))
                {
                $this->conn = null;
                }
            } else
            {
            throw new Exception("Error closing database!");
            }
        }

    /*
     * Created by: Stefan van Beusekom
     * Created on: 31-01-2011
     * Description: A method that ensures safe data entry, and accepts either strings or arrays. If the array is multidimensional, 
     *                     it will recursively loop through the array and make all points of data safe for entry.
     * parameters: string or array;
     * return: string or array;
     * (van Beusekom, 2011)
     */

    public function filterParameters($array)
        {

        // Check if the parameter is an array
        if (is_array($array))
            {
            // Loop through the initial dimension
            foreach ($array as $key => $value)
                {
                // Check if any nodes are arrays themselves
                if (is_array($array[$key]))
                    {
                    // If they are, let the function call itself over that particular node
                    $array[$key] = $this->filterParameters($array[$key]);
                    }
                // Check if the nodes are strings
                if (is_string($array[$key]))
                    {
                    // If they are, perform the real escape function over the selected node
                    $array[$key] = trim(mysql_real_escape_string($array[$key]), "'");
                    }
                }
            // Check if the parameter is a string
            if (is_string($array))
                {
                // If it is, perform a  mysql_real_escape_string on the parameter
                $array = trim(mysql_real_escape_string($array), "'");
                }
            // Return the filtered result
            return $array;
            }
        }

    /**
     * Function to get the auto increment id of the last inserted row.
     * @return integer
     */
    public function getInsertId()
        {
        return mysql_insert_id($this->conn);
        }

    /*
     * Transaction functions to centralize common statement
     */

    public function start()
        {
        mysql_query("START TRANSACTION;");
        }

    public function commit()
        {
        mysql_query("COMMIT;");
        }

    public function rollback()
        {
        mysql_query("ROLLBACK;");
        }

    public function endStatement($result)
        {
        if ($result)
            {
            $this->commit();
            return true;
            } else
            {
            $this->rollback();
            return false;
            }
        }

    public function createSQLVars($fields)
        {
        foreach ($fields as $field)
            {
            $field = "'" . $field . "'";
            }
            return $fields;
        }

    /*
     * Function to run query and return either result or error message
     * @param (String) $query   This is a string containing the query
     * 
     * @return $result          If there is an SQL error then this is an error string
     *                          Else it is the query result
     */

    public function query($query)
        {
        $result = mysql_result(mysql_query($query, $this->conn));
        if (!$this->querySuccess($result))
            {
            $result = mysql_error($this->conn);
            }
        return $result;
        }

    /*
     * Get current status of connection
     * **Used for testing purposes
     */

    public function getConn()
        {
        return $this->conn;
        }

    /*
     * Function to ascertain success of mysql_result 
     * (Convert mysql result into boolean)
     *  If the @param is false then there has been an issue running the query
     *                          Therefore return boolean false
     *  If the query produces a mysql resource then it has been successful
     *                          Therefore retun boolean true
     * @param mysql resource - This will either be false or a mysql resource                   
     * @return boolean success
     */

    public
            function querySuccess($result)
        {
        //if the result of the query is true (i.e. has returned without fail)
        //then assign @boolean success true 
        if ($result === false)
            {
            $success = false;
            }
        //else echo the error and return @boolean success false
        else
            {

            $success = true;
            }
        return $success;
        }

    }

?>
