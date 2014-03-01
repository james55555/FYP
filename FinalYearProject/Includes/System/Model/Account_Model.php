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
            {
            $query = "SELECT * FROM ACCOUNT
                     WHERE user_id='" . $accId . "'";
            if ($db->querySuccess($query))
                {
                // var_dump('vardump db:' .$db);

                /* @var $result type */
                $qResult = mysql_query($query);
                }
            else
                {
                return $db->querySuccess($query);
                }
            if (mysql_num_rows($qResult) === 1)
                {
                //var_dump('vardump qresult: ' . $qResult);

                $row = mysql_fetch_object($qResult);
                $acc = new Account_Model($row);
                }
            else
                {
                return null;
                }
            }
        $db->close();
        return $acc;
        }

    /*
     * Function to add new user to the database
     */

    public static
            function addUser($userId, $password, $first_nm, $last_nm, $email_addr)
        {
        $db = new Database();
        $db->connect();

        $query = "INSERT INTO account" .
                "(`user_id`, `acc_create_ts`, `password`, `first_nm`, "
                . "`last_nm`, `  email_addr`)"
                . "VALUES ("
                . $userId . "','"
                . "CURRENT_TIMESTAMP,'"
                . $password . "','"
                . $first_nm . "','"
                . $last_nm . "','"
                . $email_addr . "')";

        $result = mysql_query($query);
        if (!$db->querySuccess($result))
            {
            return "Error inserting data into database.";
            }
        }

    }
