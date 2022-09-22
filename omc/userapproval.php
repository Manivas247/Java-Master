<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>User Approval</title>

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
                            <li class="tabBlock-tab is-active">Pending Approval</li>
                            <li class="tabBlock-tab">Approved Users</li>

                        </ul>
                        <div class="tabBlock-content">

                            <div class="tabBlock-pane">
                                <div class=" d-flex table-data"
                                    style="height: 560px;overflow: scroll; flex-basis: 40%;  margin: 1em 0em; margin-left: 10px;">
                                    <table class="table table-bordered">
                                        <thead style="text-align: center; justify-items: center;">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Employee ID</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Blood Group</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Date of Joining</th>
                                                <th scope="col">Approval</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody2" style="text-align: center;">
                                            <?php

           
            $query = "SELECT * FROM user where is_approved = '0'";
            $result = mysqli_query($con, $query);

            while($rows = mysqli_fetch_assoc($result))
            {?>

                                            <tr>
                                                <td data-id="<?php echo $rows['email']; ?>"><?php echo $rows['name'];?>
                                                </td>
                                                <td data-id="<?php echo $rows['email']; ?>">
                                                    <?php echo $rows['employee_id'];?>
                                                </td>
                                                <td data-id="<?php echo $rows['email']; ?>"><?php echo $rows['email'];?>
                                                </td>
                                                <td data-id="<?php echo $rows['email']; ?>">
                                                    <?php echo $rows['department'];?></td>
                                                <td data-id="<?php echo $rows['email']; ?>"><?php echo $rows['phone'];?>
                                                </td>
                                                <td data-id="<?php echo $rows['email']; ?>"><?php echo $rows['blood'];?>
                                                </td>
                                                <td data-id="<?php echo $rows['email']; ?>">
                                                    <?php echo $rows['designation'];?></td>
                                                <td data-id="<?php echo $rows['email']; ?>"><?php echo $rows['doj'];?>
                                                </td>
                                                <td><i class="fa-solid fa-user-pen assign " style="cursor: pointer;"
                                                        data-id="<?php echo $rows['email']; ?>"></i></td>
                                            </tr>

                                            <?php
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tabBlock-pane">
                                <div class=" d-flex table-data"
                                    style="height: 560px;overflow: scroll; flex-basis: 40%;  margin: 1em 0em; margin-left: 10px;">
                                    <table class="table table-bordered">
                                        <thead style="text-align: center; justify-items: center;">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Employee ID</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Blood Group</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Date of Joining</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody3" style="text-align: center;">
                                            <?php

           
            $query = "SELECT * FROM user where is_approved = '1'";
            $result = mysqli_query($con, $query);

            while($rows = mysqli_fetch_assoc($result))
            {?>

                                            <tr>
                                                <td><?php echo $rows['name'];?></td>
                                                <td><?php echo $rows['employee_id'];?>
                                                </td>
                                                <td><?php echo $rows['email'];?></td>
                                                <td>
                                                    <?php echo $rows['department'];?></td>
                                                <td><?php echo $rows['phone'];?></td>
                                                <td><?php echo $rows['blood'];?></td>
                                                <td><?php echo $rows['designation'];?></td>
                                                <td><?php echo $rows['doj'];?></td>

                                            </tr>

                                            <?php
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </figure>
                </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p>Do you really want to approve the account of selected user...</p>
                            <input type="hidden" name="email1" id="email1" readonly>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                id="close11">Close</button>
                            <button type="button" class="btn btn-primary" id="approve">Approve</button>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
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
    $(document).ready(function() {
        $(".assign").on("click", function() {
            $("#exampleModal").modal("show");
        });
    });

    $(document).ready(function() {
        $(".close").on("click", function() {
            $("#exampleModal").modal("hide");
        });
    });
    $(document).ready(function() {
        $("#close11").on("click", function() {
            $("#exampleModal").modal("hide");
        });
    });

    $(".assign").click((e) => {
        let textvalues3 = displayData2(e);
        let email = $("input[name*='email1']");
        email.val(textvalues3[2]);


    });

    function displayData2(e) {
        let id = 0;
        const td = $("#tbody2 tr td");
        let textvalues3 = [];
        for (const value of td) {
            if (value.dataset.id == e.target.dataset.id) {
                textvalues3[id++] = value.textContent.replace(/(\r\n|\n|\r)/gm, '').replace(/\s+/, "");
            }
        }
        return textvalues3;
    }
    </script>

    <script>
    document.getElementById('approve').onclick = changeListener;

    function changeListener() {

        var email = document.getElementById('email1').value;
        console.log(email);

        $.ajax({
            url: 'approvalprocess.php', //This is the current doc
            type: "POST", // add json datatype to get json
            data: ({
                email: email
            }),
            success: function(data) {

                alert("User Account has been Approved Successfully");
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });

    };
    </script>

</body>

</html>