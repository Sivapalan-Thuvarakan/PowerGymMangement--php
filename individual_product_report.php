<?php

    header('Content-Type:application/json');
	include"database.php";

         //Package sales
     $sq="SELECT p.Product_Name as Product_Name, SUM(o.subtotal) total
     FROM `order_item` o  INNER JOIN product p ON 
     p.Product_ID=o.Product_Id GROUP BY Product_Name";
     $res=$db->query($sq);
     $data=array();
     foreach($res as $row)
     {
         $data[]=$row;
     }
     $res->close();
      print json_encode($data);
?>