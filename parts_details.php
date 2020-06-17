<?php
 
include('db.php');

$vehicleId=$_GET['vehicle_id'];

?>

<html>  
 <head> 
	<script src="lib/jquery.min.js"></script>  
    <link rel="stylesheet" href="lib/bootstrap.min.css" />  
    <script src="lib/jquery.dataTables.min.js"></script>  
    <script src="lib/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="lib/dataTables.bootstrap.min.css" />  
    <script src="lib/bootstrap.min.js"></script> 
      
   <title>Parts List</title>  

	<style>  
	   body  
	   {  
	        margin:0;  
	        padding:0;  
	        background-color:#f1f1f1;  
	   }  
	           
	 </style> 

 <script type="text/javascript">

 	$(document).ready(function(){ 
 	
 		var vehicle_id=<?=$vehicleId?>;
 		$.ajax({

                type: 'ajax',
                method:'post',
                url: 'fetch_parts.php',
                data:{'vehicle_id':vehicle_id},
                dataType: 'html',
                success: function(data){

                	$('#parts_data').append(data); 
                 }
             });

 		$.ajax({

                type: 'ajax',
                method:'post',
                url: 'single_vehicle.php',
                data:{'vehicle_id':vehicle_id},
                dataType: 'html', 
                
                success: function(data){

                	$('#vehicle_details').append(data);  
                  
                 }            

             });		

 	 });

 </script>

</head>

<body>

	<div>
		<h3 align="center">Parts List</h3><br />

		<div>

			<table  class="table table-bordered table-striped">  
                      <thead>
                          <tr>  

                           <td>Parts ID:</td>
                           <td>Parts Name:</td>
                           <td>Active Status:</td>
                        
                          </tr> 
                          </thead>
                          <tbody id="parts_data">
      
                          </tbody> 
                      
                </table> 

                <div>
					<h3 align="center">Vehicle Details</h3><br />

				<div>

                <table  class="table table-bordered table-striped">  
                      <thead>
                          <tr>  

                           <td>Series</td>
                           <td>Configuration</td>
                           <td>Sales Name</td>
                           <td>Cylinder </td>
                           <td>Engine Output</td>
                           <td>Country</td>              
                          </tr> 
                          </thead>
                          <tbody id="vehicle_details">
      
                          </tbody> 
                      
                </table>  

		</div>

	</div>

</body>

</html>







