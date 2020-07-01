<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <!--Including Bootstrap Files,Jquery and Stylesheet -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</script>
</head>
<body>
    <!--Including Header -->
	<nav class="navbar navbar-dark">
	  	<!-- Links -->
		<a class="nav-link"><img src="images/logo.png"></a>
		<div class="text-right">
	  		<a class="nav-link" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Add Friend</a>
		</div>
	</nav>
	<div class="modal fade" id="myModal" >
	    <div class="modal-dialog" >
	      <div class="modal-content" >
	        <div class="modal-header">
	          <h4 class="modal-title"><i>Enter Friend Details</i></h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        
	        <!-- Modal body -->
	        <div class="modal-body">
	        <form id="friend-form">
	          <div class="form-group">
	                <img src="images/name.png" class="input_img" />
	                <input type="text" name="name" class="form-fields" pattern="[A-z ]{4,30}" title="Name should have Mininmum 4 characters and Maximum 30 characters" placeholder="Name" required />
	            </div>
	            <br/>
	            <div class="form-group">
	                <img src="images/age.png" class="input_img" />
	                <input type="number" name="age" class="form-fields" placeholder="Age" required />
	            </div><br/>
	             <div class="form-group">
	                <img src="images/location.png" class="input_img" />
	                <input type="text" name="location" class="form-fields" pattern="[A-z]+" title="Invalid Location" placeholder="Location" required />
	            </div><br/>
	            <input type="hidden" name="key" value="4789">
	            <div class="form-group text-center">
	                <input type="submit" value="Add Friend" name="add_friend" class="friend-btn btn" />
	            </div><br/>
	            <div id="res" class="text-center"></div>
	            <br/>
	            </form>      
	        </div>
	      </div>
	    </div>
  	</div>
  	<div class="container">
  		<h2 class="text-center"><i>Friends List</i></h2>
  		<br/>
  		<div class="form-group">
  			<img src="images/search.png" class="input_img" />
  			<form id="search-form">
  				<input type="text" class="form-control" name="search" id="search" placeholder="Search by Name,Age and Location" />
  				<input type="hidden" name="key" value="789">
  			</form>
  		</div>
  		<br/>
  		<div id="display">
  		<div class="table-responsive">
  			<table class="table table-bordered table-hover text-center">
  				<tr class="bg-light"><th>S.No</th><th>Name</th><th>Age</th><th>Location</th></tr>
		  		<?php 
		  		include 'db.php';
		  		$sql="SELECT * FROM user_friend";
		  		if($res=mysqli_query($con,$sql))
		  		{
		  			if(mysqli_num_rows($res)==0)
		  			{
		  				?><tr><td colspan="4" class="text-center">Sorry,No Records Found</td></tr> <?php
		  			}
		  			else
		  			{
		  				$i=1;
			  			while($row=mysqli_fetch_array($res))
			  			{
			  				?><tr><td><?php echo $i; ?></td><td><?php echo $row['name']; ?></td><td><?php echo $row['age']; ?></td><td><?php echo $row['location']; ?><br/>
			  					<a href="https://google.com/maps/place/<?php echo $row['location']; ?>" style="text-decoration: none" target="_blank">Map View</a></td></tr><?php
			  				$i++;
			  			}
		  			}
		  		}
		  		?>
		  	</table>
		</div>
		</div>
  	</div>
  	<div class="text-center footer fixed-bottom">Designed by <b>Sri Hari Harran</b> || Visted on <?php date_default_timezone_set('Asia/Kolkata'); echo date("d-m-Y h:i:sa"); ?></div>
    
    <!-- Welcome Text -->
   	<script>
    $('input').focus(function()
    {
      $('#res').html('');
    })
    $('#friend-form').submit(function(e)
    {
        e.preventDefault();
        $.ajax({
            url:"add_friend.php",
            type:"POST",
            data:$('#friend-form').serialize(),
            success:function(result){
            	 $('#friend-form')[0].reset();
                var res=$.trim(result);
                if(res=='Friend Details Added Successfully')
                {
                  
                  // $('#res').html('<b>'+res+'</b>');
                  alert(res);
                  location.reload();

                 
                }
                else{
                  $('#res').html('<b>'+res+'</b>');

                }
                
                
            }
        });
    });
    $('#search').on('input',function()
    {
    	$.ajax({
            url:"search_friend.php",
            type:"POST",
            data:$('#search-form').serialize(),
            success:function(result){
                  $('#display').html(result);
            }
        });
    });
	</script>
</body>
</html>
