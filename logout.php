<?php
/**
 * Created by PhpStorm.
 * User: Takatathien
 * Date: 12/4/2016
 * Time: 3:56 PM
 *
 * Log the user out of their todolist and return the user back to start.php
 * It also destroy the user current session.
 */

// destroy the current session
// session_start();
include("common.php");

// destroy the current session
destroySession();

// redirect back to start.php
header("Location: start.php");
die();