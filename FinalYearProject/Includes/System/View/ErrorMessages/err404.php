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
        <link rel="stylesheet" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" href="Includes/CSS/main.css"/>
    </head>
    <body>
        <?php
        include(__VIEW_PATH . "/header.php");
        ?>
        <!--Error Message-->
        <h1>Error 404</h1>
        <p>Requested page not found!</p>
        <?php
        include(__VIEW_PATH . "/footer.php");
        ?>
    </body>
</html>

