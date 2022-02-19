<?php
/**
 * Created by PhpStorm.
 * User: Takatathien
 * Date: 12/4/2016
 * Time: 3:55 PM
 *
 * Take the user add/delete form from todolist.php and add the item to an external file
 * that matched the user. Then redirect the user back to todolist.php
 */

//session_start();
include("common.php");

$file = "todo_" . $username;

if (empty($_POST["action"])) {      // if index is not a digit
    die("HAH! NICE TRY BUDDY! BUT THIS GUY KNOW HIS PHP");
}

// get the type of action that the user choose.
$action = $_POST["action"];
if ($action == "add") {
    if (empty($_POST["item"])) {    // if the user did not input in new item
        header("Location: todolist.php");
        die();
    }

    $item = $_POST["item"];
    file_put_contents($file, $item . "\n", FILE_APPEND);
    header("Location: todolist.php");
    die();
}

if ($action == "delete") {
    if (!preg_match("/\d/",$_POST["index"])) {      // if index is not a digit
        die("HAH! NICE TRY AGAIN! BUT IT'S STILL ME!!");
    }

    // get the lines inside the file
    $items = file($file, FILE_IGNORE_NEW_LINES);
    $index = $_POST["index"];

    // remove the line with the input index from the array
    array_splice($items, $index, 1);
    file_put_contents($file, "");   // erase the file content

    // put back the line array into the file.
    foreach($items as $item) {
        file_put_contents($file, $item . "\n", FILE_APPEND);
    }

    header("Location: todolist.php");
    die();
}