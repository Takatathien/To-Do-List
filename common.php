<?php
/**
 * Created by PhpStorm.
 * User: Takatathien
 * Date: 12/4/2016
 * Time: 10:01 PM
 *
 * Contain common functions that are shared between all the filed.
 */

// start a new session
session_start();

if (isset($_SESSION["name"]) && isset($_SESSION["password"])) {
    $username = $_SESSION["name"];
    $password = $_SESSION["password"];
}

// function to destroy the current session
function destroySession() {
    session_destroy();
    session_regenerate_id(TRUE);
}

// function to set new cookie for the login time.
function setTimeCookie() {
    $time = date("D y M d, g:i:s a");
    $expireTime = time() + 60 * 60 * 24 * 7;  // 1 week from now;
    setcookie("login", $time, $expireTime);
}

// function to destroy old cookie for the login time.
function deleteTimeCookie() {
    setcookie("login", FALSE);
}

// function that input the HTML for the top part of the webpage.
function setTop() {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <title>Remember the Cow</title>
        <link href="https://webster.cs.washington.edu/css/cow-provided.css" type="text/css" rel="stylesheet"/>
        <link href="cow.css" type="text/css" rel="stylesheet"/>
        <link href="https://webster.cs.washington.edu/images/todolist/favicon.ico" type="image/ico"
              rel="shortcut icon"/>
    </head>

    <body>
    <div class="headfoot">
        <h1>
            <img src="https://webster.cs.washington.edu/images/todolist/logo.gif" alt="logo"/>
            Remember<br/>the Cow
        </h1>
    </div>
    <?php

}

// function that input the HTML for the bottom part of the webpage.
function setBottom() {
    ?>
    <div class="headfoot">
        <p>
            <q>Remember The Cow is nice, but it's a total copy of another site.</q> - PCWorld<br/>
            All pages and content &copy; Copyright CowPie Inc.
        </p>

        <div id="w3c">
            <a href="https://webster.cs.washington.edu/validate-html.php">
                <img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML"/></a>
            <a href="https://webster.cs.washington.edu/validate-css.php">
                <img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS"/></a>
        </div>
    </div>
    </body>
    </html>
    <?php
}
