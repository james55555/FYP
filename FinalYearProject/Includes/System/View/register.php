<?php
/*
 *  Namespace       : Include
 *  File name       : register 
 *  File extension  : php
 *  Author          : James Graham
 *  Description     : registration page to allow users to create new accounts
 * 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/register.css"/>
        <!--Include jQuery library-->
        <script type="text/javascript"
        src="Includes/common/Scripts/jQuery_lib/jquery_v1.11.1.js"></script>

        <script type="text/javascript" 
        src="Includes/common/Scripts/Validation.js"></script>

        <title>Time Management System for Professionals - Registration page</title>

    </head>
    <body>
        <div id="container">
            <div id="content" class="centralBox">
                <h1>Registration</h1>
                <span id="errMessage"></span>
                <form id="register" name="register" action="?page=Register&action=submitForm" 
                      method="post">
                    <div id="personal" class="regInput">
                        <h2>Create your account</h2>
                        <input type="text" class="valid" name="fname" id="fname"
                               placeholder="Your first name" 
                               title="No more than 30 characters"/><span id="spfname"></span>
                        <input type="text" class="valid" name="lname" id="lname"
                               placeholder="Your last name"
                               title="No more than 30 characters"/><span id="splname"></span>
                        <input type="text" class="valid" name="email" id="email"
                               data-optional="true" placeholder="Your email address (optional)"
                               title="Must be a valid email"/><span id="spemail"></span>
                    </div>
                    <br/>
                    <div id="credentials" class="regInput">
                        <h2>Set up your login details</h2>
                        <input type="text" class="valid" name="user_id" id="user_id"
                               placeholder="New Username"
                               title="No more than 25 characters"/><span id="spuser_id"></span>    
                        <input type="password" class="valid" name="password" id="password"
                               placeholder="New Password"
                               title="No more than 25 characters"/><span id="sppassword"></span>
                        <input type="password" class="valid" name="password2" id="password2"
                               placeholder="Re-enter password"/><span id="sppassword2"></span>
                    </div>
                    <br/>
                    <div id="navigation">
                        <input type="button" value="Cancel" class="button"
                               onclick="location.href = '?page=Login'"/>
                        <input name="submit" type="submit" value="Submit" class="button"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

