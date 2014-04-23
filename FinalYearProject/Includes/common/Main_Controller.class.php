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
    }

?>
