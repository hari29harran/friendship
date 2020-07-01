<?php
	//DB Connect
	include 'db.php';
	//Storing form values in variable
	if(isset($_POST['key']) && $_POST['key']==4789)
	{
		$name=$_POST['name'];
		$age=$_POST['age'];
		$location=$_POST['location'];

		//Sql query to insert the user details
		$sql="INSERT INTO user_friend VALUES('$name','$age','$location')";
		if(mysqli_query($con,$sql))
		{
			echo "Friend Details Added Successfully";
		}
		else
		{
			echo "Some Error Occured<br/>".mysqli_error($con);
		}
		mysqli_close($con);
	}
	else
	{
		header("location:index.php");
	}
?>