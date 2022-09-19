<?php
require('mysqli_connect.php');
session_start();
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Business Excellence</title>

    <!-- Custom fonts for this template-->



    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/d0d48d242d.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- FullCalendar -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
body {
    background-color: #FFFFFF;
    margin: 0;
}

.navtop {
    background-color: #3f69a8;
    height: 60px;
    width: 100%;
    border: 0;
}

.navtop div {
    display: flex;
    margin: 0 auto;
    width: 1000px;
    height: 100%;
}

.navtop div h1,
.navtop div a {
    display: inline-flex;
    align-items: center;
}

.navtop div h1 {
    flex: 1;
    font-size: 24px;
    padding: 0;
    margin: 0;
    color: #ecf0f6;
    font-weight: normal;
}

.navtop div a {
    padding: 0 20px;
    text-decoration: none;
    color: #c5d2e5;
    font-weight: bold;
}

.navtop div a i {
    padding: 2px 8px 0 0;
}

.navtop div a:hover {
    color: #ecf0f6;
}

.content {
    width: 1000px;
    margin: 0 auto;
}

.content h2 {
    margin: 0;
    padding: 25px 0;
    font-size: 22px;
    border-bottom: 1px solid #ebebeb;
    color: #666666;
}

*,
*:after,
*::before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}




.cl-effect-20 a {
    line-height: 2em;
    -webkit-perspective: 800px;
    -moz-perspective: 800px;
    perspective: 800px;
}

.cl-effect-20 a span {
    position: absolute;
    top: 50%;
    left: 50%;
    display: inline-block;
    padding: 3px 16px 0;
    padding-bottom: 2px;
    background: #18A558;
    color: black;
    font-weight: 600;
    box-shadow: inset 0 3px #2f4351;
    -webkit-transition: background 0.6s;
    -moz-transition: background 0.6s;
    transition: background 0.6s;
    -webkit-transform-origin: 50% 0;
    -moz-transform-origin: 50% 0;
    transform-origin: 50% 0;
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    transform-style: preserve-3d;
    -webkit-transform-origin: 0% 50%;
    -moz-transform-origin: 0% 50%;
    transform-origin: 0% 50%;
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 16px 15px;


}

.cl-effect-20 a span::before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #FEDE00;
    color: black;
    content: attr(data-hover);
    -webkit-transform: rotateX(270deg);
    -moz-transform: rotateX(270deg);
    transform: rotateX(270deg);
    -webkit-transition: -webkit-transform 0.6s;
    -moz-transition: -moz-transform 0.6s;
    transition: transform 0.6s;
    -webkit-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    transform-origin: 0 0;
    pointer-events: none;
    padding-bottom: 0px;

}

.cl-effect-20 a:hover span,
.cl-effect-20 a:focus span {
    background: #2f4351;
}

.cl-effect-20 a:hover span::before,
.cl-effect-20 a:focus span::before {
    -webkit-transform: rotateX(10deg);
    -moz-transform: rotateX(10deg);
    transform: rotateX(10deg);
}
</style>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar"
            style="font-family: 'Nunito', sans-serif;">
            <!-- Sidebar - Brand -->

            <img src="./img/OMC LOGO-01.png" />


            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - myaccoun -->
            <li class="nav-item active">
                <a class="nav-link" href="homepage.php">
                    <i class="fa-solid fa-address-card"></i>
                    <span>My Account</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">Interface</div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-file-shield"></i>
                    <span>Safety</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Safety Components:</h6>
                        <a class="collapse-item" href="nearmiss.php">Near Miss</a>
                        <a class="collapse-item" href="unsafeA&C.php">Unsafe Act/Condition</a>
                        <a class="collapse-item" href="vfl.php">VFL</a>
                        <a class="collapse-item" href="">Special Task</a>
                        <a class="collapse-item" href="Investigation.php">Investigation</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - grievance -->
            <li class="nav-item">
                <a class="nav-link" href="grievance.php">
                    <i class="fa-solid fa-hands-praying"></i>
                    <span>Grievance</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="knowledge_sharing.php">
                    <i class="fa-solid fa-book"></i>&nbsp;
                    <span>Knowledge Sharing</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fa-solid fa-handshake"></i>
                    <span>Requests</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="business.php">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                    <span>Business Excellence</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fa-solid fa-person-circle-question"></i>
                    <span>Quiz</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">General Knowledge:</h6>
                        <a class="collapse-item" href="quizmain.php">Daily Quiz</a>
                        <a class="collapse-item" href="quizmain_safety.php">Safety Quiz</a>

                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="photohub.php">
                    <i class="fa-solid fa-camera-retro"></i>
                    <span>Photo Hub</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="input-group">
                        <h2 style="font-weight: 700 ; color: #0071c5;">Kodingamali Bauxite Mines</h2>
                    </div>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw" style="font-size: 18px;"></i>
                                <!-- Counter - Alerts -->

                                <?php
        $query = "SELECT * FROM assign_task where active =0 and email ='$email' ORDER BY date DESC LIMIT 0,5 ";
        $count = mysqli_num_rows(mysqli_query($con,$query));
        ?>
                                <span class="badge badge-danger badge-counter"
                                    style="border-radius: 50%; font-size: 13px;"><?php echo $count; ?></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Notification Center</h6>
                                <?php
          $result = mysqli_query($con, $query);                     
                                          
        if($count >0 ){
            while($rows = mysqli_fetch_assoc($result)) {?>

                                <a class="dropdown-item d-flex align-items-center"
                                    href="investigation.php?id=<?php echo $rows['incident_id'] ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">Task assigned on:
                                            &nbsp;&nbsp;<?php echo $rows['date'];  ?>
                                        </div>
                                        <span class="font-weight-bold">New Task has been assigned to you- "Incident ID:
                                            <?php echo $rows['incident_id'];   ?> "</span>
                                    </div>
                                </a>

                                <?php     }
        }
        else{


?>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger">
                                            <i class="fa-regular fa-face-frown text-white"></i>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="font-weight-bold">Sorry no notifications for you!</span>
                                    </div>

                                    <?php
        }
            ?>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="investigation.php">Show
                                    All Tasks</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow user">
                            <a class="dropdown-item logout" href="logout.php">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid ">


                    <section class="color-1">
                        <div style="text-align: center;  font-family: Nunito, sans-serif;">
                            <h3 style=" margin-bottom: 50px; margin-top: 40px; font-weight: 700; ">Welcome to Business
                                Excellence, OMC!
                            </h3>
                            <p>OMC embarked in its journey of Business Excellence by launching “Quality Circle”
                                initiative.
                                With overwhelming response from shop floor employees, subsequently it launched an
                                Employee
                                Suggestion Scheme (ESS) named “SaHbhagita” as a part of democratisation of improvement
                                initiatives where every stakeholder is given opportunity to contribute suggestions
                                towards
                                growth of the organization. Currently, we are implementing Total Quality Management
                                (TQM)
                                practices across our organisation. We have plans to roll out Knowledge Management (KM)
                                program in near future. QC teams from OMC have been winning awards at state (CCQC) &
                                national level (NCQC) Quality Circle competitions conducted by QCFI</p>
                        </div>
                        <nav class="cl-effect-20" style="font-family: Nunito, sans-serif; ">
                            <a href="https://be.omcltd.in/suggestion-management/" target="_blank"><span
                                    style="font-weight: 700;" data-hover="&emsp;SUGESSTION MANAGEMENT">SUGESSTION
                                    MANAGEMENT</span></a>
                        </nav>
                    </section>

                </div>


            </div>


        </div>






        <!-- /.container-fluid -->
        <!-- End of Main Content -->
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy;Kodingamali Bauxite Mines 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- End of Content Wrapper -->

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->

    <!-- FullCalendar -->
    <script src='js/moment.min.js'></script>
    <!-- <script src='js/fullcalendar.min.js'></script> -->
    <script src='js/fullcalendarxx.min.js'></script>
    <script src='packages/list/main.js'> </script>
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>


</body>

</html>