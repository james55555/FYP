<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class TaskStatus_Model
    {

    private
            $tsk_id;
    private
            $status_id;
    private $table = "STATUS";
    private $tableFields = array("STATUS_ID", "STATUS_CD", "STATUS_DESCR");
    private $model = "STATUS_MODEL";

    public
            function __construct($row)
        {
        $this->tsk_id = $row->tsk_id;
        $this->status_id = $row->status_id;
        }

    public
            function tsk_id()
        {
        return $this->tsk_id;
        }

    public
            function status_id()
        {
        return $this->status_id;
        }

    public static function getTaskStatus($tsk_id)
        {
        $db = new Database();
        $db->connect();

        $task = Task_Model::getTask($tsk_id);
        $status_id = $task->status();
        $status = Status_Model::getStatus($status_id);

        $db->close();
        return $status;
        }

    }

?>
