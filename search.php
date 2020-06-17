<?php 

include('db.php');

?>

<html>  
  <head> 
    <script src="lib/jquery.min.js"></script>  
    <link rel="stylesheet" href="lib/bootstrap.min.css" />  
    <script src="lib/jquery.dataTables.min.js"></script>  
    <script src="lib/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="lib/dataTables.bootstrap.min.css" />  
    <script src="lib/bootstrap.min.js"></script> 

   <title>Vehicle Search</title>  
       
   <style>  
           body  
           {  
                margin:0;  
                padding:0;  
                background-color:#f1f1f1;  
           }  
           .box  
           {  
                width:900px;  
                padding:20px;  
                background-color:#fff;  
                border:1px solid #ccc;  
                border-radius:5px;  
                margin-top:10px;  
           }  

           .searchField {
              display: inline-block;
              vertical-align: top;
              height: 20px;
              width:20%
            }
      </style> 
      <script type="text/javascript">

          function search_func(){

            var validation=form_validation();

            if(validation == 0){

              alert("Please Select One");
              return;

            }
            else{
			  $('#vehicle_data').empty();
              show_data();

            }

          }

          function show_data(){
              var data_search = $('#search_form').serialize();  

              $.ajax({

                type: 'ajax',
                method:'post',
                url: 'fetch_vehicle.php',
                data:data_search,
                dataType: 'html',
                success: function(data){ 
          
                  $('#vehicle_data').append(data);
                  
                  }});

          }
        
          function form_validation(){
            
            var bike_producer= document.getElementById("bike_producer").value;
            var year= document.getElementById("year").value;
            var size= document.getElementById("size").value;
            var bike_model= document.getElementById("bike_model").value;

            if(bike_producer==0 && year==0 && size==0  && bike_model==0){
              return 0;
            }
            else{
              return 1;
            }
            
           }

           function get_details_parts(vehicle_id){
 
              window.open('parts_details.php?vehicle_id='+vehicle_id);
            
            }

      </script>

 </head>  
 <body> 
                
      <div class="container box">  
           <h3 align="center">Search Filter</h3><br /> 
           <div class="form-group">

            <form id="search_form" action="fetch_vehicle.php" method="post">
              <label for="bike_producer">Select Bike Producer</label>
                    <select name="bike_producer" id="bike_producer" class="searchField" >
                      <option readonly value="">select one</option>
                      <?php 
                      
                      $query=mysqli_query($conn,"select DISTINCT Bike_Producer from vehicle Order by Bike_Producer");
                      while ($row=mysqli_fetch_array($query)) {
                     
                      ?>
                      <option value="<?=$row['Bike_Producer']?>"><?php echo $row['Bike_Producer'] ?></option>
                      <?php } ?>
                    </select>

               
                    <label for="year">Select Year</label>
                          <select name="year" id="year" class="searchField">
                            <option readonly value="">select one</option>
                            <?php 
                            
                            $query=mysqli_query($conn,"select DISTINCT year from vehicle Order by year DESC");
                            while ($row=mysqli_fetch_array($query)) {
                           
                            ?>
                            
                            <option value="<?=$row['year']?>"><?php echo $row['year'] ?></option>
                            <?php } ?>
                          </select>
                
              <label for="size">Select Size</label>
                    <select name="size" id="size" class="searchField">
                       <option readonly value="">select one</option>
                      <?php 
                      
                      $query=mysqli_query($conn,"select DISTINCT Size from vehicle Order by Size");
                      while ($row=mysqli_fetch_array($query)) {
                     
                      ?>
                     
                      <option value="<?=$row['Size']?>"><?php echo $row['Size'] ?></option>
                      <?php } ?>
                    </select>

              <label for="bike_model">Select Bike Model</label>
                    <select name="bike_model" id="bike_model" class="searchField">
                      <option readonly value="">select one</option>
                      <?php 
                      
                      $query=mysqli_query($conn,"select DISTINCT Bike_Model from vehicle Order by Bike_Model");
                      while ($row=mysqli_fetch_array($query)) {
                     
                      ?>
                      
                      <option value="<?= $row['Bike_Model']?>"><?php echo $row['Bike_Model'] ?></option>
                      <?php } ?>
                    </select>

                    <button type="button" id="btnsearch" onClick="search_func();"style="float: right;">Search</button>

              </form>
          </div> 
           
      </div>  

      <div class="container box">  
           <h3 align="center">Vehicle List</h3><br />  
           <div class="table-responsive">  
                <br />  
                <table  class="table table-bordered table-striped">  
                      <thead>
                          <tr>  

                           <td>Bike Producer</td>
                           <td>Year</td>
                           <td>Size (Engine Size)</td>
                           <td>Bike Model </td>
                           <td>Parts </td>
                           
                           
                               
                              
                          </tr> 
                          </thead>
                          <tbody id="vehicle_data">
      
                          </tbody> 
                      
                </table>  
           </div>  
      </div>   

<div id="myModal" class="modal fade"  role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>

<div class="modal-body">
          <form id="myForm" action="" method="post" class="form-horizontal">
            
            <div class="form-group">
              <label for="name" class="label-control col-md-4">Item ID</label>
              <div class="col-md-8">
                <input type="text" name="txtItemID" class="form-control">
              </div>
            </div>

           <div class="form-group">
              <label for="name" class="label-control col-md-4">Item Name</label>
              <div class="col-md-8">
                <input type="text" name="txtItemName" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="label-control col-md-4">Brand ID</label>
              <div class="col-md-8">
                <input type="text" name="txtBrandID" class="form-control">
              </div>
            </div>


            <div class="form-group">
              <label for="name" class="label-control col-md-4">Brand Name</label>
              <div class="col-md-8">
                <input type="text" name="txtBrandName" class="form-control">
              </div>
            </div>


            <div class="form-group">
              <label for="name" class="label-control col-md-4">Model ID</label>
              <div class="col-md-8">
                <input type="text" name="txtModelID" class="form-control">
              </div>
            </div>


            <div class="form-group">
              <label for="name" class="label-control col-md-4">Model Name</label>
              <div class="col-md-8">
                <input type="text" name="txtModelName" class="form-control">
              </div>
            </div>

            
          </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

      </body>  
      
 </html>
    



      




 