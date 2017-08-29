<?php 
	include "../db/room.php";
	$room = new room;
	$room->delete($_GET['id']);
	header('Location: '."../view/room.php");
?>