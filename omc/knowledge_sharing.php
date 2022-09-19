<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>knowledge_sharing</title>

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
<?php
require('mysqli_connect.php');
session_start();
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
?>
<style>
*,
*:after,
*::before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}



nav a {
    position: relative;
    display: inline-block;
    margin: 10px 15px;
    outline: none;
    color: black;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 400;
    text-shadow: 0 0 1px rgba(255, 255, 255, 0.3);
    font-size: 14px;
}

nav a:hover,
nav a:focus {
    outline: none;
}

/* Effect 1: Brackets */
.cl-effect-1 a::before,
.cl-effect-1 a::after {
    display: inline-block;
    opacity: 0;
    -webkit-transition: -webkit-transform 0.3s, opacity 0.2s;
    -moz-transition: -moz-transform 0.3s, opacity 0.2s;
    transition: transform 0.3s, opacity 0.2s;
}

.cl-effect-1 a::before {
    margin-right: 10px;
    content: '[';
    -webkit-transform: translateX(20px);
    -moz-transform: translateX(20px);
    transform: translateX(20px);
}

.cl-effect-1 a::after {
    margin-left: 10px;
    content: ']';
    -webkit-transform: translateX(-20px);
    -moz-transform: translateX(-20px);
    transform: translateX(-20px);
}

.cl-effect-1 a:hover::before,
.cl-effect-1 a:hover::after,
.cl-effect-1 a:focus::before,
.cl-effect-1 a:focus::after {
    opacity: 1;
    -webkit-transform: translateX(0px);
    -moz-transform: translateX(0px);
    transform: translateX(0px);
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
                        <a class="collapse-item" href="investigation.php">Investigation</a>

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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw" style="font-size: 18px; margin-right: -13px;"></i>
                                <!-- Counter - Alerts -->

                                <?php
        $query = "SELECT * FROM assign_task where active =0 and email ='$email' ORDER BY date DESC LIMIT 0,5 ";
        $count = mysqli_num_rows(mysqli_query($con,$query));
        ?>
                                <span class="badge badge-danger badge-counter"
                                    style="border-radius: 50%; font-size: 13px; margin-right: -13px;"><?php echo $count; ?></span>
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
                                <a class="dropdown-item d-flex align-items-center" style=" text-transform: none;
                                    font-size: 13px; margin-left: 0px; letter-spacing: 0px;" href="#">
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
                                <a class="dropdown-item text-center small text-gray-500" href="investigation.php" style="text-transform: none;
                                    font-size: 11px; margin-left: 0px; ">Show
                                    All Tasks</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block" style="margin-right: 2px;"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow user">

                            <a class="dropdown-item logout" href="logout.php"
                                style="text-transform: none; font-size: 16px; margin-top: 30px; letter-spacing: 0px;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid ">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Resources</h1>
                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <select class="browser-default custom-select" id="selectbox">
                                    <option value="">Select Category</option>
                                    <option value="SOP">SOP</option>
                                    <option value="COP">COP</option>
                                    <option value="Policies">Policies</option>
                                    <option value="Do's & Dont's">Do's & Dont's</option>
                                    <option value="Training Material">Training Material</option>
                                </select>

                            </div>
                            <div class="col-md-4">

                                <button class="btn btn-primary" id="btn">Submit</button>
                            </div>

                        </div>
                    </div>
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Resource-SOP</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="height: 60vh; overflow-y: auto;">
                                    <section class="color-1">
                                        <nav class="cl-effect-1" style="margin-left: -20px;">
                                            <ul>
                                                <a href="sop\_Arc welding.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Arc
                                                    welding</a>
                                                <a href="sop\_DG Set Operating Procedure.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;DG Set Operating
                                                    Procedure</a>
                                                <a href="sop\_Gas Cylinder Handling Protocols.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Gas Cylinder
                                                    Handling
                                                    Protocols</a>
                                                <a href="sop\_Mine bench _Haul road.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;Mine bench _Haul road</a>
                                                <a href="sop\_mine Excavation operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;Mine Excavation
                                                    operation</a>
                                                <a href="sop\_Mythri Workshop Protocol.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Mythri Workshop
                                                    Protocol</a>
                                                <a href="sop\_SOP for Diesel Tanker Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Diesel Tanker
                                                    Operation</a>
                                                <a href="sop\_SOP for Dozer Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Dozer
                                                    Operation</a>
                                                <a href="sop\_SOP for DRILLING AND BLASTING Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;DRILLING AND BLASTING
                                                    Operation</a>
                                                <a href="sop\_SOP FOR DUMPER OPERATION.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP FOR DUMPER
                                                    OPERATION</a>
                                                <a href="sop\_SOP for Earth Resistsnce.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Earth
                                                    Resistsnce</a>
                                                <a href="sop\_SOP for Excavator Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Excavator
                                                    Operation</a>

                                                <a href="sop\_SOP for Fixed Crusher Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Fixed
                                                    Crusher Operation</a>
                                                <a href="sop\_SOP FOR GRADER.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP FOR GRADER</a>
                                                <a href="sop\_SOP for High mast installation system.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for
                                                    High
                                                    mast installation system</a>
                                                <a href="sop\_SOP for HT Panel Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for HT Panel
                                                    Operation</a>
                                                <a href="sop\_SOP for Hydra Operation -.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Hydra
                                                    Operation</a>
                                                <a href="sop\_SOP for L M V Camper Operation -.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for L M V
                                                    Camper
                                                    Operation</a>
                                                <a href="sop\_SOP for Loader Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Loader
                                                    Operation</a>
                                                <a href="sop\_SOP for LT Panel Operation (2).doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for LT Panel
                                                    Operation (2)</a>
                                                <a href="sop\_SOP for PLC Handling Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for PLC
                                                    Handling Operation</a>
                                                <a href="sop\_SOP FOR TRUCK.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP FOR TRUCK</a>
                                                <a href="sop\_SOP for Water Tanker Operation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Water
                                                    Tanker Operation</a>
                                                <a href="sop\_sop gas cutting.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP gas cutting</a>
                                                <a href="sop\2a. SOP Working at Height.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP Working at
                                                    Height</a>
                                                <a href="sop\3a SOP for LOTO_DISTRIBUTED.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for
                                                    LOTO_DISTRIBUTED</a>
                                                <a href="sop\4a. SOP for Electrical Safety_DISTRIBUTED.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Electrical
                                                    Safety DISTRIBUTED</a>
                                                <a href="sop\9a. SOP for On-site Repair of HEMM_DISTRIBUTED.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;On-site
                                                    Repair of HEMM_DISTRIBUTED</a>
                                                <a href="sop\10a.SOP for Dumping of OB and Stacking of Ore.docxc"><i
                                                        class="fa-solid fa-file"></i>&ensp;Dumping
                                                    of OB and Stacking of Ore</a>
                                                <a
                                                    href="sop\15. SOP for movement of Trailer in mine premises with over-sized loads.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Movement
                                                    of Trailer with heavy
                                                    load</a>
                                                <a href="sop\Bush Fitting and Removal.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Bush Fitting and
                                                    Removal</a>

                                                <a href="sop\Crusher Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Crusher Operation</a>
                                                <a href="sop\Dumper Operator Transportation.doc"><i
                                                        class="fa-solid fa-file"></i>&ensp;Dumper Operator
                                                    Transportation</a>
                                                <a href="sop\Electrical Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Electrical Operation</a>
                                                <a href="sop\Excavtor Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Excavtor Operation</a>
                                                <a href="sop\Explosive and Blast Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Explosive and Blast
                                                    Operation</a>
                                                <a href="sop\Grinding and Drilling Preparation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Grinding and
                                                    Drilling Preparation</a>
                                                <a href="sop\Loader Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Loader Operation</a>
                                                <a href="sop\Plant Transporting Preparation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Plant Transporting
                                                    Preparation</a>
                                                <a href="sop\SOP for Ambulance Operation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for Ambulance
                                                    Operation</a>
                                                <a href="sop\Sop for Ambulance.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Sop for Ambulance</a>
                                                <a href="sop\Sop for Bio medical wastye management.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Sop for Bio
                                                    medical waste management</a>
                                                <a href="sop\SOP for BIO waste management.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for BIO waste
                                                    management</a>
                                                <a href="sop\Sop for First  aid treatment.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Sop for First aid
                                                    treatment</a>
                                                <a href="sop\SOP for First Aid Center.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;SOP for First Aid
                                                    Center</a>
                                                <a href="sop\SOP for LMV.docx"><i class="fa-solid fa-file"></i>&ensp;SOP
                                                    for LMV&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</a>
                                                <a href="sop\SOP Mythri Store.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Mythri
                                                    Store&emsp;&emsp;&emsp;&emsp;</a>
                                                <a href="sop\Tipper Dispatch By Road.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Tipper Dispatch By
                                                    Road</a>
                                                <a href="sop\Tools and Material Handling.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Tools and Material
                                                    Handling</a>

                                                <a href="sop\Use of Hydra Crane.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Use of Hydra Crane</a>
                                                <a href="sop\Welding and Cutting Preparation.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Welding and
                                                    Cutting Preparation</a>

                                            </ul>
                                        </nav>
                                    </section>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Resource-COP</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <section class="color-1">
                                        <nav class="cl-effect-1" style="margin-left: -20px;">
                                            <ul>

                                                <a href="cop\COP.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;COP</a>

                                            </ul>
                                        </nav>
                                    </section>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal2" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Resource-Policies</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2><a href="">Link1</a></h2>
                                    <h2><a href="">Link2</a></h2>
                                    <h2><a href="">Link3</a></h2>
                                    <h2><a href="">Link4</a></h2>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal3" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Resource-Do's & Dont's</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="height: 60vh; overflow-y: auto;">
                                    <section class="color-1">
                                        <nav class="cl-effect-1" style="margin-left: -20px;">
                                            <ul>
                                                <a href="dos&dont\Blasting.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Blasting&ensp;&emsp;&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;&ensp;</a>
                                                <a href="dos&dont\COmpressor.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Compressor&ensp;&ensp;&ensp;&ensp;</a>
                                                <a href="dos&dont\Conveyor.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Conveyor&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;</a>
                                                <a href="dos&dont\Crusher.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Crusher&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;&emsp;</a>
                                                <a href="dos&dont\DG Set.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;DG
                                                    Set&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;&emsp;&emsp;&emsp;</a>
                                                <a href="dos&dont\Dozer.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Dozer&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;&emsp;</a>
                                                <a href="dos&dont\Drilling Machine.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Drilling
                                                    Machine&ensp;&ensp;&ensp;&ensp;</a>
                                                <a href="dos&dont\Dumper Operator.docx"><i
                                                        class="fa-solid fa-file"></i>&ensp;Dumper
                                                    Operator&ensp;&ensp;&ensp;&ensp;</a>
                                                <a href="dos&dont\Dumper.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Dumper&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;</a>
                                                <a href="dos&dont\Excavator.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Excavator&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;&emsp;&emsp;</a>
                                                <a href="dos&dont\Explosives.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Explosives&ensp;&ensp;&ensp;&ensp;</a>
                                                <a href="dos&dont\Formation Spoil Banks.pdf" target="_blank"><i
                                                        class="fa-solid fa-file" target="_blank"></i>&ensp;Formation
                                                    Spoil
                                                    Banks&ensp;&ensp;&ensp;&ensp;</a>

                                                <a href="dos&dont\Grader.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Grader&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&emsp;&emsp;</a>
                                                <a href="dos&dont\OHP.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;OHP&ensp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&ensp;&ensp;&emsp;&emsp;&emsp;&emsp;</a>
                                                <a href="dos&dont\Pay Loader.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Pay
                                                    Loader&ensp;&ensp;&ensp;&ensp;</a>
                                                <a href="dos&dont\Welding Machine.pdf" target="_blank"><i
                                                        class="fa-solid fa-file"></i>&ensp;Welding
                                                    Machine&ensp;&ensp;&ensp;&ensp;</a>

                                            </ul>
                                        </nav>
                                    </section>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal4" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Resource-Training Material</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2><a href="">Link1</a></h2>
                                    <h2><a href="">Link2</a></h2>
                                    <h2><a href="">Link3</a></h2>
                                    <h2><a href="">Link4</a></h2>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>






            <!-- /.container-fluid -->
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;Kodingamali Bauxite Mines 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>


    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
    <script>
    var modal = document.getElementById("modal");

    // Get the button that opens the modal
    var btn = document.getElementById("btn");

    btn.onclick = function() {
        var e = document.getElementById("selectbox");
        var value = e.value;
        var text = e.options[e.selectedIndex].text;
        if (text == "SOP") {
            $("#modal").modal();
        }
        if (text == "COP") {
            $("#modal1").modal();
        }
        if (text == "Policies") {
            $("#modal2").modal();
        }
        if (text == "Do's & Dont's") {
            $("#modal3").modal();
        }
        if (text == "Training Material") {
            $("#modal4").modal();
        }
    }
    </script>
</body>

</html>