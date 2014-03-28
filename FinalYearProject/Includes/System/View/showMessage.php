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

                <?php
                if (isset($this->registry->error) &&
                        $this->registry->error)
                    {
                    //Reset registry error
                    $this->registry->error = false;
                    if (is_array($this->registry->message))
                        {
                        echo "<p class=\"error\">" .
                        implode("<br/>", $this->registry->message)
                        . "</p>";
                        } else
                        {
                        ?>
                        <p class="error"><?php echo $this->registry->message; ?></p>
                        <?php
                        }
                    ?>

                    <br/>
                    <a href="javascript:history.go(-1);">
                        Return to previous page
                    </a>
                    <?php
                    } else
                    {
                    echo "<p>" . $this->registry->message . "</p>";
                    }
                ?>

            </div>
        </div>
    </body>
</html>