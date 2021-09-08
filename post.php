<?php
    
	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	if(!isset($_SESSION["UID"]) && !isset($_SESSION["TRID"]))
	{
		echo"<script>window.open('user_login.php?mes=Access Denied...','_self');</script>";
		
	}


    $name=$_POST["name"];
    $message=$_POST["message"];
    $sql="INSERT INTO chats (NAME,MESSAGE,LOGS) VALUES ('$name','$message',NOW())";
    if($db->query($sql))
    {
        echo "Message posted....";
    }
    else
    {
        echo "Error....";
    }
?>