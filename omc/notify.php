<?php
require('mysqli_connect.php');
$ids = array();
// $ids = implode(",",$_POST["id"]);
$ids = $_POST["id"];


// $deactive = "UPDATE inf SET active=0 where n_id IN(".$ids.")";
$deactive = "UPDATE assign_task SET active=0 where incident_id= ".$ids." ";

$result = mysqli_query($con,$deactive);
echo mysqli_error($con); 
  
  
?>