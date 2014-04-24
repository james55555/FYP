<?php

/*
 * Registry class to store site-wide, global variables
 */

Class Registry
    {

    //Create vars array to store global variables
    private
            $variables = array();

    /*
     * Function to set undefined variables
     * @param String    key
     * @param any       value
     */

    public
            function __set($key, $value)
        {
        $this->variables[$key] = $value;
        }

    /*
     * Function to get variables based on key value in array
     * @param String key
     * @return obj vars
     */

    public
            function __get($key)
        {
        if (!!!array_key_exists($key, $this->variables))
            {
            return null;
            }
        return $this->variables[$key];
        }

    }
