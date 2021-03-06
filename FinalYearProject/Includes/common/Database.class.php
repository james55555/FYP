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
            $DB_user = 'root';
    private
            $DB_pwd = '';
    private
            $DB_nm = 'grahamj1';

    /*
     * Connect to database
     */

    public //static
            function connect()
        {
        try
            {
            if (!!!$this->conn = 
                    mysqli_connect($this->DB_server, $this->DB_user, $this->DB_pwd, $this->DB_nm))
                {
                throw new Exception("Unable to connect: " . mysqli_connect_error());
                }
                if(is_resource($this->conn)){
                    mysqli_select_db($this->DB_nm, $this->conn) or die("Unable to Select Database \n" . mysqli_connect_error());
                }
            
            } catch (Exception $e)
            {
            //Ensure connect doesn't enter a non-exitable loop
            $i = 1;
            if ($i === 2)
                {
                die($e->getMessage());
                }
            $i++;
            //If caught once, try remote server credentials
            $this->DB_user = "grahamj1";
            $this->DB_pwd = "Water+Spider";
            $this->connect();
            }
        }

    /*
     * Function to close database connection
     */

    public
            function close()
        {
        try
            {
            if (!!!mysqli_close($this->conn))
                {
                throw new Exception("Error closing database!");
                }
            $this->conn = null;
            } catch (Exception $e)
            {
            $this->registry->View_Template->showError($e->getMessage(), "Contact your administrator");
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
                    $tempKey = trim(mysqli_real_escape_string($this->conn, $array[$key]), "'");
                    $array[$key] = htmlspecialchars($tempKey);
                    }
                }
            // Check if the parameter is a string
            if (is_string($array))
                {
                // If it is, perform a  mysqli_real_escape_string on the parameter
                $temp = trim(mysqli_real_escape_string($this->conn, $array), "'");
                $array = htmlspecialchars($temp);
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
        return mysqli_insert_id($this->conn);
        }

    /*
     * Transaction functions to centralize common statement
     */

    public function start()
        {
        mysqli_query($this->conn, "START TRANSACTION;");
        }

    public function commit()
        {
        mysqli_query($this->conn, "COMMIT;");
        }

    public function rollback()
        {
        mysqli_query($this->conn, "ROLLBACK;");
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

    /*
     * Function to run query and return either result or error message
     * @param (String) $query   This is a string containing the query
     * 
     * @return $result          If there is an SQL error then this is an error string
     *                          Else it is the query result
     */

    public function query($query)
        {
        $result = mysqli_query($this->conn, $query);
        if (!!!$this->querySuccess($result))
            {
            $result = false;
            }
        return $result;
        }

    /*
     * Get current status of connection
     * **Used for testing purposes
     */
    /*
     * Function to get mysql error
     * 
     * @return (String) $error
     */

    public function getMysql_err()
        {
        if (isset($this->conn))
            {
            return mysqli_error($this->conn);
            } else
            {
            return "This connection isn't set";
            }
        }

    public function getConn()
        {
        return $this->conn;
        }

    /*
     * Functioin to return the affected rows by either an update or delete
     * 
     * @return (int) $num   Rows affected
     */

    public function getAffectedRows()
        {
        return mysqli_affected_rows($this->conn);
        }

    /*
     * Function to ascertain success of mysqli_result 
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
