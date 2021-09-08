<?php 
	include"database.php";
	
	$sql="SELECT * FROM trainer WHERE Trainer_Name LIKE '%{$_POST["s"]}%' or user_name LIKE '%{$_POST["s"]}%'  or address LIKE '%{$_POST["s"]}%' ";
	$res=$db->query($sql);
		echo "<table class='styled-table'>
				<thead>
				<tr>
					<th>Trainer_ID</th>
					<th>Trainer_Name</th>
					<th>Address</th>
					<th>Gender</th>
                    <th>DOB</th>
					<th>User Name</th>
					<th>Password</th>
					<th>View</th>
					<th>Delete</th>
				</tr>
				</thead>
				";
	if($res->num_rows>0)
		
	{
		//$i=0;
		while($row=$res->fetch_assoc())
		{
			//$i++;
			echo "
			<tbody>
			<tr>
				<td>{$row["Trainer_ID"]}</td>
				<td>{$row["Trainer_name"]}</td>
				<td>{$row["Address"]}</td>
				<td>{$row["Gender"]}</td>
				<td>{$row["DOB"]}</td>
                <td>{$row["user_name"]}</td>
				<td>{$row["password"]}</td>
				<td><a href='view_trainer_details.php?id={$row["Trainer_ID"]}' class='btnb'>View</a></td>
				<td><a href='trainer_delete.php?id={$row["Trainer_ID"]}' class='btnr'>Delete</a></td>
				</tr>
				</tbody>
			";
		}
				echo "</table>";
	}
		
	else
	{
		echo "<p>No Record Found</p>";
	}
	
?>