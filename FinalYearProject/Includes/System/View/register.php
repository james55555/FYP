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
        <script tpye="text/javascript" src="Includes/common/Scripts/Validation.js"></script>
        <link rel="stylesheet" type="text/css" href="CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/register.css"/>
        <title>Time Management System for Professionals - Registration page</title>

    </head>
    <body>
    <legend>Registration Form</legend>
    <div id="registration">
        <form id="register" action="Register_Controller.php" method="post" onsubmit="return Validation()">
            <input type="hidden" id="submitted" value="false"/>
            <input type="hidden" id="return" value="true"/>
            <label>First Name: <input type="text" name="fname"/></label><br/>
            <label>Last Name: <input type="text" name="lname"/></label><br/>
            <label>Email: <input type="text" name="email"/></label><br/>
            <label>Username: <input type="text" name="user_id"/></label>
            <br/>
            <label>Password: <input type="password" name="password"/></label>
            <label>Re-Enter Password: <input type="password" name="password2"/></label>

            <br/>
            <input type="submit" value="Back" class="button" id="prevPge"/>
            <input type="submit" value="Submit" class="button" id="newUser"/>
        </form>
        <?php
        include("footer.php");
        ?>
    </div>
</body>
</html>

