<?php
include ('helper.php');

$error = array();

$email = validate_input_email($_POST['email']);
if (empty($email)){
    $error[] = "You forgot to enter your Email";
}



$password = validate_input_text($_POST['password']);
if (empty($password)){
    $error[] = "You forgot to enter your password";
}


if(empty($error)){
    // sql query
    $query = "SELECT * FROM user WHERE email=?";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 's', $email);
    //execute query
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

   

    if (!empty($row)){
        // verify password
        if( $row['is_approved'] == '1'){

        if($password == $row['password'] && $row['type'] == 'admin' ){
            $_SESSION['email'] = $row['email'];
            header("location: homepage.php");
           
            exit();
        }
    
        else if($password == $row['password'] && $row['type'] == 'user'){
            $_SESSION['email'] = $row['email'];            
            header("location: homepage.php");
            exit();
        }
        else{
            echo '<script>alert("Incorrect username or password")</script>';
        }
    }
    else{
        echo '<script>alert("Account not yet approved")</script>';
    }
}else{
        echo '<script>alert("User not Exists: Re-directing to login page")</script>';
    }

}else{
    echo "Please Fill out email and password to login!";
}