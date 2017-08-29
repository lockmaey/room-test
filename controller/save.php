<?php 

include "../db/room.php";
$room = new room;

$data['name'] = $_POST['name'];
$data['price'] = $_POST['price'];
$data['status'] = $_POST['status'];
$data['id'] = $_POST['id'];

if(!empty($data['id'])) $room->update($data);
else $room->add($data);
header('Location: '."../view/room.php");
?>