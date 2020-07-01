<?php
if(isset($_POST['key']) && $_POST['key']==789)
{
?>
<div class="table-responsive">
		<table class="table table-bordered table-hover text-center">
			<tr class="bg-light"><th>S.No</th><th>Name</th><th>Age</th><th>Location</th></tr>
  		<?php 
  		include 'db.php';
  		$search=$_POST['search'];
  		$sql="SELECT * FROM user_friend WHERE location LIKE '%$search%' OR name LIKE '%$search%' OR age LIKE '%$search%'";
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
<?php
}
else
{
	header("location:index.php");
}