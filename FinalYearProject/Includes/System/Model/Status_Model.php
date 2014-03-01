<?php

/*
 *  Namespace       : Include
 *  Document        : Status
 *  Author          : James Graham
 *  Description     : 
 * 
 */
class Status_Model
    {

    private
            $status_id;
    private
            $status_cd;
    private
            $status_descr;

    public
            function __construct($row)
        {
        $this->status_id = $row->status_id;
        $this->status_cd = $row->status_cd;
        $this->status_descr = $row->status_descr;
        }

    public
            function status_id()
        {
        return $this->status_id;
        }

    public
            function status_cd()
        {
        return $this->status_cd;
        }

    public
            function status_descr()
        {
        return $this->status_descr;
        }

    public static
            function getStatusDescr($status_id)
        {
        $db = new Database();
        $db->connect();
//Set variables for query on STATUS table
        $model = "STATUS_MODEL";
        $query = "SELECT status_descr "
                . "FROM STATUS "
                . "WHERE status_id = " . $status_id;

        $status = $db->selectQuery($query, $model);

        return $status;
        }

    }
?>


