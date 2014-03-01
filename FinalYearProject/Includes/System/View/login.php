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
<html>
    <head>
        <!-- Include header (not developed yet)
        <?php
        include("header.php");
        ?> 
        -->
        <link rel="stylesheet" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" href="Includes/CSS/login.css"/>
        <link typ="text/javascript" href="Includes/common/Scripts/loginCheck.js"/>
        <title>Time Management System for Professionals - Log in Page</title>
    </head>
    <body>
        <!--Information Body-->
        <div id="intro">
            <h1> <!--Centre this text-->
                Small-scale Project Management<br>
                Login
            </h1>
            <p>This venture looks to deliver small-scale project management to 
                professional users. The site has been designed as part of a 
                Final Year Project (CS3010) at Aston University. <br><br>
                Designed by James Graham</p>
        </div>

        <div id="login_div">
            <p>To access your profile enter your login details or create an account</p>
            <!--Form to retrieve user login details-->
            <form method="post" action="?page=login"">


                <label>Username: <br><input type="text" name="username" id="uid"/></label><br>
                <label>Password: <br><input type="password" name="password" id="pwd"/></label><br>


                <?php
                /* @var boolean $invalidLogin */
                if (isset($invalidLogin) && $invalidLogin)
                    {
                    /* use javascript to prompt error */
                    echo "invalid login!! </br>";
                    }
                ?>
                <input type="submit" value="Login" class="button"/>
                <div id="loginIssue">
                    <!--Send user to registration form = ?page=Register-->
                    <a href="?page=Register" id="NU">Don't have an account?</a>
                    <!--Send user to password reset page-->
                    <a href="?page=newPass" id="NP">Forgot Password?</a>

            </form>
        </div>
    </div>

</body>
</html>

