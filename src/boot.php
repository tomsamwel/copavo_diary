<?php

ini_set('display_errors', 'On');
if (session_status() === PHP_SESSION_NONE){
        @session_start();
    }


require 'db.php';
require 'user.php';

// $db = new DB();
// $db->Connect();


