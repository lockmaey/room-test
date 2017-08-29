<?php
	include "../db/room.php";

	$action = $_GET['action'];

	switch($_GET['action']) {
		case 'delete': delete(); break;
		case 'save': save(); break;
	}

	function delete(){
		$room = new room;
		$room->delete($_GET['id']);
		header('Location: '."../view/room.php");
	}

	function save(){
		$room = new room;
		$data['name'] = $_POST['name'];
		$data['price'] = $_POST['price'];
		$data['status'] = $_POST['status'];
		$data['id'] = $_POST['id'];

		if(!empty($data['id'])) $room->update($data);
		else $room->add($data);
		header('Location: '."../view/room.php");
	}
?>