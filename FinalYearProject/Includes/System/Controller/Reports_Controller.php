<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reports_Controller extends Main_Controller
    {

    public function main()
        {

        $this->registry->error = true;
        $this->registry->heading = "This page is under construction";
        $this->registry->message = "This will be completed: 11/04/2014";

        $this->registry->View_Template->show('showMessage');
        }

    }
