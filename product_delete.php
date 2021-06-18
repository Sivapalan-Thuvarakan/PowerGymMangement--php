<?php
	include"database.php";
	session_start();
	
	$s="delete from product where Product_ID={$_GET["id"]}";
	$db->query($s);
	echo "<script>window.open('add_product.php?mes=Data Deleted.','_self');</script>"
?>