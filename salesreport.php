<?php

    header('Content-Type:application/json');
	include"database.php";
	// session_start();
	// if(!isset($_SESSION["AID"]))
	// {
	// 	echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	// }	
    //Sales Report
    $sq="SELECT DATE(o.Date) as DATE, SUM(i.subtotal) totalSale
    FROM `order` o  INNER JOIN order_item i ON 
    o.Order_ID=i.Order_Id GROUP BY DATE(Date)";
    $res=$db->query($sq);
    $data=array();
    foreach($res as $row)
    {
        $data[]=$row;
    }
    $res->close();
     print json_encode($data);

?>