<?php
/**
 * Created by PhpStorm.
 * User: Takatathien
 * Date: 12/4/2016
 * Time: 2:57 PM
 *
 * This is the start webpage that show the login interface of the todolist.php
 * It allowed the user to login into their todolist or will redirect them directly
 * to todolist.php if they have already logged in.
 */

include("common.php");

// Display the last login time only if there IS a cookie, otherwise do not show anything.
function displayTimeCookie() {
    if (isset($_COOKIE["login"])) {
        ?>
        <em>(last login from this computer was <?= $_COOKIE["login"] ?>)</em>
        <?php
    }
}

if (isset($_SESSION["name"])) {
    header("Location: todolist.php");
} else {
    setTop();

    ?>
    <div id="main">
        <p>
            The best way to manage your tasks. <br/>
            Never forget the cow (or anything else) again!
        </p>

        <p>
            Log in now to manage your to-do list. <br/>
            If you do not have an account, one will be created for you.
        </p>

        <form id="loginform" action="login.php" method="post">
            <div><input name="name" type="text" size="8" autofocus="autofocus"/> <strong>User Name</strong></div>
            <div><input name="password" type="password" size="8"/> <strong>Password</strong></div>
            <div><input type="submit" value="Log in"/></div>
        </form>

        <p>
            <?php displayTimeCookie(); ?>
        </p>
    </div>
    <?php

    setBottom();
}