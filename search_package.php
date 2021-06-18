<?php 
	include"database.php";
	
	$sql="SELECT * FROM package WHERE Package_name LIKE '%{$_POST["s"]}%' or Package_Description LIKE '%{$_POST["s"]}%'";
	$res=$db->query($sql);
		echo "<table border='1px' class='table'>
				<tr>
					<th>Package_ID</th>
					<th>Package_Name</th>
					<th>Description</th>
					<th>Image</th>
                    <th>Duration</th>
                    <th>Price</th>
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
				<td>{$row["Package_ID"]}</td>
				<td>{$row["Package_name"]}</td>
				<td>{$row["Package_Description"]}</td>
                <td>{$row["Image"]}</td>
                <td>{$row["Duration"]}</td>
                <td>{$row["Price"]}</td>
				<td><a href='view_package_details.php?id={$row["Package_ID"]}' class='btnb'>View</a></td>
				<td><a href='package_delete.php?id={$row["Package_ID"]}' class='btnr'>Delete</a></td>
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