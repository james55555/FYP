<?php

/*
 *  Class to model the system side user account
 *  Used mainly for logging into the system
 * 
 *      @author James Graham
 */

class Account_Model extends Validator_Model
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
    private 
            $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
    /*
     *  Constructor to initialize object from a MySQL user_id and password
     * @param object row
     */

    public
            function __construct($row)
        {
        $this->userId = $row->user_id;
        //64-bit password encryption
        $this->password = hash("sha256", $row->password . $this->salt);
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
        $db->filterParameters($accId);
        
        
        
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

        //Set up the database connection and validate the user entered fields.
        $db = new Database();
        $db->connect();
        $db->filterParameters($registrationFields);

        //Assign array variables to abbreviations for later use
        $user_id = $registrationFields['user_id'];
        $password = $registrationFields['password'];
        $fName = $registrationFields['fname'];
        $lName = $registrationFields['lname'];
        $em = $registrationFields['email'];

        //Validate variables
        $valid = Account_Model::validateArray($registrationFields);
        if (is_array($valid))
            {
            return $valid;
            }
        $existingQuery = "SELECT user_id"
                . " FROM account"
                . " WHERE user_id='" . $user_id . "'";

        $testQuery = mysql_query($existingQuery);
        if ($db->querySuccess($testQuery))
            {
            //Number of entries with that username
            $numExisting = mysql_num_rows($testQuery);
            } else
            {
            return "query error... " . mysql_error();
            }
            if ($numExisting === 0)
                {
                if(empty($em)){
                    $em = "NULL";
                    }
                $insert = "INSERT INTO account" .
                        " (`user_id`, `acc_create_ts`, `password`, `first_nm`, "
                        . " `last_nm`, `email_addr`)"
                        . " VALUES ('"
                        . $user_id . "',"
                        . "CURRENT_TIMESTAMP,'"
                        . $password . "','"
                        . $fName . "','"
                        . $lName . "','"
                        . $em . "')";

                $result = mysql_query($insert);
                if (!$db->querySuccess($result))
                    {
                    return "Error inserting data into database."
                            . "MYSQL Error: " . mysql_errno()
                            . "<br/> MYSQL details: " . mysql_error();
                    }
                } else
                {
                return "Username already exists";
                }
           return true;
        }

    /*
     * Helper method to loop through array and validate fields
     * @param registration fields
     */

    private static function validateArray($registrationFields)
        {
        //Set var validation variables
        $type = "String";
        $validated = null;

        foreach ($registrationFields as $field => $content)
            {
            if ($field === "user_id")
                {
                $length = 25;
                $field = "Username";
                } elseif ($field === "password")
                {
                $length = 25;
                $field = "Password";
                } elseif ($field === "fname")
                {
                $length = 30;
                $field = "first name";
                } elseif ($field === "lname")
                {
                $length = 30;
                $field = "last name";
                } elseif ($field === "email")
                {
                $field = "Email";
                $validated = Validator_Model::validateEmail($content, $field);
                }
            if ($validated !== null)
                {
                $validated = Validator_Model::variableCheck($field, $content, $type, $length);
                }

            if (isset($validated))
                {
                return $validated;
                }
            }
        }

    }

?>
