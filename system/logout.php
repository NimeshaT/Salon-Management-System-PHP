<?php
//start a session to read already assigned session variable
session_start();

//unset($_SESSION['first_name']);
//destroy already created all sessions
session_destroy();

header("Location:login.php");

