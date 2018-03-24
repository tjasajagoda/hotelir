<?php
    session_start();
    $rootPath = dirname($_SERVER["PHP_SELF"]);
    $scriptName = substr($_SERVER["PHP_SELF"], strrpos($_SERVER["PHP_SELF"], '/') + 1);
    if($scriptName == "index.php") {
        //if session exists and is valid do nothing, otherwise redirect to login
        if(!isset($_SESSION["user"]) || !isset($_SESSION["timestamp"])) {
            //Redirect
            header('Location: ' . $rootPath . '/login.php');
            die();
        }
    } else {
        //if session exists and is valid redirect to index, otherwise don't do anything
        if(isset($_SESSION["user"]) && isset($_SESSION["timestamp"])) {
            //Redirect
            header('Location: ' . $rootPath . '/index.php');
            die();
        }
    }
?>