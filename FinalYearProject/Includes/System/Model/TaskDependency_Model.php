<?php
/**
 * Description of TaskDependency_Model
 *
 * @author James
 */
class TaskDependency_Model extends Dependency_Model
    {
    private $tsk_id;
    private $dp_id;
    
    public function __construct($row){
        $this->tsk_id = $row->TSK_ID;
        $this->dp_id = $row->DEPENDENCY_ID;
        }
        
        public function tsk_id(){
            return $this->tsk_id;
            }
            public function dp_id(){
                return $this->dp_id;
                }
                
                
    }
