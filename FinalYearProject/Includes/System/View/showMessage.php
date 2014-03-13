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
        <link rel="stylesheet" type="text/css" href="Includes/CSS/showMessage.css"/>
    </head>
    <body>
        <div id="container">
                    <?php
            if (isset($_SESSION['user']))
                {
                include 'header.php';
                } else
                {
                echo "<a href=\"?page=register\">Return to registration<a/>";
                }
            ?>            
                
            <h1><?php echo $this->registry->heading; ?></h1>
            <div id="showMsg">
                <p><?php
                    if (is_array($this->registry->message))
                        {
                        implode("<br/>", $this->registry->message);
                        } else
                        {
                        echo $this->registry->message;
                        }
                    ?></p>
            </div>
        
        <?php
        include("footer.php");
        ?>
            </div>
    </body>
</html>