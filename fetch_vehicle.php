<?php

	$bike_producer= $_POST['bike_producer'];
	$year= $_POST['year'];
	$size= $_POST['size'];
	$bike_model= $_POST['bike_model'];
	$query="select * from vehicle where ";
	
	if($bike_producer !=''){

		$query .=" Bike_Producer='$bike_producer'";
	
	}

	if($year !=''){


		if($bike_producer !=''){

		$query .=" AND ";
	
		}

		$query .=" Year='$year'";
		
	}

	if($size !=''){
		if($bike_producer !='' || $year !='') {

			$query .=" AND ";

		}

		$query .=" Size='$size'";
		
	}

	if($bike_model !=''){

		if($bike_producer !='' || $year !='' || $size !='') {

			$query .=" AND ";

		}

		$query .=" Bike_Model='$bike_model'";
		
	}

	//$query_string ="SELECT * from vehicle1 where Bike_Producer ="."$bike_producer";
	//$query_string1 ="SELECT * from vehicle";

	//$result = $mysqli-> query("SELECT * from vehicle");
	$conn=mysqli_connect("localhost","","","test");
	
	 $result=mysqli_query($conn,$query);

	 $row_num = mysqli_num_rows($result);
	 
	 if($row_num >0){
	 	while($row = mysqli_fetch_assoc($result)){

	 		echo "<tr><td>$row[Bike_Producer]</td><td>$row[Year]</td><td>$row[Size]</td><td>$row[Bike_Model]</td><td><button class='btn btn-danger item-delete' value='$row[vehicle_id]' onclick='get_details_parts($row[vehicle_id])'>Parts List</button></td></tr>";	

	 	}

	 }

?>