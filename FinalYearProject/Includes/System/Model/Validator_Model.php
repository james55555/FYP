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
     * 
     * @param String $field     : This is the variable
     * @param String $string    : This is the name of the variable
     * @param String $type      : This is the variable type
     * @param int $length       : This is the maximum length of a variable
     * @param boolean $optional : This is whether the variable can be empty
     * 
     * @return boolean
     */

    public static function variableCheck($field, $string, $type, $length,
            $optional)
        {
        // assign the type
        $type = 'is_' . $type;
        $errors = array();
        //Check if the variable can be empty
        if (isset($optional) && !$optional)
            {
            //Check if variable is empty
            $empty = Validator_Model::optionalVar($string, $field);
            //If an error has returned add to error array
            if (is_string($empty))
                {
                array_push($errors, $empty);
                }
            } elseif (!$type($string))
            {
            $typeErr = "String and type don't match!<br>"
                    . "Field is: " . $field . "<br>"
                    . "Trying to run: " . $type . "(" . $string . ")";
            array_push($errors, $typeErr);
            }

        // then we check how long the string is
        elseif (strlen($string) > $length)
            {
            $lengthErr = $field . " cannot be more than " . $length . " characters long!";
            array_push($errors, $lengthErr);
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
     * @param (String) $em      String to be validated
     * @param (String) $field   String to be shown in error message
     */

    public static function validateEmail($em, $field)
        {

        $emailError = array();
        if (strlen($em) > 50)
            {
            array_push($emailError, $field . "is too long! Must be less than 50 characters");
            }
        //Check if email contains only usable chars
        if (strlen($em) !== 0 && isset($em) && $em !== '')
            {
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $em))
                {
                array_push($emailError, "Ensure " . $field . " contains correct characters!");
                }
            }
        else {
            return false;
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

    public static function validateDate($date, $optional)
        {
        $valid = true;
        //If date isn't optional then check it isn't empty
        $empty = Validator_Model::optionalVar($date, "Date ");
        if (is_string($empty))
            {
            if ($optional)
                {
                return false;
                } else
                {
                return $empty;
                }
            }
        //Pre-process date - If it's a string convert to time
        if (is_string($date))
            {
            $date = date('d-m-Y', strtotime($date));
            }
        //If the date is passed in American format then parse to English
        $parts = explode("-", $date);
        if (strlen($parts[0]) === 4)
            {
            $temp = $parts[0];
            array_splice($parts, 0, 1);
            array_push($parts, $temp);
            }

        //Check date is in valid format
        if (!checkdate($parts[0], $parts[1], $parts[2]))
            {
            return "Invalid date format!";
            } elseif ($parts[2] > 2500)
            {
            return "Year can't be after 2500";
            }
        return $valid;
        }

    /*
     * Helper function to check if a string is empty
     * @param (String) $string      Value to check
     * @param (String) $field       Name of value for error message
     * 
     * @return (String) $error      Return the error message for error array
     */

    public static function optionalVar($string, $field)
        {
        $error = false;
        // now we see if there is anything in the string
        if (empty($string) || $string === '' || strlen($string === 0))
            {
            $error = $field . " can't be empty";
            }
        return $error;
        }

    }

?>