<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>
            Final Year Project - Message
        </title> 
        <link rel="stylesheet" type="text/css" href="Includes/CSS/reset.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/main.css"/>
        <link rel="stylesheet" type="text/css" href="Includes/CSS/home.css"/>
    </head>
    <body>
        <div id="headerWrapper">
            <?php
            if (isset($_SESSION['user']))
                {
                include 'header.php';
                }
                else    {
                    ?>
            <a href="?page=login" value="Log into your new account"/>
            <?php
                    }
            ?>
        </div>
        <div id="container">
            <h1><?php echo $this->registry->heading; ?></h1>
            <p><?php echo $this->registry->message; ?></p>
        </div>
    </body>
</html>