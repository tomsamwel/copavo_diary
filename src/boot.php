<?php

ini_set('display_errors', 'On');
if (session_status() === PHP_SESSION_NONE){
        @session_start();
    }


require 'user.php';
require 'diary.php';
$user = new User();
$diary = new Diary();

// $db = new DB();
// $db->Connect();


