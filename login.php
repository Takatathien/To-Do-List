<?php
/**
 * Created by PhpStorm.
 * User: Takatathien
 * Date: 12/4/2016
 * Time: 2:59 PM
 *
 * PHP page that take in the user account and password from start.php to either logged the user in
 * if the user is already registered or open a new account for the user otherwise.
 * Then redirect the user to todolist.php
 *
 * Destroy the previous login cookie. Set a new cookie for the time the user logged in.
 */

// session_start();
include("common.php");

// delete the old login time cookie and set a new one
deleteTimeCookie();
setTimeCookie();

if ((empty($_POST["name"]) || empty($_POST["password"])) ||     // if any of the field input is empty
    (!preg_match("/^[a-z][a-z0-9]{2,7}$/", $_POST["name"]) ||   // if the username is in wrong format
        (!preg_match("/^[0-9].{4,10}[^a-zA-Z0-9]$/", $password = $_POST["password"])))) {     // if the password is in wrong format

    // redirect back to start.php and stop the program
    header("Location: start.php");
    die();
}

// get new username and password
$username = $_POST["name"];
$password = $_POST["password"];

// set up a new session
$_SESSION["name"] = $username;
$_SESSION["password"] = $password;

$input = $username . ":" . $password;
$file = "user.txt";

if (file_exists($file)) {      // there is a user.txt and assumed that there is at least one account
    $accounts = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($accounts as $account) {
        list($old_user, $old_pass) = explode(":", $account, 2);

        if ($old_user == $username) {   // if username is the same
            if ($old_pass == $password) {   // if password is the same
                header("Location: todolist.php");
                die();
            } else {    // if the password is different
                // destroy the current session
                destroySession();

                header("Location: start.php");
                die();
            }
        }
    }

    // if there are no existing account
    file_put_contents($file, $input . "\n", FILE_APPEND);
    header("Location: todolist.php");
    die();
} else {                            // there isn't a user.txt
    //create the file and put in the account
    file_put_contents($file, $input . "\n", FILE_APPEND);

    // redirect to todolist.php
    header("Location: todolist.php");
    die();
}