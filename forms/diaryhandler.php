<?php 
ini_set('display_errors', 'on');
require '../src/boot.php'; 

if (!empty($_POST['diaryName'])) {

	$diary->createDiary($_POST['diaryName']);
}