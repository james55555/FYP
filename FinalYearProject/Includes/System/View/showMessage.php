
<!DOCTYPE html>
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
        <?php
        if (isset($_SESSION['user']))
            {
            include 'header.php';
            }
        ?>            
        <div id="container">
            <h1><?php echo $this->registry->heading; ?></h1>
            <div id="showMsg">
                <?php
            ?>
                <?php
                if (is_array($this->registry->message))
                    {
                    $this->registry->message = implode("<br/>", $this->registry->message);
                    }
                if ($this->registry->error)
                    {
                    ?>
                    <p class="error">   
                        <?php
                        echo $this->registry->message;
                        ?>
                    </p>
                    <br/>
                    <a href="javascript:history.go(-1);">
                        Return to previous page
                    </a>
                    <?php
                    } else
                    {
                    echo "<p>" . $this->registry->message . "</p>";
                    }
                //Reset registry error
                $this->registry->error = false;
                ?>
            </div> <!--End of showMsg div-->
        </div> <!--End of container div-->
    </body>
</html>