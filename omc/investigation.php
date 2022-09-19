<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Investigation</title>

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
session_start();

require('mysqli_connect.php');
require ('helper.php');

$msg ="";

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = "UPDATE assign_task SET active=? WHERE incident_id =?"; 
    $assign = 1;
     $q = mysqli_stmt_init($con);
     mysqli_stmt_prepare($q, $query);
     mysqli_stmt_bind_param($q, 'ii', $assign,$id);
     mysqli_stmt_execute($q);
}

 if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $query = "SELECT * FROM user WHERE email=? ";
                        $q = mysqli_stmt_init($con);
                        mysqli_stmt_prepare($q, $query);
                    
                        // bind parameter
                        mysqli_stmt_bind_param($q, 's', $email);
                        //execute query
                        mysqli_stmt_execute($q);
                    
                        $result = mysqli_stmt_get_result($q);
                    
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

 }

 

if(isset($_POST['submit'])){

    $mines = validate_input_text($_POST['mines']);
    $site = validate_input_text($_POST['site']);
    $incident_id = validate_input_text($_POST['id']);
    $clean = clean($_POST['details']);
    $details= validate_input_text($clean );
    $clean1 = clean($_POST['person']);
    $person= validate_input_text($clean1);
    $clean2 = clean($_POST['consequence']);
    $consequence= validate_input_text($clean2);
    $visit_date = validate_input_text($_POST['visit_date']);
    $person_talked = validate_input_text($_POST['person_talked']);
    $collection_date = validate_input_text($_POST['collection_date']);
    $finalize_date = validate_input_text($_POST['finalize_date']);
    $clean3 = clean($_POST['action']);
    $action= validate_input_text($clean3);
    $clean4 = clean($_POST['finding']);
    $finding= validate_input_text($clean4);
    $clean5 = clean($_POST['contributory']);
    $contributory= validate_input_text($clean5);
    $clean6 = clean($_POST['root']);
    $root= validate_input_text($clean6 );


   
    

    // make a query
    $query = "INSERT INTO nearmiss_investigation (mines,site,nearmiss_id,details,person, consequences, visit_date,person_witness,collection_date,conferred_date,action,findings,contributory,root,email)";
    $query .= "VALUES(?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?)";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    $assign = 0;
    // bind values
    mysqli_stmt_bind_param($q, 'ssissssssssssss', $mines,$site, $incident_id,$details,$person,$consequence,$visit_date,$person_talked,$collection_date,$finalize_date,$action,$finding,$contributory,$root,$email);

    // execute statement
    mysqli_stmt_execute($q);

    if( $mines!='' && $site!='' && $incident_id !='' && $details != '' & $person !='' && $consequence !='' && $visit_date !='' && $person_talked !='' && $collection_date !='' && $finalize_date !='' && $action !='' && $finding !=''&& $contributory !=''&& $root !=''){

        $_POST['mines'] = '';
        $_POST['id'] = '';
        $_POST['site'] = '';
        $_POST['details']='';
        $_POST['person']='';
        $_POST['consequence']='';
        $_POST['visit_date']='';
        $_POST['person_talked']='';
        $_POST['collection_date']='';
        $_POST['finalize_date']='';
        $_POST['action']='';
        $_POST['finding']='';
        $_POST['contributory']='';
        $_POST['root']='';

        $msg = 'Report uploaded successfully!';

    }else{
        $msg = 'Error while submitting report...!!';
        goto end;
    
    } 

    $query = "SELECT * FROM nearmiss_investigation ORDER BY id DESC LIMIT 1;";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);
    mysqli_stmt_execute($q);                                            
    $result = mysqli_stmt_get_result($q); 
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  {                                   
    $incident_id=$row['id'];
    $nearmiss_id=$row['nearmiss_id'];
    }
    $rowCount = count($_POST['name']);
    for ($i = 0; $i < $rowCount; $i++) {

        $name = validate_input_text($_POST['name'][$i]);
        $designation = validate_input_text($_POST['designation'][$i]); 

        $query = "INSERT INTO nearmiss_investigationteam (investigation_id,name,designation)";
        $query .= "VALUES(?, ?, ?)";   
        $q = mysqli_stmt_init($con);   
        mysqli_stmt_prepare($q, $query);    
        mysqli_stmt_bind_param($q, 'iss', $incident_id,$name, $designation);
        mysqli_stmt_execute($q);

        if( $name!='' && $designation!='' ){
     

        $msg = 'Report uploaded successfully!';


    }else{
        $msg = 'Error while submitting report...!!';
        goto end;

    }
    }
    $rowCount1 = count($_POST['action_to']);
    for ($i = 0; $i < $rowCount1; $i++) {

        $clean = clean($_POST['action_to'][$i]);
        $action_to = validate_input_text($clean);
        $priority = validate_input_text($_POST['priority'][$i]);
        $responsibility = validate_input_text($_POST['responsibility'][$i]); 
        $timeline = validate_input_text($_POST['timeline'][$i]); 

        $query = "INSERT INTO nearmiss_investigationcorrective (incident_id,action,priority,responsibility,timeline)";
        $query .= "VALUES(?, ?, ?,?,?)";   
        $q = mysqli_stmt_init($con);   
        mysqli_stmt_prepare($q, $query);    
        mysqli_stmt_bind_param($q, 'issss', $incident_id,$action_to, $priority,$responsibility, $timeline);
        mysqli_stmt_execute($q);

        if( $action_to!='' && $priority!=''&& $responsibility!=''&& $timeline!='' ){
            $query = "UPDATE assign_task SET status=? WHERE incident_id =?"; 
            $assign = "Completed";
             $q = mysqli_stmt_init($con);
             mysqli_stmt_prepare($q, $query);
             mysqli_stmt_bind_param($q, 'si', $assign,$nearmiss_id);
             mysqli_stmt_execute($q);

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

#myImg:hover {
    opacity: 0.7;
}

/* The Modal (background) */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.9);
    /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content,
#caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {
        -webkit-transform: scale(0)
    }

    to {
        -webkit-transform: scale(1)
    }
}

@keyframes zoom {
    from {
        transform: scale(0)
    }

    to {
        transform: scale(1)
    }
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
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
                    <figure class="tabBlock">
                        <ul class="tabBlock-tabs">
                            <li class="tabBlock-tab is-active">Task Details</li>
                            <li class="tabBlock-tab">New Investigation</li>
                            <li class="tabBlock-tab">Investigation Record</li>
                        </ul>
                        <div class="tabBlock-content">

                            <div class="tabBlock-pane">
                                <div class=" d-flex table-data"
                                    style="height: 560px;overflow: scroll; flex-basis: 40%;  margin: 1em 0em; margin-left: 10px;">
                                    <table class="table table-bordered">
                                        <thead style="text-align: center; justify-items: center;">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Mine</th>
                                                <th scope="col">Date of incident*</th>
                                                <th scope="col">Date incident was reported*</th>
                                                <th scope="col">Incident Reported By</th>
                                                <th scope="col">Location of Incident</th>
                                                <th scope="col">Equipment(s) involved </th>
                                                <th scope="col">Person(s) involved</th>
                                                <th scope="col">Incident Description</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Task Assigned on</th>
                                                <th scope="col">Status</th>


                                            </tr>
                                        </thead>
                                        <tbody id="tbody3" style="text-align: center;">
                                            <?php

           
            $query = "SELECT * FROM assign_task WHERE email= '$email'";
            $result = mysqli_query($con, $query);

            while($rows = mysqli_fetch_assoc($result))
            {?>

                                            <tr>
                                                <td><?php echo $rows['incident_id'];?></td>
                                                <td><?php echo $rows['mine'];?>
                                                </td>
                                                <td><?php echo $rows['date_incident'];?></td>
                                                <td>
                                                    <?php echo $rows['date_report'];?></td>
                                                <td><?php echo $rows['reported_by'];?></td>
                                                <td><?php echo $rows['location'];?></td>
                                                <td><?php echo $rows['equipment'];?></td>
                                                <td><?php echo $rows['person_involved'];?></td>
                                                <td><?php echo $rows['description'];?></td>
                                                <td>

                                                    <?php if (file_exists($rows['image'])){?>
                                                    <a href="#">
                                                        <img src="<?=$rows['image']?>" width="300" height="200"
                                                            class="myImg">
                                                    </a>
                                                    <?php }  else{
                                                       ?> <h5>Null</h5>
                                                    <?php } 
                                                       ?>


                                                </td>
                                                <td><?php echo $rows['date'];?></td>
                                                <td><?php echo $rows['status'];?></td>
                                                <div id="myModal" class="modal">
                                                    <!-- The Close Button -->
                                                    <span class="close"
                                                        onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                                                    <!-- Modal Content (The Image) -->
                                                    <img class="modal-content" id="img01">
                                                    <!-- Modal Caption (Image Text) -->
                                                </div>

                                            </tr>

                                            <?php
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tabBlock-pane">

                                <div class="container">
                                    <div class="row">
                                        <div class="offset-lg-0 col-lg-12 col-sm-8 col-8 border rounded main-section">
                                            <h3 class="text-center text-inverse">Near Miss Investigation Report</h3>
                                            <hr>
                                            <p><?= $msg?></p>
                                            <form class="container" action="investigation.php" method="post"
                                                enctype="multipart/form-data" id="investigation">

                                                <div class=" row">
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Investigation ID">Name of
                                                                Mines</label>
                                                            <input type="text" class="form-control" id="mines"
                                                                name="mines" placeholder="Name of Mines"
                                                                value="Kodingamali Bauxite Mines" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="Investigation ID">Investigation ID</label>
                                                            <?php
                                                $query = "SELECT * FROM  nearmiss_investigation";
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
                                                            <label class="text-inverse" for="site">Site*</label>
                                                            <input type="text" class="form-control" id="site"
                                                                name="site" style="text-transform:capitalize ;"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Near
                                                                Miss/Incident Reference Number">Near
                                                                Miss/Incident Reference Number*</label>
                                                            <?php

                                                                if(!empty($_GET['id'])){
                                                                ?>
                                                            <input type="text" class="form-control" id="id"
                                                                style="text-transform:capitalize ;"
                                                                value="<?=$_GET['id']?>" name="id" required readonly>
                                                            <?php
                                                                }  
                                                                else{           
                                                                ?>
                                                            <input type="text" class="form-control" id="id"
                                                                style="text-transform:capitalize ;" name="id" required>
                                                            <?php
                                                                }
                                                                ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <label class="text-inverse" style="font-weight: 600; font-size: 20px;"
                                                    for="Investigation Team Details">
                                                    Investigation Team Details </label>
                                                <p>(Let the team be limited to max 3 persons)</p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table table-bordered table-hover" id="tab_logic">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        Name
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Designation
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
                                                                        <input type="text" name='designation[]'
                                                                            class="form-control" required />
                                                                    </td>
                                                                </tr>
                                                                <tr id='addr1'></tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <button id="add_row" class="btn btn-default pull-left" type="button"
                                                        style="font-size:30px ; margin-left: 950px;"><i
                                                            class="fa-sharp fa-solid fa-circle-plus"></i></button>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="Details of the Near Miss/Incident: ">
                                                                Details of the Near Miss/Incident: *</label>
                                                            <textarea name="details" id="details" cols="30" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse" for="Person(s) Involved: ">
                                                                Person(s) Involved: *</label>
                                                            <textarea name="person" id="person" cols="30" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for=" Likely Consequence(s)/Consequence(s) of the Near Miss/ Incident: ">
                                                                Likely Consequence(s)/Consequence(s) of the Near Miss/
                                                                Incident: *</label>
                                                            <textarea name="consequence" id="consequence" cols="30"
                                                                rows="5" class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for=" Chronology of Investigation:  "
                                                                style="font-weight: 700;">
                                                                Chronology of Investigation: *</label>
                                                            <div class="row">

                                                                <div class="col-lg-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="Date of Visit to the site">Date of
                                                                            Visit
                                                                            to the site</label>
                                                                        <input type="date" name="visit_date" required
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="Persons/witnesses examined or talked to">Persons/witnesses
                                                                            examined or talked to</label>
                                                                        <input type="text" name="person_talked" required
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-lg-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="Date(s) of collection of further evidences/documents, if any: ">Date(s)
                                                                            of collection of further
                                                                            evidences/documents, if any: </label>
                                                                        <input type="date" name="collection_date"
                                                                            required class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="Date(s) when the team conferred to finalize the investigation:">Date(s)
                                                                            when the team conferred to finalize the
                                                                            investigation:*</label>
                                                                        <input type="date" name="finalize_date" required
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for="Immediate Action(s) taken on site to fix the problem">
                                                                Immediate Action(s) taken on site to fix the problem
                                                                *</label>
                                                            <textarea name="action" id="action" cols="30" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for=" Findings of the Investigation & Further actions required to be taken (description in brief)">
                                                                Findings of the Investigation & Further actions required
                                                                to be taken (description in brief)*</label>
                                                            <textarea name="finding" id="finding" cols="30" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-inverse"
                                                                for=" Identification of Cause(s)"
                                                                style="font-weight: 700;">
                                                                Identification of Cause(s)*</label>
                                                            <div class="row">

                                                                <div class="col-lg-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="Date of Visit to the site">Contributory
                                                                            Cause(s)*</label>

                                                                        <textarea name="contributory" id="contributory"
                                                                            cols="30" rows="5" required
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="Root Cause(s)">Root
                                                                            Cause(s)*</label>


                                                                        <textarea name="root" id="root" cols="30"
                                                                            rows="5" required
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>

                                                <hr>

                                                <label class="text-inverse" style="font-weight: 600; font-size: 20px;"
                                                    for="Proposed Corrective/Preventive Action(s):">
                                                    Proposed Corrective/Preventive Action(s): </label>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table table-bordered table-hover" id="ptab_logic">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        Action to be taken*
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Priority*
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Responsibility*
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Timeline*
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr id='paddr0'>
                                                                    <td>

                                                                        <textarea name="action_to[]" cols="40" rows="3"
                                                                            class="form-control" required></textarea>
                                                                    </td>
                                                                    <td>
                                                                        <select
                                                                            class="custom-select d-block form-control"
                                                                            id="priority" name="priority[]" required>
                                                                            <option value="">Select category</option>
                                                                            <option value="High">High</option>
                                                                            <option value="Medium">Medium</option>
                                                                            <option value="Low">Low</option>

                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name='responsibility[]'
                                                                            class="form-control" required />
                                                                    </td>
                                                                    <td>
                                                                        <input type="date" name='timeline[]'
                                                                            class="form-control" required />
                                                                    </td>
                                                                </tr>
                                                                <tr id='paddr1'></tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <button id="add_row1" class="btn btn-default pull-left"
                                                        type="button" style="font-size:30px ; margin-left: 950px;"><i
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
                                <div class=" d-flex table-data"
                                    style="height: 560px;overflow: scroll; flex-basis: 40%;  margin: 1em 0em; margin-left: 10px;">
                                    <table class="table table-bordered">
                                        <thead style="text-align: center; justify-items: center;">
                                            <tr>
                                                <th scope="col">Investigation ID</th>
                                                <th scope="col">Name of Mines</th>
                                                <th scope="col">Site</th>
                                                <th scope="col">Near Miss/Incident Reference Number</th>
                                                <th scope="col">Investigation Team Details</th>
                                                <th scope="col">Details of the Near Miss/Incident</th>
                                                <th scope="col">Person(s) Involved </th>
                                                <th scope="col">Likely Consequence(s)of the Near Miss</th>
                                                <th scope="col">Date of Visit to the site</th>
                                                <th scope="col">Persons/witnesses examined or talked to</th>
                                                <th scope="col">Date(s) of collection of further evidences</th>
                                                <th scope="col">Date(s) when the team conferred to finalize</th>
                                                <th scope="col">Immediate Action(s) taken on site to fix the problem
                                                </th>
                                                <th scope="col">Findings of the Investigation</th>
                                                <th scope="col">Contributory Cause(s)</th>
                                                <th scope="col">Root Cause(s)</th>
                                                <th scope="col">Proposed Corrective/Preventive Action(s)</th>


                                            </tr>
                                        </thead>
                                        <tbody id="tbody3" style="text-align: center;">
                                            <?php

           
            $query = "SELECT * FROM nearmiss_investigation WHERE email= '$email'";
            $result = mysqli_query($con, $query);

            while($rows = mysqli_fetch_assoc($result))
            {?>

                                            <tr>
                                                <td><?php echo $rows['id'];?></td>
                                                <td><?php echo $rows['mines'];?> </td>
                                                <td><?php echo $rows['site'];?></td>
                                                <td><?php echo $rows['nearmiss_id'];?></td>
                                                <td>

                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Designation </th>
                                                        </thead>
                                                        <?php
                                                $inves=$rows['id'];
                                        $query1 = "SELECT * FROM nearmiss_investigationteam WHERE investigation_id= '$inves'";
                                        $result1 = mysqli_query($con, $query1);
                            
                                        while($rows1 = mysqli_fetch_assoc($result1))
                                               { ?>

                                                        <tbody>
                                                            <tr>

                                                                <td><?php echo $rows1['name'];?></td>
                                                                <td><?php echo $rows1['designation'];?></td>

                                                            </tr>
                                                        </tbody>

                                                        <?php
                }
                ?>
                                                    </table>



                                                </td>
                                                <td><?php echo $rows['details'];?></td>
                                                <td><?php echo $rows['person'];?></td>
                                                <td><?php echo $rows['consequences'];?></td>
                                                <td><?php echo $rows['visit_date'];?></td>
                                                <td><?php echo $rows['person_witness'];?></td>
                                                <td><?php echo $rows['collection_date'];?></td>
                                                <td><?php echo $rows['conferred_date'];?></td>
                                                <td><?php echo $rows['action'];?></td>
                                                <td><?php echo $rows['findings'];?></td>
                                                <td><?php echo $rows['contributory'];?></td>
                                                <td><?php echo $rows['root'];?></td>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <th scope="col">Action_to_be_taken</th>
                                                            <th scope="col">Priority </th>
                                                            <th scope="col">Responsibility</th>
                                                            <th scope="col">Timeline</th>
                                                        </thead>
                                                        <?php
                                                $inves1=$rows['id'];
                                        $query2 = "SELECT * FROM nearmiss_investigationcorrective WHERE incident_id= '$inves1'";
                                        $result2 = mysqli_query($con, $query2);
                            
                                        while($rows2 = mysqli_fetch_assoc($result2))
                                               { ?>

                                                        <tbody>
                                                            <tr>

                                                                <td><?php echo $rows2['action'];?></td>
                                                                <td><?php echo $rows2['priority'];?></td>
                                                                <td><?php echo $rows2['responsibility'];?></td>
                                                                <td><?php echo $rows2['timeline'];?></td>
                                                            </tr>
                                                        </tbody>

                                                        <?php
                }
                ?>
                                                    </table>




                                                </td>


                                            </tr>

                                            <?php
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </figure>
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
    <script>
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementsByClassName('myImg');
    //window.alert(img);
    var i = img.length;
    var j;
    var modalImg = document.getElementById('img01');

    //var captionText = document.getElementById("caption");
    for (j = 0; j < i; j++) {
        img[j].onclick = function() {
            modal.style.display = "flex";
            modalImg.src = this.src;

        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }
    </script>
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
    $(document).ready(function() {
        var i = 1;
        $("#add_row1").click(function() {
            b = i - 1;
            $('#paddr' + i).html($('#paddr' + b).html()).find('td:first-child');
            $('#ptab_logic').append('<tr id="paddr' + (i + 1) + '"></tr>');
            i++;
        });

    });
    </script>

</body>

</html>