<?php

#Copyright 2014 - Aston University
#Final Year Project - CS3010
#
#Document: Edit_Controller
#@author: James
class Edit_Controller extends Main_Controller {
    public function main(){
        //if is task or is project
        if ($_GET['isProj'])
            {
            $this->registry->View_Template->show('editProject');
            } else
            {
            $this->registry->View_Template->show('editTask');
            }
        }
    }