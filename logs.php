<?php

	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	if(!isset($_SESSION["UID"]) && !isset($_SESSION["TRID"]))
	{
		echo"<script>window.open('user_login.php?mes=Access Denied...','_self');</script>";
		
	}
	
    $sql="SELECT * FROM chats ORDER BY ID DESC";
    $result=$db->query($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            echo"<div id='cbox'>";
                echo
                "<div>
                    <b id='user_name'>{$row['NAME']}</b>
                    <i id='time'>{$row['LOGS']}</i>
                    <span id='message'>{$row['MESSAGE']}</span>
                 </div>
                ";
            echo"</div>";
        }
    }
    else
    {
        echo "<p>No Chat Yet......</p>";
    }
		
?>