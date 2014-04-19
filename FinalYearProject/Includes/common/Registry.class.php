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
        if(!isset($this->variables[$key])){
            throw new Exception("Registry variable: " . 
                    $key . " not set");
            }
        return $this->variables[$key];
        }
        
        /*
         * Function to remove variables from Global registry
         * @param $var variable
         */
        public function remove($var){
            unset($this->$var[$key]);
            }

    }
