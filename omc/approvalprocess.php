<?php
require('mysqli_connect.php');
  $userAnswer = $_POST['email']; 
  echo $userAnswer;
  $query = "UPDATE user SET is_approved =? WHERE email =?"; 
  $assign = 1;
   $q = mysqli_stmt_init($con);
   mysqli_stmt_prepare($q, $query);
   mysqli_stmt_bind_param($q, 'is', $assign,$userAnswer);
   mysqli_stmt_execute($q);


   $query1 = "INSERT INTO passport (near_miss,uac,vfl,investigation,training,email)";
   $query1 .= "VALUES(?, ?, ?, ?, ?, ?)";
   $q1 = mysqli_stmt_init($con);
   mysqli_stmt_prepare($q1, $query1);
   $near=0;
   $uac=0;
   $vfl=0;
   $inves=0;
   $train=0;
   mysqli_stmt_bind_param($q1, 'iiiiis', $near,$uac,$vfl,$inves,$train,$userAnswer);
   mysqli_stmt_execute($q1);

  echo "success"
  // pass array in json_encode  

?>