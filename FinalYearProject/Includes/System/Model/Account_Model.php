<?php

/**
 *  Class to model the system side user account
 *  Used mainly for logging into the system
 * 
 *      @author James Graham
 */
class Account_Model
    {

    //instantiate variables from ACCOUNT
    private
            $accCreate_ts;
    private
            $userId;
    private
            $first_nm;
    private
            $last_nm;
    private
            $email_addr;
    private
            $password;

    /*
     *  Constructor to initialize object from a MySQL user_id and password
     * @param object row
     */

    public
            function __construct($row)
        {
        $this->userId = $row->user_id;
        $this->password = $row->password;
        $this->first_nm = $row->first_nm;
        $this->last_nm = $row->last_nm;
        $this->email_addr = $row->email_addr;
        $this->accCreate_ts = $row->acc_create_ts;
        }

    public
            function userId()
        {
        return $this->userId;
        }

    public
            function password()
        {
        return $this->password;
        }

    public
            function first_nm()
        {
        return $this->first_nm;
        }

    public
            function last_nm()
        {
        return $this->last_nm;
        }

    public
            function email_addr()
        {
        return $this->email_addr;
        }

    public
            function accCreate_ts()
        {
        return $this->accCreate_ts;
        }

    /*
     * Get a user by their id
     * @param String $accId
     * @return object acc
     */

    public static
            function getUser($accId)
        {
        $db = new Database();
        $db->connect();


        $query = "SELECT user_id, acc_create_ts, password,"
                . " first_nm, last_nm, email_addr"
                . " FROM ACCOUNT"
                . " WHERE user_id='" . $accId . "'";


        /* Run query against database
         * @var $result type 
         */
        $qResult = mysql_query($query);

        //Verify that the query has returned a user
        if (mysql_num_rows($qResult) === 1)
            {
            //Assign object to @var $row
            $row = mysql_fetch_object($qResult);
            //Create new Account_Model using information in the database.
            $accId = new Account_Model($row);
            }

        //If query is doesn't query successfully or doesn't return a user then return false.
        else
            {
            $accId = null;
            }

        //Close databse and return the user object.
        $db->close();
        return $accId;
        }

    /*
     * Function to validate registration server side and 
     * add new user to the database
     * @return String
     */

    public static
            function addUser($registrationFields)
        {
        /*
         * Assign array variables to abbreviations for later use
         */
        $registrationFields = array();

        $user_id = $registrationFields['user_id'];
        $password = $registrationFields['password'];
        $fName = $registrationFields['fname'];
        $lName = $registrationFields['lname'];
        $email = $registrationFields['email'];

        //Set up the database connection and validate the user entered fields.
            $db = new Database();
            $db->connect();
            $db->filterParameters($registrationFields);
        /*
         * Field Validation
         */

        $arrayError = array(
            //User ID Validation
            //String length needs to be between 1 and 25
            $this->variableCheck($user_id, 'string', 25),
            //Password Validation
            //String length needs to be between 1 and 25
            $this->variableCheck($password, 'string', 25),
            //First Name Validation
            //String length needs to be between 1 and 30
            $this->variableCheck($fName, 'string', 30),
            //Last Name Validation
            //String length needs to be between 1 and 30
            $this->variableCheck($lName, 'string', 30),
            //Email Address Validation
            //String length needs to be between 1 and 50
            $this->variableCheck($email, 'string', 50),
        );
        //Strip array of all null values (i.e. those inserted by variableCheck)
        $errors = array_filter($arrayError, 'strlen');
        //If no erros have been logged in the array then add the user to the database
        if (count($errors) === 0)
            {
           
            $query = "INSERT INTO account" .
                    " (`user_id`, `acc_create_ts`, `password`, `first_nm`, "
                    . " `last_nm`, `  email_addr`)"
                    . " VALUES ("
                    . $user_id . "','"
                    . "CURRENT_TIMESTAMP,'"
                    . $password . "','"
                    . $fName . "','"
                    . $lName . "','"
                    . $email . "')";

            $result = mysql_query($query);
            if (!$db->querySuccess($result))
                {
                echo "Error inserting data into database."
                . "MYSQL Error: " . mysql_error();
                                }
            } else
            {
            return $errors;
            }
            return true;
        }

    /*
     * This function can be used to validate a variable
     * @access private
     * 
     * @param String $string    : This is the name of the variable
     * @param String $type      : This is the variable type
     * @param int $length       : This is the maximum length of a variable
     * 
     * @return boolean
     * 
     *  (Waterson, 2013)
     */

    protected static function variableCheck($string, $type, $length)
        {

        // assign the type
        $type = 'is_' . $type;
        $errors = array();

        if (!$type($string))
            {
            $errors[] = "String and type don't match for: " . $string;
            }
        // now we see if there is anything in the string
        elseif (empty($string) || $string === '')
            {
            $errors[] = "Ensure " . $string . " is filled in!";
            }
        // then we check how long the string is
        elseif (strlen($string) > $length)
            {
            $errors[] = $string . "cannot be more than " . $length . " characters long!";
            }
        //then check if the values contain any unwanted characters
        elseif (preg_match("/[0-9A-Za-z]/", $string) === 0)
            {
            $errors[] = $string . " can only contain letters and numbers.";
            }
        //if there are no errors don't insert value
        else
            {
            // if all is well, we return TRUE
            return null;
            }
        }

    }
