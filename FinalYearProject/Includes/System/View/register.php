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
        <script type="text/javascript" src="Includes/common/Scripts/Validation.js"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/register.css"/>
        <title>Time Management System for Professionals - Registration page</title>

    </head>
    <body>
        <div id="container">
            <h1>Registration Form</h1>
            <div id="content" class="centralBox">
                <form id="register" action="?page=Register&action=submitForm" method="post" onsubmit="return Validation()">
                    
                    <div id="personal">
                        <h2>Your Details</h2>
                    <input type="text" name="fname" placeholder="Your first name"/><br/>
                    <input type="text" name="lname" placeholder="Your last name"/><br/>
                    <input type="text" name="email" placeholder="Your email address"/><br/>
                    <input type="text" name="user_id" placeholder="New Username"/></label>
                    <br/>
                    <div id="passwords">
                        <input type="password" name="password" placeholder="New Password "/><br/>
                        <input type="password" name="password2" placeholder="Re-enter password"/>
                    </div>
            
            <br/>
            <div id="navigation">
                <input type="button" value="Back" class="button" id="prevPge"
                       onclick="?page=Login"/>
                <input type="submit" value="Submit" class="button" id="newUser"/>
            </div>
            </div>
        </form>
        <?php
        include("footer.php");
        ?>
    </div>
</body>
</html>

