<?php
	include"database.php";
	session_start();
	
	$s="delete from advertisement where	Advertisement_ID={$_GET["id"]}";
	$db->query($s);
	echo "<script>window.open('add_advertisement.php?mes=Data Deleted.','_self');</script>"
?>