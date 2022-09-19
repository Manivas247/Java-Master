<?php  include 'mysqli_connect.php';
if(isset($_POST['delete'])){
	
	$query = "TRUNCATE TABLE safety_questions"; 
	$result = mysqli_query($con,$query);

	$query1 = "TRUNCATE TABLE safety_options"; 
	$result1 = mysqli_query($con,$query1);
	echo '<script>alert("Vendor Updated Successfully")</script>';
	//Validate First Query
	if($result){
		$message = "All Questions has been Deleted successfully";
		header("LOCATION: addquiz_safety.php");
		}
	else{
		$message = "No Questions found in the record";
	}


	}
		

?>