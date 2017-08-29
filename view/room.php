<?php ini_set('display_errors',0); ?>
<?php include "../db/room.php"; ?>
<?php $room = new room; ?>
<?php $data = $room->select();?>
<html>
<head>
</head>
<?php $index = 1?>
<body>
	<table border="1">
		<tr>
			<td>no</td>
			<td>Room name</td>
			<td>price</td>
			<td>status</td>
			<td>action</td>
		</tr>
		
		<?php foreach($data as $key => $dataroom) :?>
			<tr>
			<td><?=$index++?></td>
			<td><?= $dataroom['name'] ?></td>
			<td><?= $dataroom['price'] ?></td>
			<td><?= ($dataroom['status'] == 1) ? "Available" :"Not Available" ?></td>
			<td>
				<a href="../controller/delete.php?id=<?=$dataroom['id']?>">delete</a>
				<a href="room.php?id=<?=$dataroom['id']?>">update</a>
			</td>
			</tr>
		<?php endforeach;?>
	</table>
	<?php $oneroom = [];?>
	<?php if(!empty($_GET['id'])) {?>
	<?php $oneroom = $room->find($_GET['id']);?>
	<?php } ?>
	<form method="post" action="../controller/save.php">
		name: <input type = "text" name="name" value="<?= $oneroom['name']?>"><br />
		price: <input type = "text" name="price" value="<?= $oneroom['price']?>"><br />
		status:  <input type="radio" name="status" value="1" <?= $oneroom['status']==1 ? "checked": ""?>> Available<br>
	 			 <input type="radio" name="status" value="0" <?= $oneroom['status']==2 ? "checked": ""?>> Not Available<br>
	 	<input type="hidden" name="id" value="<?= $oneroom['id']?>">
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>