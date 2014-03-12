<?php
/*
 *  Namespace       : Include
 *  File name       : footer 
 *  File extension  : php
 *  Author          : James Graham
 *  Description     : footer to append to bottom of each page
 * 
 */
?>

<link rel="stylesheet" type="text/css" href="Includes/CSS/footer.css"/> 

<div id="wrapperFooter">
    <div id="left" class="footer">
        <p>Candidate Number: 522511</p>
    </div>

    <div id="right" class="footer">
        <p>&copy 2014, James Graham</p>
    </div>


    <?php if ($_GET['page'] !== "Register")
        { ?>
        <div id="middle" class="footer">
            <a href="#top">Back to Top</a></br>
            <p>Individual Project - CS3010</p>
        </div>
    <?php
        } else
        {
        ?>
        <div id="middleRegister" class="footer">
            <p>Final Year Project</p>
        </div>
        <?php
        }
    ?>


</div>
