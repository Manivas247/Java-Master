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
  echo "success"
  // pass array in json_encode  

?>