<?php
/**
 * The PassHash class is used to securely hash passwords for 
 * storage in the database
 * @author (Guzal, 2012)
 */
class PassHash
    {
    // blowfish
    private static $algo = '$2a';
 
    // cost parameter
    private static $cost = '$10';
 
 
    /*
     * Function to create a unique salt value using random number generator
     * 
     * @return (String) salt    This is the salt returned as a substr
     */
    public static function unique_salt() {
        return substr(sha1(mt_rand()),0,22);
    }
 
    /*
     * Function to generate hash value using blowfish, cost and salt
     * @param (String) $password    This is the value to hash
     * 
     * @return (String) hash        This is the encrypted value
     */
    public static function hash($password) {
 
        return crypt($password,
                    self::$algo .
                    self::$cost .
                    '$' . self::unique_salt());
    }
 
    /*
     * Function to compare a provided password against its hashed value
     * @param (String) $hash        This is the password that exists in the database
     * @param (String) $password    This is the password to check
     * 
     * @return (boolean)            This returns true if passwords match
     */
    public static function check_password($hash, $password) {
 
        $full_salt = substr($hash, 0, 29);
 
        $new_hash = crypt($password, $full_salt);
 
        return ($hash == $new_hash);
    }
}
 