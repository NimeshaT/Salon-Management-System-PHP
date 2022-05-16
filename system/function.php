<?php

function dataClean($data = null) {
//    removes whitespace and other predefined characters from both sides of a string.
    $data = trim($data);
//    Removes backslashes
//    stripcslashes("Thank\s. Please v\isit again.");
    $data = stripcslashes($data);
//    converts some predefined characters to HTML entities.
//    < (less than) becomes &lt;
    $data = htmlspecialchars($data);

    return $data;
}

function dbConn() {
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "salon";

    $conn = new mysqli($server, $user, $password, $db);

    if ($conn->connect_error) {
        die("Database connection error" . $conn->connect_error);
    } else {
        return $conn;
    }
}

function getDuration($durationInSeconds) {

    $duration = '';
    //1 day has 86400 seconds
    //rounds a number down a nearest integer.(floor)
    $days = floor($durationInSeconds / 86400);
    $durationInSeconds -= $days * 86400;
    //days gaanen ithuru tika peya karanna oona
    $hours = floor($durationInSeconds / 3600);
    $durationInSeconds -= $hours * 3600;
    $minutes = floor($durationInSeconds / 60);
    $seconds = $durationInSeconds - $minutes * 60;

    if ($days > 0) {
        $duration .= $days . ' days';
    }
    if ($hours > 0) {
        $duration .= ' ' . $hours . ' hour';
    }
    if ($minutes > 0) {
        $duration .= ' ' . $minutes . ' minutes';
    }
    if ($seconds > 0) {
        $duration .= ' ' . $seconds . ' seconds';
    }
    return $duration;
}
