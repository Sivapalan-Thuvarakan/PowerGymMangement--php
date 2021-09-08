
<?php
	include"database.php";
	session_start();
	
	$s="delete from trainer where Trainer_ID={$_GET["id"]}";
	$db->query($s);
	echo "<script>window.open('add_trainer.php?mes=Data Deleted.','_self');</script>"
?>
