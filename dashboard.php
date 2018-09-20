<?php

session_start();

if($_SESSION['status']=='loggedin')
{
  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Letstravel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="override.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<!--navbar-->
<div class="row" id="bar">
    <div class="col-sm-10 heading" id="up">Letstravel</div>
    <!--<div class="col-sm-2" id="log"><a id="logout" href="logout.php" name="logout_link">Logout</a></div>-->
    <div class="col-sm-2" id="log">
      <form action="dashboard.php" method="post">
        <input type="submit" name="logout_link" value="Logout" id="logout">
      </form>
       <?php
        if(isset($_POST['logout_link']))
        {
          session_start();
          session_destroy();
          header("Location: adminlogin.html");

        }
      ?>
    </div>

</div>

<!-- create trip Modal -->
<div id="createTripModal" class="modal">
  <!-- Modal content -->
	<div class="modal-content">
    	<div style="margin-bottom: 6%;">
    		<span class="close">&times;</span>
    		<label><h3 style="font-family: 'Montserrat', sans-serif;">Create trip</h3></label>
    	</div>
    	<div class="form-group row">
    		<label class="col-sm-4">Select Location</label>
    		<!--<i class="material-icons md-36 col-sm-1">location_on</i>-->
    		<div class="col-sm-6">      
      			<select name="locs" multiple="" class="label ui selection fluid search dropdown" id="tripLocs" onChange="getLocs();">
			      <option value="">Locations</option>
			      <option value="Delhi">Delhi</option>
			      <option value="Mumbai">Mumbai</option>
			      <option value="Agra">Agra</option>
			      <option value="Chennai">Chennai</option>
			      <option value="Kolkata">Kolkata</option>
			      <option value="Goa">Goa</option>
			      <option value="Pune">Pune</option>
			      <option value="Bangalore">Bangalore</option>
    			</select>
    		</div>    
  		</div>
      <div class="form-group row">
        <label class="col-sm-4">Select Start Location</label>
        <!--<i class="material-icons md-36 col-sm-1">location_on</i>-->
        <div class="col-sm-6">      
            <select name="start" class="label ui selection fluid dropdown" id="start">
            <option value="" disabled selected>Start Location</option>
            <!--<option value="">Location</option>
            <option value="1">Delhi</option>
            <option value="2">Mumbai</option>
            <option value="3">Agra</option>
            <option value="4">Chennai</option>-->
          </select>
        </div>    
      </div>
  		<div class="form-group row">
    		<label class="col-sm-4">Start Date</label>
    		<!--<i class="material-icons md-36 col-sm-1">date_range</i>-->
    		<div class="col-sm-5">                      
                <form>                  
                    <div class='input-group date' id='datepicker'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                        	<span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>                  
                </form>         
    		</div>    
  		</div>
  		<div class="form-group row">
    		<label class="col-sm-4">End Date</label>
    		<!--<i class="material-icons md-36 col-sm-1">date_range</i>-->
    		<div class="col-sm-5">      
                <form>                  
                    <div class='input-group date' id='datepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>                  
                </form>
            </div>    
        </div>
        <div class="form-group row">
		    <label class="col-sm-4 ">Base Price</label>
		    <!--<i class="material-icons md-36 col-sm-1">attach_money</i>-->
		    <div class="col-sm-7">      
		        <div class='input-group' >
		            <input type='text' class="form-control" placeholder="Base Price" style="border-radius: 5px;" />                    
		        </div>
		    </div>    
  		</div> 
  		<div class="form-group row">
    		<label class="col-sm-4">Tour Guide Name</label>
    			<!--<i class="material-icons md-36 col-sm-1">person</i>-->
    			<div class="col-sm-7">      
                	<div class='input-group'>
                    	<input type='text' class="form-control"  placeholder="Tour Guide Name" style="border-radius: 5px;" />                    
                	</div>      
    			</div>    
  		</div> 
  		<div class="form-group row">
    		<label  class="col-sm-4">Tour Guide Contact</label>
    		<!--<i class="material-icons md-36 col-sm-1">call</i>-->
    		<div class="col-sm-7">      
                <div class='input-group'>
                    <input type='text' class="form-control" placeholder="Tour Guide Contact" style="border-radius: 5px;"/>                    
                </div>      
    		</div>    
  		</div> 
  		<div class="form-group row">
    		<label  class="col-sm-4">Thumbnail</label>
    		<div class="col-sm-8"> 
    			<div class='input-group'>     
        			<input class="upload" type="file" name="tn-uploaded">       
        		</div>
    		</div>    
  		</div>
  		<div class="form-group row">
    		<label class="col-sm-4 col-form-label">Itinerary</label>
    		<div class="col-sm-8">
    			<div class='input-group'>      
        			<input class="upload" type="file" name="it-uploaded">        
        		</div>
    		</div>    
  		</div>
  		<div class="modal-footer">        
	        <button type="button" class="yellowBtn createBtn">Create Trip</button>
      	</div>
    </div>
</div>
<!--modal ends-->

<!-- Trip Modal-->
<div id="viewTripModal" class="modal">
  <!--Modal content -->
	<div class="modal-content">
    	<div class="modal-header">
        	<h4 class="modal-title">Location</h4>
        	<button type="button" data-dismiss="modal" aria-label="Close" class="closeBtn">
          		<span aria-hidden="true" class="close" id="closeTrip">&times;</span>
        	</button>
      	</div>   
       	<div class="modal-body" id="carouselimg">
          	<img class="modal-img" src="images/couple.jpg">
           	<div class="modalText">
           		<label><b>Date:</b> 26th December, 2018 to 4th January, 2019</label><br>
           		<label><b>Description:</b> Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. </label><br>
           		<a href="download.txt" download class="downloadFile">Download itinerary</a><br>
           		<label><b>Base Price:</b> ₹8000</label><br>
           		<label><b>Tour Guide Name:</b> Vicky Daiya</label><br>
           		<label><b>Tour guide Contact:</b> 9876543210</label>
       		</div>   
      	</div>
      	<div class="modal-footer">
   			<a href="#"><button type="button" class="yellowBtn delBtn">Delete Trip</button></a>
      	</div>                                   
    </div>
</div>
<!--modal ends-->

<!--trip cards-->
<div class="row" id="cardsRow1">
    <a href="#viewTripModal" onclick="javascript:openModal();">
        <div class="col-sm-3">
        	<div class="card">
    			<img class="card-img-top" src="images/couple.jpg" alt="Avatar" style="width:100%">
  				<div class="card-body">
	    			<h4 class="card-title"><b>LOCATION</b></h4> 
    				<p class="card-text">Starting from New Delhi</p> 
  				</div> 
  			</div>
    	</div>
	</a>
   <a href="#viewTripModal" onclick="javascript:openModal();">
        <div class="col-sm-3">
        	<div class="card">
        		<img class="card-img-top" src="images/couple.jpg" alt="Avatar" style="width:100%">
  				<div class="card-body">
    				<h4 class="card-title"><b>LOCATION</b></h4> 
    				<p class="card-text">Starting from Cochin</p> 
  				</div> 
        	</div>
    	</div>
	</a>
    <a href="#viewTripModal" onclick="javascript:openModal();">
        <div class="col-sm-3">
        	<div class="card">
        		<img class="card-img-top" src="images/couple.jpg" alt="Avatar" style="width:100%">
	  			<div class="card-body">
	    			<h4 class="card-title"><b>LOCATION</b></h4> 
	    			<p class="card-text">Starting from Agra</p> 
	  			</div> 
        	</div>
    	</div>
	</a>
    <a href="#viewTripModal" onclick="javascript:openModal();">
        <div class="col-sm-3">
        	<div class="card">
        		<img class="card-img-top" src="images/couple.jpg" alt="Avatar" style="width:100%">
	  			<div class="card-body">
	    			<h4 class="card-title"><b>LOCATION</b></h4> 
	    			<p class="card-text">Starting from Mumbai</p> 
	  			</div>
        	</div> 
    	</div>
	</a>
</div>

<div class="row" id="cardsRow2">
    <a href="#viewTripModal" onclick="javascript:openModal();">
        <div class="col-sm-3">
        	<div class="card">
        		<img class="card-img-top" src="images/couple.jpg" alt="Avatar" style="width:100%">
	  			<div class="card-body">
	    			<h4 class="card-title"><b>LOCATION</b></h4> 
	    			<p class="card-text">Starting from Kolkata</p> 
	  			</div> 
        	</div>
    	</div>
	</a>

    <!--create trip card-->
    <a href="#createTripModal" onclick="javascript:openCreateTripModal();">
        <div class="col-sm-3">
        	<div class="createCard">
        		<div class="top">
        			<i class="material-icons add">add_circle_outline</i>
        		</div>
  				<div class="container">
    				<h4 class="card-title"><b>CREATE A NEW TRIP</b></h4> 
  				</div>
  			</div>
    	</div>
	</a>
</div>

<script>
	var modal = document.getElementById('createTripModal');
	var tripModal = document.getElementById('viewTripModal');
	var span = document.getElementsByClassName("close")[0];
	var closeBtn = document.getElementById("closeTrip");
	function openModal()
  {
	    tripModal.style.display="block";
	}
	function openCreateTripModal()
  {
	    modal.style.display="block";
	}
	closeBtn.onclick=function()
  {
	    tripModal.style.display="none";
	}
	span.onclick = function() 
  {
	    modal.style.display = "none";    
	}
	window.onclick = function(event) 
  {
	    if (event.target == modal||event.target==tripModal) 
      {
	        modal.style.display = "none";
	        tripModal.style.display="none";
	    }
	}
	$(function () 
  {
    $('#datepicker').datepicker(
    {
      format: "dd/mm/yyyy",
      autoclose: true,
      //todayHighlight: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      autoclose: true,
      changeMonth: true,
      changeYear: true,
      orientation: "button"
    });
	});
	$(function () 
  {
	  $('#datepicker1').datepicker(
    {
      format: "dd/mm/yyyy",
      autoclose: true,
      //todayHighlight: true,
      showOtherMonths: true,
      selectOtherMonths: true,
      autoclose: true,
      changeMonth: true,
      changeYear: true,
      orientation: "button"
	   });
	});
  $(function()
  {
    $('.label.ui.dropdown').dropdown({
      maxSelections: 5
  });
	});
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="location.js"></script>
</body>
</html>
<?php
}
else
{
  header("location:adminlogin.html"); 
}
//mysqli_close($conn);
?>

