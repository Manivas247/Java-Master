<?php

require ('helper.php');


$error = array();


$name = validate_input_text($_POST['name']);
if (empty($name)){
    $error[] = "You forgot to enter your name";
}
$email = validate_input_email($_POST['email']);
if (empty($email)){
    $error[] = "You forgot to enter your email";
}

$id = validate_input_text($_POST['id']);
if (empty($id)){
    $error[] = "You forgot to enter your id";
}
$department = validate_input_text($_POST['department']);
if (empty($department)){
    $error[] = "You forgot to enter your department";
}
$blood = validate_input_text($_POST['blood']);
if (empty($blood)){
    $error[] = "You forgot to enter your blood group";
}

$designation = validate_input_text($_POST['designation']);
if (empty($designation)){
    $error[] = "You forgot to enter your designation";
}

$phone = validate_input_text($_POST['phone']);
if (empty($phone)){
    $error[] = "You forgot to enter your Phone number";
}


$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "You forgot to enter your password";
}

$confirm_pwd = validate_input_text($_POST['repeatpassword']);
if (empty($confirm_pwd)){
    $error[] = "You forgot to enter your Confirm Password";
}

$doj= validate_input_text($_POST['doj']);
if (empty($doj)){
    $error[] = "You forgot to enter your DOJ";
}



if(isset($_POST['create']) && empty($error)){
  

    $u = "SELECT * FROM user WHERE email = '$email'";
    $uu = mysqli_query($con, $u);
    if(mysqli_num_rows($uu)>0){
        echo '<script>alert("Email Already Exisited")</script>';
        $_POST['email']='';
    }
    else{
    // make a query
    $query = "INSERT INTO user (name,employee_id,email,department,phone,blood,designation, password, doj,type)";
    $query .= "VALUES(?, ?, ?, ?, ?, ?,?,?,?,?)";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    $user_type='user';

    // bind values
    mysqli_stmt_bind_param($q, 'ssssssssss', $name,$id,$email,$department, $phone,$blood,$designation,$password,$doj,$user_type);

    // execute statement
    mysqli_stmt_execute($q);

    if( $name!='' && $email!='' && $phone !='' && $blood != '' & $designation !='' && $password !='' && $doj !=''  && $id !='' && $department !=''){

    

        $_POST['name'] = '';
        $_POST['email'] = '';
        $_POST['blood'] = '';
        $_POST['phone']='';
        $_POST['designation']='';
        $_POST['password']='';
        $_POST['repeatpassword']='';
        $_POST['doj']='';
        $_POST['id']='';
        $_POST['department']='';
        echo '<script>alert("User Registered Successfully")</script>';

    }else{
        print "Error while registration...!";
    }
}
end:
}

if(isset($_POST['update']) && empty($error)){

    $u = "SELECT email FROM vendor_register WHERE email = '$email'";
    $uu = mysqli_query($con, $u);
    if(mysqli_num_rows($uu)==0){
        echo '<script>alert("User Not Found")</script>';
        $_POST['email']='';
    }
    else{
    $query = "UPDATE vendor_register SET vendor_id=?, vendor_name = ?, vendor_company = ?, email =?,phone=? ,password=? WHERE vendor_id=?";               

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'sssssss', $vendor_id, $vendor_name, $vendor_company, $email, $phone , $password, $vendor_id);

    // execute statement
    mysqli_stmt_execute($q);
    if($vendor_id && $vendor_name && $vendor_company && $email && $phone && $password){
        echo '<script>alert("Vendor Updated Successfully")</script>';
        $_POST['vendor_id'] = '';
        $_POST['vendor_company'] = '';
        $_POST['vendor_name'] = '';
        $_POST['email']='';
        $_POST['phone']='';

    }
    else{
        print "Error while registration...!";
    }
}
}

if(isset($_POST['deletedata'])){
    require('mysqli_connect.php');

    $id = $_POST['delete_id'];
    $query = "DELETE FROM vendor_register WHERE vendor_id=?";               

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 's', $id);


    // execute statement
    $query_run = mysqli_stmt_execute($q);

    if($query_run){
        echo '<script>alert("Data Deleted Successfully")</script>';
        header("Location: vendor_register.php");
    }
    else{
        echo '<script>alert("Data not Deleted")</script>';
    }

}