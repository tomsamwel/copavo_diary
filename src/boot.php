<?php

if (session_status() === PHP_SESSION_NONE){
        @session_start();
    }


require_once 'db.php';
$db = new DB();
$db->Connect();