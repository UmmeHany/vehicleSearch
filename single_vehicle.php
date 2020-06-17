<?php

	

	$vehicleId=$_POST['vehicle_id'];
	
	//$query_string ="SELECT * from vehicle1 where Bike_Producer ="."$bike_producer";
	//$query_string1 ="SELECT * from vehicle";

	//$result = $mysqli-> query("SELECT * from vehicle");
	$conn=mysqli_connect("localhost","","","test");
	
	$query="select * from vehicle where vehicle_id='$vehicleId'";
	
	 $result=mysqli_query($conn,$query);

	 $row_num = mysqli_num_rows($result);

	 
	 
	 if($row_num >0){
	 	while($row = mysqli_fetch_assoc($result)){

	 		echo "<tr><td>$row[Series]</td><td>$row[Configuration]</td><td>$row[Sales_Name]</td><td>$row[Cylinder]</td><td>$row[Engine_output]</td><td>$row[Country]</td></tr>";

	 	}


	 }

?>