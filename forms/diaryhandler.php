<?php 
ini_set('display_errors', 'on');
require '../src/boot.php'; 

if (isset($_POST['diaryName'])) {
	$diary->createDiary($_POST['diaryName']);
	header('Location: ../index.php');
}elseif (isset($_POST['diarypost'])) {
	$diary->diaryPost($_SESSION['id_diary'], $_POST['diarypost']);
	header('location: ../index.php');
}elseif (isset($_POST['openDiary'])) {
	$_SESSION['id_diary'] = $_POST['id_diary'];
	header('location: ../index.php');
}elseif (isset($_POST['deletePost'])) {
	$diary->deletePost($_POST['deletePost']);
	header('location: ../index.php');
}elseif ($_POST['deleteDiary']) {
	$diary->deleteDiary($_POST['id_diary']);
	header('location: ../index.php');
}