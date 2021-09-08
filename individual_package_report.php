<?php

    header('Content-Type:application/json');
	include"database.php";

         //Package sales
     $sq="SELECT p.Package_name as Package_Name, SUM(r.Fees) total
     FROM `registration` r  INNER JOIN package p ON 
     r.Package_ID=P.Package_ID GROUP BY Package_Name";
     $res=$db->query($sq);
     $data=array();
     foreach($res as $row)
     {
         $data[]=$row;
     }
     $res->close();
      print json_encode($data);
?>