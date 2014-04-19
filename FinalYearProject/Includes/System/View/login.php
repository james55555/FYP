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
                <!--Form to retrieve user login details-->
                <form method="post" action="?page=Login" name="login">
                    <label>Username: <br><input type="text" name="username" maxlength="25"/></label><br>
                    <label>Password: <br><input type="password" name="password" maxlength="25"/></label><br>
                    <input type="submit" value="Login" class="button" id="submit"/>
                </form>
                <div id="error">
                    <?php
                    if (isset($this->registry->success) 
                            && $this->registry->success === false)
                        {
                        ?>
                    <!--Client-side validation-->
                    <script type="text/javascript">
                        alert("Invalid credentials");
                        </script>
                        <?php
                        }
                    ?>
                </div>
                <div id="loginIssue">
                    <!--Send user to registration form = ?page=Register-->
                    <a href="?page=Register" id="NU">Don't have an account?</a>
                    <!--Send user to password reset page-->
                    <!--<a href="?page=newPass" id="NP">Forgot Password?</a>-->
                </div>
            </div>
        </div>

    </body>
</html>

