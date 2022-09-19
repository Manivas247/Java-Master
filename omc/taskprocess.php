<?php
require('mysqli_connect.php');
  $userAnswer = $_POST['email']; 
  $query = "SELECT * FROM user WHERE email= '$userAnswer'";
  $result = mysqli_query($con, $query);

  while($rows = mysqli_fetch_assoc($result)){
    $name = $rows['name'];
     $phone = $rows['phone'];
    $designation = $rows['designation'];
  }
  // for first row only and suppose table having data
  echo json_encode(array('name' => $name,'phone' => $phone,'designation' => $designation, ));
  // pass array in json_encode  

?>