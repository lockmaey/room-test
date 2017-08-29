<?php ini_set('display_errors',0); ?>
<?php include "../db/room.php"; ?>
<?php $room = new room; ?>

<?php $data = $room->select();?>
<?php if(isset($_GET['submit']) == 'filter') { ?>
	<?php $data = $room->filter(['price'=>$_GET['price'], 'status' => $_GET['status']]); ?>
<?php } ?>
<html>
<head>
</head>
<?php $index = 1?>
<body>
	<h2>Room List</h2>
	<form method="get" action="room.php?action=filter">
		price: <input type = "text" name="price" value="<?= $_GET['price']?>">
		status:  <select name="status">
					<option value="1"  <?= $_GET['status'] == 1 ? 'selected' : ''?> >Available</option>
					<option value="0" <?= $_GET['status'] == 0 ? 'selected' : '' ?> >Not Available</option>
				</select>
		<input type="submit" name="submit" value="filter"><a href="room.php">clear</a>
	</form>
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
				<a href="../controller/room.php?action=delete&id=<?=$dataroom['id']?>">delete</a>
				<a href="room.php?id=<?=$dataroom['id']?>">update</a>
			</td>
			</tr>
		<?php endforeach;?>
	</table>
	<?php $oneroom = [];?>
	<?php if(!empty($_GET['id'])) {?>
	<?php $oneroom = $room->find($_GET['id']);?>
	<?php } ?>
	<br >
	<h3>Add New</h3>
	<form method="post" action="../controller/room.php?action=save">
		name: <input type = "text" name="name" value="<?= $oneroom['name']?>"><br />
		price: <input type = "text" name="price" value="<?= $oneroom['price']?>"><br />
		status:  <input type="radio" name="status" value="1" <?= $oneroom['status']==1 ? "checked": ""?>> Available<br>
	 			 <input type="radio" name="status" value="0" <?= $oneroom['status']==0 ? "checked": ""?>> Not Available<br>
	 	<input type="hidden" name="id" value="<?= $oneroom['id']?>">
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>