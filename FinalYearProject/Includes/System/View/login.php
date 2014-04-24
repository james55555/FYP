<?php
/*
 *  Namespace       : Include
 *  File name       : login 
 *  File extension  : php
 *  Author          : James Graham
 *  Description     : view to show log in page
 * 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Include jQuery library-->
        <script type="text/javascript" 
        src="Includes/common/Scripts/jQuery_lib/jquery_v1.11.1.js"></script>
        <script type="text/javascript" 
        src="Includes/common/Scripts/emptyLogin.js"></script>
        <script type="text/javascript" 
        src="Includes/common/Scripts/confirmAction.js"></script>
        <script type="text/javascript" 
        src="Includes/common/Scripts/resetFields.js"></script>

        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/login.css"/>
        <title>Time Management System for Professionals - Log in Page</title>
    </head>
    <body>
        <div id="container">
            <!--Information Body-->
            <div id="intro">
                <h1> <!--Centre this text-->
                    Small-Scale Project Management<br>
                    Login
                </h1>
            </div>
            <div id="login_div" class="centralBox">
                <p>To access your profile enter your login details or create an account</p>
                <span class="error" id="emptyError">
                <?php
                    if (isset($error_string) && !empty($error_string))
                        {
                        echo $error_string;
                        }
                    ?></span>
                <!--Form to retrieve user login details-->
                <form method="post" action="?page=Login" name="login" id="login">
                    <label>Username: <input type="text" name="username" maxlength="25"/></label>
                    <label>Password: <input type="password" name="password" maxlength="25"/></label>
                    
                    <div id="actions">
                        <input type="submit" value="Login" class="button" id="submit"/>
                        <button type="button" class="button" id="reset">Reset</button>
                    
                        <span style="clear: both;"></span>
                    </div>
                </form>
                <div id="loginIssue" style="display: inline-block;">
                    <!--Send user to registration form-->
                    <a href="?page=Register" id="NU">Don't have an account?</a>
                    <!--Send user to password reset page-->
                    <!--<a href="?page=newPass" id="NP">Forgot Password?</a>-->
                </div>
            </div><!--End of Login_div-->
        </div><!--End of container-->

    </body>
</html>

