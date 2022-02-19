<?php
/**
 * Created by PhpStorm.
 * User: Takatathien
 * Date: 12/4/2016
 * Time: 3:55 PM
 *
 * This is the webpage that allowed the user to add and/or delete items from their todolist.
 * This page will also redirect the user toward start.php page if the user have not logged in.
 */

//session_start();
include("common.php");

// add the items inside the file into the HTML line by line
function addList() {
    $username = $_SESSION["name"];
    $file = "todo_" . $username;

    if (file_exists($file)) {   // only print out the list if there is a todo_username.txt
        $items = file($file, FILE_IGNORE_NEW_LINES);
        $index = 0;

        foreach ($items as $item) {
            $item = htmlspecialchars($item);    // returns an HTML-escaped version

            ?>
            <li>
                <form action="submit.php" method="post">
                    <input type="hidden" name="action" value="delete"/>
                    <input type="hidden" name="index" value="<?= $index ?>"/>
                    <input type="submit" value="Delete"/>
                </form>
                <?= $item ?>
            </li>
            <?php

            $index++;
        }
    }
}

// main output
if (!isset($_SESSION["name"])) {
    header("Location: start.php");
} else {
    setTop();

    ?>
    <div id="main">
        <h2><?= $username ?>'s To-Do List</h2>

        <ul id="todolist">
            <?php

            addList();

            ?>
            <li>
                <form action="submit.php" method="post">
                    <input type="hidden" name="action" value="add"/>
                    <input name="item" type="text" size="25" autofocus="autofocus"/>
                    <input type="submit" value="Add"/>
                </form>
            </li>
        </ul>

        <div>
            <a href="logout.php"><strong>Log Out</strong></a>
            <em>(logged in since <?= $_COOKIE["login"] ?>)</em>
            <!-- <em>(logged in since <?php displayTimeCookie(); ?>)</em> -->
        </div>

    </div>
    <?php

    setBottom();
}