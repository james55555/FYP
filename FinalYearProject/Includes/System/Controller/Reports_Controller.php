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

        $this->registry->View_Template->error = true;
        $this->registry->View_Template->heading = "This page is under construction";
        $this->registry->View_Template->message = "This will be completed in the near future";

        $this->registry->View_Template->show('showMessage');
        }

    }
