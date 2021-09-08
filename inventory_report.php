<?php

    header('Content-Type:application/json');
	include"database.php";

         //Package sales
     $sq="SELECT Product_Name , (Price*Quantity) total
     FROM `product`GROUP BY Product_Name";
     $res=$db->query($sq);
     $data=array();
     foreach($res as $row)
     {
         $data[]=$row;
     }
     $res->close();
      print json_encode($data);
?>