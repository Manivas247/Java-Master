<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>
<?php
session_start();
    require ('mysqli_connect.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require ('register-process.php');
    }
?>

<body class="bg-gradient-light">
    <div class="row">
        <div class="col-2">
            <img src="./img/OMC LOGO-01.png" class="logo" />
        </div>
    </div>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="register.php" method="POST" id="reg-form">
                                <div class=" form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Name*" required>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            name="email" placeholder="Email Address*" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                        placeholder="Phone*" required />
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="blood"
                                            name="blood" placeholder="Blood Group*" required>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="designation"
                                            name="designation" placeholder="Designation*" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password"
                                            name="password" placeholder="Password*" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="repeatpassword" id="repeatpassword" placeholder="Repeat Password*"
                                            required>
                                        <small id="confirm_error" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 doj">
                                        <span for="doj">Date of Joining*</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control form-control-user" id="doj" name="doj"
                                            placeholder="doj*" required>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-user btn-block" type="submit" name="create"> Register
                                    Account</button>
                                <hr>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
    $(document).ready(function(e) {
        $("#reg-form").submit(function(event) {
            let $password = $("#password");
            let $confirm = $("#repeatpassword");
            let $error = $("#confirm_error");
            if ($password.val() === $confirm.val()) {
                return true;
            } else {
                $error.text("Password not Match");
                event.preventDefault();
            }
        });
    });
    </script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>

</body>

</html>