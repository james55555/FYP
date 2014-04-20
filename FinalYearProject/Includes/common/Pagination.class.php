<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author James
 */
class Pagination
    {

    //Total records available in table
    private $total;
    //Records to return per set
    private $perSet;
    //Set number of current set
    private $setNumber;
    //Sets available based on total and perSet
    private $sets;

    /*
     * Constructor to create Pagination object
     */

    public function __construct($total, $perSet, $setNumber)
        {
        $this->total = (int) $total;
        $this->perSet = (int) $perSet;
        //Rounds up nearest value from total and perSet function
        $this->sets = (int) ceil($this->total / $perSet);

        $this->setNumber = $this->changeSet((int) $setNumber);
        }

    /*
     * Funtion to change the set to another number
     * @param (int) setNumber   This is the set number
     * 
     * @return (int) setNumber  This is the new set number
     */

    public function changeSet($setNumber)
        {
        //Minimum set number
        if ($setNumber < 0)
            {
            $setNumber = 1;
            }
        if ($setNumber > $this->sets)
            {
            $setNumber = $this->sets;
            }
        return $setNumber;
        }

    /*
     * Return number of records to return
     * 
     * @return (int) $leftover || $this->perset This is the numbr of records left to return
     */

    public function getCount()
        {
        //Rest of records
        $leftover = $this->total - ($this->perSet * ($this->setNumber - 1));
        //return max number of records if greater than perSet
        if ($leftover > $this->perSet)
            {
            return $this->perSet;
            }
        return $leftover;
        }

    /*
     * Return records onwards from 0
     * 
     * @return (int) $offset    This is the number of records
     */

    public function getOffset()
        {
        $offset = $this->perSet * ($this->setNumber - 1);
        return ($offset < 1) ? 0 : $offset;
        }

    /*
     * Function to get the current set number 
     * 
     * @return (int) current set number
     */

    public function getSetNumber()
        {
        return $this->setNumber;
        }

    /*
     * Get total number of sets available
     * 
     * @return (int)       This is the sets available
     */

    public function getSets()
        {
        return $this->sets;
        }

    }
