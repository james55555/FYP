<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StaffTask_Model
 *
 * @author James
 */
class StaffTask_Model
    {

    private $tsk_id;
    private $staff_id;

    public function __construct($row)
        {
        $this->tsk_id = $row->TSK_ID;
        $this->staff_id = $row->STAFF_ID;
        }

    public function tsk_id()
        {
        return $this->tsk_id;
        }

    public function staff_id()
        {
        return $this->staff_id;
        }

    }