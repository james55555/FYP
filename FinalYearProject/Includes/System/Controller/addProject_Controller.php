<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addProject
 *
 * @author James
 */
class addProject_Controller extends Main_Controller
    {
    public function main()  {
        $this->registry->projects = Project_Model::getAllUserProj($_SESSION['user']->userId());
        
        
        $this->registry->View_Template->show('addProject');
        }
        
        public function submitForm(){
            
            }
    }
