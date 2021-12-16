<?php
include '../Database.php';
$connect = new Database();
$db = $connect->db();
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($db, $_POST["query"]);
	$query = "
	SELECT * FROM customers 
	WHERE (`id` LIKE '%".$search."%') OR (`first_name` LIKE '%".$search."%') OR (`last_name` LIKE '%".$search."%') OR (`email` LIKE '%".$search."%') OR (`mobile` LIKE '%".$search."%')
	";

	$result = mysqli_query($db, $query);
	if(mysqli_num_rows($result) > 0)
	{
		$output .= '
		 
		<div class="table-responsive">
						<table class="table table bordered">
							<tr>
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Address</th>
								<th>Mobile</th>
								<th>Action</th>
							</tr>';
		while($row = mysqli_fetch_array($result))
		{
			$customerid = $row["id"];
			$output .= '
				<tr>
					<td>'.$row["id"].'</td>
					<td>'.$row["first_name"].'</td>
					<td>'.$row["last_name"].'</td>
					<td>'.$row["email"].'</td>
					<td>'.$row["address"].'</td>
					<td>'.$row["mobile"].'</td>
					<td><a href="add_inquiry.php?customer='.$customerid.'" type="button" style="color:white" class="btn btn-warning btn-sm">ADD INQUIRY</a></td>
				</tr>


			';
		}
		echo $output;
}
else
{
	echo 'Data Not Found';
}

}


?>