<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator_Model
 *
 * @author James
 */
abstract class Validator_Model
    {
    /*
     * This function can be used to validate a variable
     * @access private
     * 
     * @param String $string    : This is the name of the variable
     * @param String $type      : This is the variable type
     * @param int $length       : This is the maximum length of a variable
     * 
     * @return boolean
     * 
     *  (Waterson, 2013)
     */

    public static function variableCheck($string, $type, $length)
        {

        // assign the type
        $type = 'is_' . $type;
        $errors = array();

        if (!$type($string))
            {
            array_push($errors, "String and type don't match for: $string");
            }
        // now we see if there is anything in the string
        elseif (empty($string) || $string === '' || strlen($string === 0))
            {
            array_push($errors, "Ensure  $string is filled in!");
            }
        // then we check how long the string is
        elseif (strlen($string) > $length)
            {
            array_push($errors, "$string cannot be more than $length characters long!");
            }
        //then check if the values contain any unwanted characters
        elseif (preg_match("/[0-9A-Za-z]/", $string) === 0)
            {
            array_push($errors, "$string can only contain letters and numbers.");
            }
        if (sizeof($errors) === 0)
            {
            $errors = null;
            }
        return $errors;
        }

    /*
         * Function to filter variables using htmlspecialchars in order to keep their
         * meaning when rendered in HTML.
         * @param $array array
         * @return $array array
         */
     public static function htmlChar($array)
        {

        // Check if the parameter is an array
        if (is_array($array))
            {
            // Loop through the initial dimension
            foreach ($array as $key => $value)
                {
                // Check if any nodes are arrays themselves
                if (is_array($array[$key]))
                    {
                    // If they are, let the function call itself over that particular node
                    $array[$key] = $this->htmlChar($array[$key]);
                    }
                // Check if the nodes are strings
                if (is_string($array[$key]))
                    {
                    // If they are, perform the htmlspecialchars function over the selected node
                    $array[$key] = htmlspecialchars($array[$key]);
                    }
                }
            // Check if the parameter is a string
            if (is_string($array))
                {
                // If it is, perform a  htmlspecialchars on the parameter
                $array = htmlspecialchars($array);
                }
            // Return the filtered result
            return $array;
            }
        }
       
        
        
    }
