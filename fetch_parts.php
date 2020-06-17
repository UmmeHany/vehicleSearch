<?php

$vehicle_id= $_POST['vehicle_id'];

$conn=mysqli_connect("localhost","","","test");

/*$query_main="select * from parts where VehicleIds LIKE  ";

$q_string="'%,$vehicle_id,%'";

$q_string_extention=" OR ";

$q_string_extention_further="'$vehicle_id,%'";

$q_string_extention_further_more="'%,$vehicle_id'";


$query=$query_main.$q_string.$q_string_extention.$q_string_extention_further.$q_string_extention.$q_string_extention_further_more;

echo $query;*/

$query="select PartsId,Name,Active,VehicleIds from parts";
$result=mysqli_query($conn,$query);
$row_num = mysqli_num_rows($result);

$parts_id=array();
$j=0;
	 
	 if($row_num >0){
	 	$counter=0;
	 	while($row = mysqli_fetch_assoc($result)){
				$arr=explode(",",$row['VehicleIds']);
				$i=0;
				for($i=0;$i<count($arr);$i++){
					if($arr[$i] == $vehicle_id ){
						$parts_id[$j]=$row['PartsId'];
						$j++;		

					}

				}
	 	}

	 	}

	 	//var_dump($parts_id);

	 	//$result_final=array();
	 	$k=0;
	 	$query_string=" ";

	 	for($k=0;$k<count($parts_id);$k++){

	 		$parts_id_index=$parts_id[$k];
	 		$query_string="select * from parts where PartsId='$parts_id_index'";
	 		//var_dump($query_string);
	 		$result_final[$k]=mysqli_query($conn,$query_string);

	 	}
	 	

	 	//var_dump($result_final);

	 	$result_arr=array();

	 	var_dump(count($result_final));

	 	for($n=0;$n<count($result_final);$n++){

	 		
	 		array_push($result_arr,mysqli_fetch_assoc($result_final[$n]));


	 	}


	 	//var_dump("hany");

	 	//var_dump(count($result_arr));




//$query_string="select * from parts where PartsId='$parts_id'";
//echo $query_string;
//$result_final=mysqli_query($conn,$query_string);
	 	//var_dump(json_encode($result_arr)); 

//$final_res=json_encode(mysqli_fetch_assoc($result_final));

//echo  $final_res;


$st="";

	 	
	 	for($m=0;$m<count($result_arr);$m++){

	 		$st="<tr>";
	 	$st .="<td>".$result_arr[$m]['PartsId']."</td>";
	 	$st .="<td>".$result_arr[$m]['Name']."</td>";
	 	$st .="<td>".$result_arr[$m]['Active']."</td>";
	 	$st .="</tr>";

	 	echo $st;

	 	
	     }


?>