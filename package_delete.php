<?php
	include"database.php";
	session_start();
	$s="delete from package where Package_ID={$_GET["id"]}";
	$db->query($s);
	echo"<script>window.open('add_package.php?mes=Data Deleted.','_self');</script>";

?>