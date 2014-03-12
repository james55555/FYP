<?php
/*
 *  Namespace       : Include
 *  File name       : header 
 *  File extension  : php
 *  Author          : James Graham
 *  Description     : header to append to top of each page
 * 
 */
?>
    <link rel="stylesheet" type="text/css" href="Includes/CSS/header.css"/>
    <div id="wrapperHeader">
        <div id="header">
            <!--Set up logo header that if clicked on takes user to their home page-->
            
            <ul>
                <a href="?page=Home">
                    <!--Aston University, UK Logo 
                    (Copyrighted official logo for Aston University, 2007) -->
                        <img id="logo"
                            src="http://upload.wikimedia.org/wikipedia/commons/b/b5/Aston_University_Logo.png" 
                            alt="University Logo"/>
                        </a>
                <li><a href="?page=Home">Home - My Projects</a></li>
                <li><a href="?page=Reports">Reports</a></li>
                <li><a href="?page=Calendar">Calendar</a></li>
                <li><a href="?page=Timeline">Timeline</a></li>
                <li><a href="?page=Logout">Logout</a></li>
            </ul>
        </div>
    </div>


