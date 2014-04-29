<?php

/*
 *  Provides common functionality for all controllers
 * @author James Graham
 */

abstract
        class Main_Controller
    {

    //Registry object
    protected $registry;

    /*
     * Construct registry object
     * @param obj registry
     */

    public function __construct($registry)
        {
        $this->registry = $registry;
        }

    /*
     * Set the default main function for all controllers
     */

    public abstract function main();

    /*
     * Function to prepare an array of associated tasks
     * @param (Object) $task      This is a task object 
     * @param (Bool)   $new       If a new tasks is being added ignore the selection
     */

    protected function processDependency($task, $new = false, $edit = true)
        {
//Set project variables (for use internally)
        $proj_id = $task->proj_id();
        $projTasks = Task_Model::getAllTasks($proj_id);
        $dependencies = array();
//unset(array_keys($projTasks, $this->task->tsk_id()));
        $dp = new Dependency_Model($task->dpnd());
        foreach ($projTasks as $key => $val)
            {
            try
                {
                if (!!!is_object($val) && is_array($val))
                    {
                    $val = new Task_Model($val['tsk_id']);
                    }
                //Remove the Task object if it is the same as the current task
                if ($val->tsk_id() === $task->tsk_id() && !!!$new)
                    {
                    //Issues with using direct $key val so cast to int
                    $key = (int) $key;
                    //Remove the current task from the list of dependencies
                    unset($projTasks[$key]);
                    throw new Exception();
                    }

                //Find all task ids that exist in dp->dpnd()
                if ($dp->dpnd_on() === $val->tsk_id())
                    {
                    $checked = "checked";
                    } else
                    {
                    $checked = '';
                    }
                //Push checkbox string into array
                if ($edit)
                    {
                    $chckBoxStr = "<label id=\"dpndNm\">{$val->tsk_nm()}</label>"
                            . "<input type=\"checkbox\" name=\"tDpnd[]\" "
                            . "value=\"{$val->tsk_id()}\" $checked/>";
                    array_push($dependencies, $chckBoxStr);
                    } else
                    {
                    array_push($dependencies, $val->tsk_nm());
                    }
                } catch (Exception $ex)
                {
                //Exception caught - used to bypass logic
                }
            }
        return $dependencies;
        }

    }

?>
