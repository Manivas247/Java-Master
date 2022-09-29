<?php
require('mysqli_connect.php');
  $email = $_POST['email']; 
  $id= $_POST['id']; 
  $query = "UPDATE training SET is_approved =? WHERE id =?"; 
  $assign = 1;
   $q = mysqli_stmt_init($con);
   mysqli_stmt_prepare($q, $query);
   mysqli_stmt_bind_param($q, 'is', $assign,$id);
   mysqli_stmt_execute($q);

  
$query3= "SELECT * FROM passport WHERE email ='$email'";
$q3 = mysqli_stmt_init($con);
mysqli_stmt_prepare($q3, $query3);
mysqli_stmt_execute($q3);                                            
$result3 = mysqli_stmt_get_result($q3); 
$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);                                     
$training1=$row3['training'];

 $query4= "UPDATE passport SET training =? WHERE email =?"; 
 $assign = $training1+1;
 $q4 = mysqli_stmt_init($con);
 mysqli_stmt_prepare($q4, $query4);
 mysqli_stmt_bind_param($q4, 'is', $assign,$email);
 mysqli_stmt_execute($q4);

//  $query5 = "SELECT * FROM training_member WHERE train_id ='$id'";
//  $q5 = mysqli_stmt_init($con);
//  mysqli_stmt_prepare($q5, $query5);
//  mysqli_stmt_execute($q5);                                            
//  $result5 = mysqli_stmt_get_result($q5); 
//  $row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC);  

$query5 = "SELECT * FROM training_member WHERE train_id= '$id'";
$result5 = mysqli_query($con, $query5);

while($row5 = mysqli_fetch_assoc($result5)){
//  $rowCount = mysqli_num_rows ( $result5 );
//  while($row5){
  $member = $row5['member'];
  echo '<script>console.log("'.$member .'"); </script>';
  $query1= "SELECT * FROM passport WHERE email ='$member'";
  $q1 = mysqli_stmt_init($con);
  mysqli_stmt_prepare($q1, $query1);
  mysqli_stmt_execute($q1);                                            
  $result2 = mysqli_stmt_get_result($q1); 
  $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);                                     
  $member1=$row2['training'];
  
   $query2 = "UPDATE passport SET training =? WHERE email =?"; 
   $assign1 = $member1+1;
   
   $q2 = mysqli_stmt_init($con);
   mysqli_stmt_prepare($q2, $query2);
   mysqli_stmt_bind_param($q2, 'is', $assign1,$member);
   mysqli_stmt_execute($q2);

 }

  echo "success"
  // pass array in json_encode  

?>