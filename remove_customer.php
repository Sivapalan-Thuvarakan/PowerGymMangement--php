<?php
	include"database.php";
	session_start();
	$s="delete from user where User_ID={$_GET["id"]}";
    
	$db->query($s);
	echo"<script>window.open('view_customer.php?mes=Data Deleted.','_self');</script>";

?>