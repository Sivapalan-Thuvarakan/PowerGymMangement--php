<?php 
	include"database.php";
	
	$sql="SELECT * FROM product WHERE Product_Name LIKE '%{$_POST["s"]}%' or Quantity LIKE '%{$_POST["s"]}%'  or Product_Description LIKE '%{$_POST["s"]}%' ";
	$res=$db->query($sql);
		echo "<table border='1px' class='table'>
				<tr>
					<th>Product_ID</th>
					<th>Product_Name</th>
					<th>Description</th>
					<th>Category</th>
                    <th>Brand</th>
                    <th>Colour</th>
                    <th>Size</th>
					<th>Price</th>
					<th>Image</th>
                    <th>Quantity</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				";
	if($res->num_rows>0)
		
	{
		//$i=0;
		while($row=$res->fetch_assoc())
		{
			//$i++;
			echo "<tr>
				<td>{$row["Product_ID"]}</td>
				<td>{$row["Product_Name"]}</td>
				<td>{$row["Product_Description"]}</td>
				<td>{$row["Category_ID"]}</td>
				<td>{$row["Brand_ID"]}</td>
                <td>{$row["Colour_ID"]}</td>
                <td>{$row["Size_ID"]}</td>
				<td>{$row["Price"]}</td>
                <td>{$row["Image"]}</td>
                <td>{$row["Quantity"]}</td>
				<td><a href='view_product_details.php?id={$row["Product_ID"]}' class='btnb'>View</a></td>
				<td><a href='product_delete.php?id={$row["Product_ID"]}' class='btnr'>Delete</a></td>
				</tr>
			";
		}
				echo "</table>";
	}
		
	else
	{
		echo "<p>No Record Found</p>";
	}
	
?>