<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
            $DB_nm = 'FYP';

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
                    $array[$key] = mysql_real_escape_string($array[$key]);
                    }
                }
            // Check if the parameter is a string
            if (is_string($array))
                {
                // If it is, perform a  mysql_real_escape_string on the parameter
                $array = mysql_real_escape_string($array);
                }
            // Return the filtered result
            return $array;
            }
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
