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
                <form id="register" name="register" action="?page=Register&action=submitForm" 
                      method="post">
                    <div id="personal" class="regInput">
                        <h2>Create your account</h2>
                        <input type="text" name="fname" placeholder="Your first name"
                               title="No more than 30 characters"/>
                        <br/><span class="val_fName"></span>
                        <input type="text" name="lname" placeholder="Your last name"
                               title="No more than 30 characters"/>
                        <br/><span class="val_lName"></span>
                        <input type="text" name="email" placeholder="Your email address (optional)"
                               title="Must be a valid email"/>
                        <br/><span class="val_email"></span>
                    </div>
                    <br/>

                    <div id="credentials" class="regInput">
                        <h2>Set up your login details</h2>
                        <input type="text" name="user_id" placeholder="New Username"
                               title="No more than 25 characters"/>
                        <br/><span class="val_ui"></span>
                        <input type="password" name="password" placeholder="New Password"
                               title="No more than 25 characters"/>
                        <br/><span class="val_pass"></span>
                        <input type="password" name="password2" placeholder="Re-enter password"/>
                        <br/><span class="val_pass2"></span>
                    </div>

                    <br/>
                    <div id="navigation">
                        <input type="button" value="Back" class="button"
                               onclick="location.href = '?page=Login'"/>
                        <input name="submit" type="submit" value="Submit" class="button"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

