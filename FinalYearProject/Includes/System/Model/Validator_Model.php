<?php

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
     * @param String $field     : This is the variable
     * @param String $string    : This is the name of the variable
     * @param String $type      : This is the variable type
     * @param int $length       : This is the maximum length of a variable
     * 
     * @return boolean
     * 
     * (Waterson, 2013)
     */

    public static function variableCheck($field, $string, $type, $length)
        {

        // assign the type
        $type = 'is_' . $type;
        $errors = array();

        if (!$type($string))
            {
            $typeErr = "String and type don't match! "
                    . "<br/>Field is: " . $field .
                    "<br/>Type: " . $type;
            array_push($errors, $typeErr);
            }
        // now we see if there is anything in the string
        if (empty($string) || $string === '' || strlen($string === 0))
            {
            $emptyErr = $field . " can't be empty";
            array_push($errors, $emptyErr);
            }
        // then we check how long the string is
        if (strlen($string) > $length)
            {
            $lengthErr = $field . " cannot be more than " . $length . " characters long!";
            array_push($errors, $lengthErr);
            }
        //then check if the values contain any unwanted characters
        if (preg_match("/[0-9A-Za-z]/", $string) === 0)
            {
            $charErr = $field . " can only contain letters and numbers.";
            array_push($errors, $charErr);
            }
        if (sizeof($errors) === 0)
            {
            $errors = null;
            }
        return $errors;
        }

    /*
     * Function to validate email specifically as this has slightly 
     * different characters than other methods.
     */

    public static function validateEmail($em, $field)
        {

        $email = Validator_Model::htmlChar($em);

        $emailError = array();
        if (strlen($email) > 50)
            {
            array_push($emailError, $field . "is too long! Must be less than 50 characters");
            }
        //Check if email contains only usable chars
        if (strlen($email) !== 0)
            {

            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
                {
                die("email chars aren't correct");
                array_push($emailError, "Ensure " . $field . " contains correct characters!");
                }
            }
        if (sizeof($emailError) === 0)
            {
            $emailError = null;
            }
        return $emailError;
        }

    /*
     * Helper method to filter variables using htmlspecialchars in order to keep their
     * meaning when rendered in HTML.
     * @param $array array
     * @return $array array
     * (Based on Database::FilterParameters, potential for more dynamic method?)
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
        
        /*
         * Function to validate provided date.
         * @param date $date        : This is a user provided date from a HTML5 date input
         * @return boolean $valid   : This returns boolean based on whether date is valid
         * 
         */
        public static function validateDate($date){
            $valid = false;
            if(checkdate($date)){
                $valid = true;
                }
                return $valid;
            }

    }

?>