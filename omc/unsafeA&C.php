<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Unsafe Act/Condition</title>

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>

</style>
<?php
session_start();

require('mysqli_connect.php');
require ('helper.php');

$msg ="";

 if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $query1 = "SELECT * FROM user WHERE email=? ";
                        $q1 = mysqli_stmt_init($con);
                        mysqli_stmt_prepare($q1, $query1);
                    
                        // bind parameter
                        mysqli_stmt_bind_param($q1, 's', $email);
                        //execute query
                        mysqli_stmt_execute($q1);
                    
                        $result1 = mysqli_stmt_get_result($q1);
                    
                        $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

 }

 

if(isset($_POST['submit'])){

$mines = validate_input_text($_POST['mines']);
$person = validate_input_text($_POST['person']);
$designation = validate_input_text($_POST['designation']);
$date = validate_input_text($_POST['date']);
$time = validate_input_text($_POST['time']);
$shift = validate_input_text($_POST['shift']);
$category = validate_input_text($_POST['uac']);
$location = validate_input_text($_POST['location']);
$shift_ic = validate_input_text($_POST['shift_ic']);
$action= validate_input_text($_POST['action']);
$clean = clean($_POST['details']);
$details= validate_input_text($clean );
$clean1 = clean($_POST['yes_details']);
$yes_details= validate_input_text($clean1);
if (empty($yes_details)){
    $yes_details = "Null";
}
$clean2 = clean($_POST['no_details']);
$no_details= validate_input_text($clean2);
if (empty($no_details)){
    $no_details = "Null";
}


    // make a query
    $query = "INSERT INTO uac (mines,name,designation,date,time, shift, category,shift_ic,location,detail,action,yes_detail,no_detail)";
    $query .= "VALUES(?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?)";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'sssssssssssss', $mines,$person, $designation,$date,$time,$shift,$category,$shift_ic,$location,$details,$action,$yes_details,$no_details);

    // execute statement
    mysqli_stmt_execute($q);

    if( $mines!='' && $person!='' && $designation !='' && $date != '' & $time !='' && $shift !='' && $category !='' && $shift_ic !='' && $location !='' && $details !='' && $action !='' && $yes_details !='' && $no_details !=''){

        $_POST['mines'] = '';
        $_POST['person'] = '';
        $_POST['designation'] = '';
        $_POST['date']='';
        $_POST['time']='';
        $_POST['shift']='';
        $_POST['uac']='';
        $_POST['location']='';
        $_POST['shift_ic']='';
        $_POST['action']='';
        $_POST['details']='';
        $_POST['yes_details']='';
        $_POST['no_details']='';
        $msg = 'Report uploaded successfully!';
        // header("Location: unsafeA&C.php");

    }else{
        $msg = 'Error while submitting report...!!';
        }

        $query = "SELECT * FROM uac ORDER BY id DESC LIMIT 1;";
                                                $q = mysqli_stmt_init($con);
                                                mysqli_stmt_prepare($q, $query);
                                                mysqli_stmt_execute($q);                                            
                                                $result = mysqli_stmt_get_result($q); 
                                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);                                     
                                                $uac_id=$row['id'];

    $rowCount = count($_POST['name']);
    // Note that this assumes all the variables will correctly be submitted as arrays of the same length. For completeness and robustness you could add a !empty check for each value.
    for ($i = 0; $i < $rowCount; $i++) {
        $name = validate_input_text($_POST['name'][$i]);
        $employee = validate_input_text($_POST['employee'][$i]);
        $department = validate_input_text($_POST['department'][$i]);
        $organization = validate_input_text($_POST['organization'][$i]);

        $query = "INSERT INTO uac_person_detail (uac_id,name,employee_no,department,organization)";
        $query .= "VALUES(?, ?, ?, ?,?)";   
        $q = mysqli_stmt_init($con);   
        mysqli_stmt_prepare($q, $query);    
        mysqli_stmt_bind_param($q, 'issss', $uac_id,$name, $employee,$department,$organization);
        mysqli_stmt_execute($q);

        if( $uac_id!='' && $name!='' && $name !='' && $employee != '' & $department !='' && $organization !='' ){

        $msg = 'Report uploaded successfully!';


    }else{
        $msg = 'Error while submitting report...!!';
        goto end;

    }
    }
}
end:

?>
<style>
.main-section {
    padding: 15px;
    background: #f1f1f1;
}

.group::after,
.tabBlock-tabs::after {
    clear: both;
    content: "";
    display: table;
}

*,
::before,
::after {
    box-sizing: border-box;
}


.unstyledList,
.tabBlock-tabs {
    list-style: none;
    margin: 0;
    padding: 0;
}

.tabBlock {
    margin: 0 0 2.5rem;
}

.tabBlock-tab {
    background-color: #fff;
    border-color: #d8d8d8;
    border-left-style: solid;
    border-top: solid;
    border-width: 2px;
    color: #b5a8c5;
    cursor: pointer;
    display: inline-block;
    font-weight: 600;
    float: left;
    padding: 0.625rem 1.25rem;
    position: relative;
    -webkit-transition: 0.1s ease-in-out;
    transition: 0.1s ease-in-out;
}

.tabBlock-tab:last-of-type {
    border-right-style: solid;
}

.tabBlock-tab::before,
.tabBlock-tab::after {
    content: "";
    display: block;
    height: 4px;
    position: absolute;
    -webkit-transition: 0.1s ease-in-out;
    transition: 0.1s ease-in-out;
}

.tabBlock-tab::before {
    background-color: #b5a8c5;
    left: -2px;
    right: -2px;
    top: -2px;
}

.tabBlock-tab::after {
    background-color: transparent;
    bottom: -2px;
    left: 0;
    right: 0;
}


.tabBlock-tab.is-active {
    position: relative;
    color: #975997;
    z-index: 1;
}

.tabBlock-tab.is-active::before {
    background-color: #975997;
}

.tabBlock-tab.is-active::after {
    background-color: #fff;
}

.tabBlock-content {
    background-color: #fff;
    border: 2px solid #d8d8d8;
    padding: 1.25rem;
}

.tabBlock-pane> :last-child {
    margin-bottom: 0;
}
</style>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
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

                    </div>
                </div>
            </li>

            <!-- Nav Item - grievance -->
            <li class="nav-item">
                <a class="nav-link" href="">
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
                <a class="nav-link" href="">
                    <i class="fa-solid fa-envelope-circle-check"></i>
                    <span>Suggestion</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="quizmain.php">
                    <i class="fa-solid fa-person-circle-question"></i>
                    <span>Daily Quiz</span></a>
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
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Alerts Center</h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for
                                        your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
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
                    <figure class="tabBlock">
                        <ul class="tabBlock-tabs">
                            <li class="tabBlock-tab is-active">New Record</li>
                            <li class="tabBlock-tab">Submitted Record</li>
                        </ul>
                        <div class="tabBlock-content">

                            <div class="tabBlock-pane">

                                <div class="container">
                                    <div class="row">
                                        <div class="offset-lg-1 col-lg-10 col-sm-8 col-8 border rounded main-section">
                                            <h3 class="text-center text-inverse">Unsafe ACT/CONDITION Report</h3>
                                            <hr>
                                            <p><?= $msg?></p>
                                            <form class="container" action="unsafeA&C.php" method="post"
                                                enctype="multipart/form-data" id="unsafea&c">
                                                <div class=" row">
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Near Miss No">Name of
                                                                Mines</label>
                                                            <input type="text" class="form-control" id="mines"
                                                                name="mines" placeholder="Name of Mines"
                                                                value="Kodingamali Bauxite Mines" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Incident ID">Incident
                                                                ID</label>
                                                            <?php
                                                $query = "SELECT * FROM uac ";
                                                $q = mysqli_stmt_init($con);
                                                mysqli_stmt_prepare($q, $query);
                                                mysqli_stmt_execute($q);                                            
                                                $result = mysqli_stmt_get_result($q); 
                                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);                                        
                                                $number= mysqli_num_rows($result); 
                                                $next=$number+1;                      
                                                ?>
                                                            <input type="text" class="form-control" id="number"
                                                                name="number" value="<?php echo $next ?>" required
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Person reported">Person
                                                                reported*</label>
                                                            <input type="text" class="form-control" id="person"
                                                                name="person" style="text-transform:capitalize ;"
                                                                value="<?=$row1['name']?>" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="Designation">Designation*</label>
                                                            <input type="text" class="form-control" id="designation"
                                                                style="text-transform:capitalize ;"
                                                                value="<?=$row1['designation']?>" name="designation"
                                                                required readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Date">Date*</label>
                                                            <input type="date" class="form-control" id="date"
                                                                name="date" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="time">Time*</label>
                                                            <input type="time" class="form-control" id="time"
                                                                name="time" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Shift">Shift*</label>
                                                            <select class="custom-select d-block form-control"
                                                                id="shift" name="shift" required>
                                                                <option value="">Select Shift</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="Unsafe Act/Condition">Unsafe
                                                                Act/Condition*</label>
                                                            <select class="custom-select d-block form-control" id="uac"
                                                                name="uac" required>
                                                                <option value="">Select category</option>
                                                                <option value="Unsafe Act">Unsafe Act</option>
                                                                <option value="UnSafe Condition">UnSafe Condition
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label class="text-inverse" for="Shift Inchargeo">Shift
                                                                    Incharge*</label>
                                                                <input type="text" class="form-control" id="shift_ic"
                                                                    name="shift_ic" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="Location of Incident">Location of
                                                                Incident*</label>
                                                            <select class="custom-select d-block form-control"
                                                                id="location" name="location" required>
                                                                <option value="">Select Location</option>
                                                                <option value="Mines">Mines</option>
                                                                <option value="Workshop">Workshop</option>
                                                                <option value="Stackyard">Stackyard</option>
                                                                <option value="Transporting">Transporting</option>
                                                                <option value="Security">Security</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for=" Details of the Event">
                                                                Details of the Event*</label>
                                                            <textarea name="details" id="details" cols="30" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for=Weather corrective action
                                                                taken or not?">Weather
                                                                corrective action taken or not?</label>
                                                            <label for="yes">
                                                                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                                                &emsp;YES</label>
                                                            <input type="radio" name="action" required value="yes"
                                                                required>
                                                            <label for="no">&emsp;NO</label>
                                                            <input type="radio" name="action" required value="no"
                                                                required>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="If yes! Please specify ">
                                                                If Yes! Please specify the reason </label>
                                                            <textarea name="yes_details" id="yes_details" cols="30"
                                                                rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="If No! Please specify the reason  ">
                                                                If No! Please specify the reason </label>
                                                            <textarea name="no_details" id="no_details" cols="30"
                                                                rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="text-inverse"
                                                            for="Details of the person involved in UA">
                                                            Details of the person involved in UA/UC </label>
                                                        <table class="table table-bordered table-hover" id="tab_logic">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        Name
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Employee NO
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Department
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Organization
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr id='addr0'>
                                                                    <td>
                                                                        <input type="text" name='name[]'
                                                                            class="form-control" required />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name='employee[]'
                                                                            class="form-control" required />
                                                                    </td>
                                                                    <td>
                                                                        <select
                                                                            class="custom-select d-block form-control"
                                                                            id="department" name="department[]"
                                                                            required>
                                                                            <option value="">Select department</option>
                                                                            <option value="MECH">MECH</option>
                                                                            <option value="MINE">MINE</option>
                                                                            <option value="CIVIL">CIVIL</option>
                                                                            <option value="SECURITY">SECURITY</option>
                                                                            <option value="ELECTRICAL">ELECTRICAL
                                                                            </option>
                                                                            <option value="OTHERS">OTHERS</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select
                                                                            class="custom-select d-block form-control"
                                                                            id="organization" name="organization[]"
                                                                            required>
                                                                            <option value="">Select organization
                                                                            </option>
                                                                            <option value="Mines">OMC</option>
                                                                            <option value="Workshop">MYTHIRI</option>
                                                                            <option value="Stackyard">G4S</option>
                                                                            <option value="Transporting">SUPCO</option>
                                                                            <option value="Others">OTHERS</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr id='addr1'></tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <button id="add_row" class="btn btn-default pull-left" type="button"
                                                        style="font-size:30px ; margin-left: 800px;"><i
                                                            class="fa-sharp fa-solid fa-circle-plus"></i></button>

                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-12 col-sm-12 col-12 text-center">
                                                        <button class="btn btn-info" type="submit" name="submit">Submit
                                                            report</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabBlock-pane">
                            </div>
                        </div>
                    </figure>


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
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child');
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });

        });
        </script>
        <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        </script>
        <script>
        var TabBlock = {
            s: {
                animLen: 200
            },

            init: function() {
                TabBlock.bindUIActions();
                TabBlock.hideInactive();
            },

            bindUIActions: function() {
                $('.tabBlock-tabs').on('click', '.tabBlock-tab', function() {
                    TabBlock.switchTab($(this));
                });
            },

            hideInactive: function() {
                var $tabBlocks = $('.tabBlock');

                $tabBlocks.each(function(i) {
                    var
                        $tabBlock = $($tabBlocks[i]),
                        $panes = $tabBlock.find('.tabBlock-pane'),
                        $activeTab = $tabBlock.find('.tabBlock-tab.is-active');

                    $panes.hide();
                    $($panes[$activeTab.index()]).show();
                });
            },

            switchTab: function($tab) {
                var $context = $tab.closest('.tabBlock');

                if (!$tab.hasClass('is-active')) {
                    $tab.siblings().removeClass('is-active');
                    $tab.addClass('is-active');

                    TabBlock.showPane($tab.index(), $context);
                }
            },

            showPane: function(i, $context) {
                var $panes = $context.find('.tabBlock-pane');

                // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
                $panes.slideUp(TabBlock.s.animLen);
                $($panes[i]).slideDown(TabBlock.s.animLen);
            }
        };

        $(function() {
            TabBlock.init();
        });
        </script>
</body>

</html>