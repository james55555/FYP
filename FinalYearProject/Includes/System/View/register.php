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
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/register.css"/>
        <!--Include jQuery library-->
        <script type="text/javascript"
                src="http://code.jquery.com/jquery-1.9.0.js"></script>
        
        <script type="text/javascript" 
                src="Includes/common/Scripts/Validation.js"></script>
        
        <title>Time Management System for Professionals - Registration page</title>

    </head>
    <body>
        <div id="container">

            <h1>Registration Form</h1>
            <div id="content" class="centralBox">
                <form id="register" name="register" action="?page=Register&action=submitForm" 
                      method="post">

                    <div id="personal" class="regInput">
                        <h2>Your Details</h2>
                        <input type="text" name="fname" placeholder="Your first name"/>
                        <span class="val_fName"></span>
                        <br/>
                        <input type="text" name="lname" placeholder="Your last name"/>
                        <br/><span class="val_lName"></span>
                        <input type="text" name="email" placeholder="Your email address (optional)"/>
                        <br/><span class="val_email"></span>
                        <input type="text" name="user_id" placeholder="New Username"/>
                        <br/><span class="val_ui"></span>
                    </div>
                    <br/>
                    <div id="passwords" class="regInput">
                        <input type="password" name="password" placeholder="New Password "/>
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

