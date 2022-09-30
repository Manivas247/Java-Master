<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>NearMiss</title>

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

if(isset($_SESSION['email'])){
    
    $user = get_user_info($con, $_SESSION['email']);
   
        $email = $_SESSION['email'];
        
    $type = $user['type'];
}

$msg ="";

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


if(isset($_POST['submit']) && empty($error)){

    $id = validate_input_text($_POST['id1']);
    


    $query = "SELECT * FROM nearmiss where task_assign = 0 AND number = '$id'";
    $result = mysqli_query($con, $query);
    while($rows = mysqli_fetch_assoc($result))
    {
        $mines = $rows['mine'];
        $date_incident = $rows['date_incident'];
        $date_report = $rows['date_report'];
        $person = $rows['person'];
        $designation = $rows['designation'];
        $reported_by = $rows['reported_by'];
        $location = $rows['location'];
        $equipment = $rows['equipment'];
        $person_involved = $rows['person_involved'];
        $image = $rows['image'];

    }

   
    $clean = clean($_POST['description1']);
    $description= validate_input_text($clean );
    $name = validate_input_text($_POST['name']);
    $email = validate_input_text($_POST['email1']);
    $designation = validate_input_text($_POST['designation']);
    $phone = ($_POST['phone']);
    $date = date("Y-m-d");
    $active = 0;
    $status= "Not Completed";
  
  

   // make a query
   $query = "INSERT INTO assign_task (incident_id,description,name,email,designation, phone,active,date,mine,date_incident,date_report,person,designation1, reported_by, location,equipment,person_involved,image,status)";
   $query .= "VALUES(?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

   // initialize a statement
   $q = mysqli_stmt_init($con);

   // prepare sql statement
   mysqli_stmt_prepare($q, $query);

   // bind values
   mysqli_stmt_bind_param($q, 'sssssssssssssssssss', $id,$description, $name,$email,$designation,$phone,$active,$date,$mines,$date_incident, $date_report,$person,$designation,$reported_by,$location,$equipment,$person_involved,$image,$status);

   // execute statement
   mysqli_stmt_execute($q);

   if( $id!='' && $description!='' && $name !='' && $email != '' & $designation !='' && $phone !=''){
      $query = "UPDATE nearmiss SET task_assign=? WHERE number =?"; 
      $assign = 1;
       $q = mysqli_stmt_init($con);
       mysqli_stmt_prepare($q, $query);
       mysqli_stmt_bind_param($q, 'ii', $assign,$id);
       mysqli_stmt_execute($q);
       $_POST['id1'] = '';
       $_POST['description1'] = '';
       $_POST['name'] = '';
       $_POST['phone']='';
       $_POST['email1']='';
       $_POST['designation']='';
       $msg = 'Task Assigned Successfully!';
       
    

   }else{
      
    $msg = 'Error while assigning task...!!';

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
.modal1 {
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
.modal-content1 {
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
.modal-content1,
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

.round {
    width: 19px;
    height: 19px;
    border-radius: 50%;
    position: relative;
    background: red;
    display: inline-block;
    padding: 0.3rem 0.2rem !important;


    z-index: 10 !important;
    margin-top: -10px;

}

.round>span {
    color: white;
    display: block;
    text-align: center;
    font-size: 0.6rem !important;
    padding: 0 !important;
    margin-top: -2px;
    margin-left: -2px;
}

#list {

    display: none;
    top: 33px;
    position: absolute;
    right: 2%;
    background: #ffffff;
    z-index: 100 !important;
    width: 25vw;
    margin-left: -37px;

    padding: 0 !important;
    margin: 0 auto !important;


}

.message>span {
    width: 100%;
    display: block;
    color: red;
    text-align: justify;
    margin: 0.2rem 0.3rem !important;
    padding: 0.3rem !important;
    line-height: 1rem !important;
    font-weight: bold;
    border-bottom: 1px solid white;
    font-size: 1.8rem !important;

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
                        <?php if($type == 'admin'){   ?>
                        <a class="collapse-item" href="assigntask.php">Assign Task</a>
                        <?php  } ?>
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
            <?php if($type == 'admin'){   ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fa-sharp fa-solid fa-person-circle-check"></i>
                    <span>Approval</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="userapproval.php">Account</a>
                        <a class="collapse-item" href="training_approval.php">Training</a>

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="reports.php">
                    <i class="fa-solid fa-print"></i>
                    <span>Reports</span></a>
            </li>
            <?php  } ?>
            <li class="nav-item">
                <a class="nav-link" href="training.php">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span>Training</span></a>
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
        $query = "SELECT * FROM assign_task where active =0 and email ='$email' ORDER BY date DESC LIMIT 0,5";
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
                            <li class="tabBlock-tab is-active">New Task</li>
                            <li class="tabBlock-tab">Assigned task</li>
                        </ul>
                        <div class="tabBlock-content">
                            <p><?= $msg?></p>

                            <div class="tabBlock-pane">

                                <div class=" d-flex table-data"
                                    style="height: 560px;overflow: scroll; flex-basis: 40%;  margin: 1em 0em; margin-left: 10px;">
                                    <table class="table table-bordered">
                                        <thead style="text-align: center; justify-items: center;">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Incident Description</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Assign to</th>


                                            </tr>
                                        </thead>
                                        <tbody id="tbody3" style="text-align: center;">
                                            <?php
            $query = "SELECT * FROM nearmiss where task_assign = 0";
            $result = mysqli_query($con, $query);

            while($rows = mysqli_fetch_assoc($result))
            {?>

                                            <tr>
                                                <td data-id="<?php echo $rows['number']; ?>">
                                                    <?php echo $rows['number'];?>
                                                </td>
                                                <td data-id="<?php echo $rows['number']; ?>">
                                                    <?php echo $rows['description'];?></td>
                                                <td data-id="<?php echo $rows['number']; ?>">

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
                                                <td><i class="fa-solid fa-user-pen assign " style="cursor: pointer;"
                                                        data-id="<?php echo $rows['number']; ?>"></i>
                                                </td>
                                                <div id="myModal" class="modal1">
                                                    <!-- The Close Button -->
                                                    <span class="close"
                                                        onclick="document.getElementById('myModal').style.display='none'">&times;</span>
                                                    <!-- Modal Content (The Image) -->
                                                    <img class="modal-content1" id="img01">
                                                    <!-- Modal Caption (Image Text) -->
                                                </div>

                                            </tr>

                                            <?php
                }
                ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal fade exampleModal" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Task Assignment</h5>
                                                <button type="button" class="close" id="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body1">

                                                <form action="assigntask.php" method="post"
                                                    enctype="multipart/form-data" id="reg-form">
                                                    <div class="form-row" style="margin: 5px;">
                                                        <div class="col">
                                                            <label for="ID" class="col-form-label">Incident ID:</label>
                                                            <input type="text" class="form-control" id="id" name="id1"
                                                                readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="description" class="col-form-label">Incident
                                                                Description:</label>
                                                            <textarea cols="28" rows="2" id="description"
                                                                name="description1" readonly> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row" style="margin: 5px;">
                                                        <div class="col">
                                                            <label for="email" class="col-form-label">Email:</label>
                                                            <select name="email1" id="email1" required
                                                                class="custom-select d-block form-control">
                                                                <option value="">Select Email</option>
                                                                <?php
                                                                
                                                                 $query = "SELECT * FROM user where is_approved ='1'";
                                                                 $result = mysqli_query($con, $query);
                                                     
                                                                 while($rows = mysqli_fetch_assoc($result))
                                                                 {?>

                                                                <option value="<?php echo $rows['email']; ?>">
                                                                    <?php echo $rows['email']; ?></option>
                                                                <?php } 
                                                       ?>
                                                            </select>
                                                        </div>


                                                        <div class="col">
                                                            <label for="name" class="col-form-label">Name:</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" readonly required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row" style="margin: 5px;">
                                                        <div class="col">
                                                            <label for="designation" class="col-form-label">Designation
                                                                :</label>
                                                            <input type="text" class="form-control" id="designation"
                                                                name="designation" readonly required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="phone" class="col-form-label">Phone:</label>
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" readonly required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            id="close11">Close</button>
                                                        <button type="submit" class="btn btn-primary" id="submit_login"
                                                            name="submit">Post</button>
                                                    </div>
                                                </form>
                                            </div>

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
                                                <th scope="col">Incident ID</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Phone</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tbody3" style="text-align: center;">
                                            <?php

           require_once 'mysqli_connect.php';
            $query = "SELECT * FROM assign_task";
            $result = mysqli_query($con, $query);

            while($rows = mysqli_fetch_assoc($result))
            {?>

                                            <tr>
                                                <td><?php echo $rows['incident_id'];?></td>
                                                <td><?php echo $rows['description'];?>
                                                </td>
                                                <td><?php echo $rows['name'];?></td>
                                                <td>
                                                    <?php echo $rows['email'];?></td>
                                                <td><?php echo $rows['designation'];?></td>
                                                <td><?php echo $rows['phone'];?></td>

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
        console.log(textvalues3);
        let id = $("input[name*='id1']");
        let description = $("textarea[name*='description1']");
        id.val(textvalues3[0]);
        description.val(textvalues3[1]);

    });

    function displayData2(e) {
        let id = 0;
        const td = $("#tbody3 tr td");
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
    document.getElementById("email1").onchange = changeListener;

    function changeListener() {

        var email = document.getElementById('email1').value;

        $.ajax({
            url: 'taskprocess.php', //This is the current doc
            type: "POST",
            dataType: 'json', // add json datatype to get json
            data: ({
                email: email
            }),
            success: function(data) {
                var name = data.name;
                var designation = data.designation;
                var phone = data.phone

                document.getElementById("name").value = name;
                document.getElementById("phone").value = phone;
                document.getElementById("designation").value = designation;

            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });

    };
    </script>
    <script>
    $(document).ready(function() {
        var ids = new Array();
        $('#over').on('click', function() {
            $('#list').toggle();
        });

        //Message with Ellipsis
        $('div.msg').each(function() {
            var len = $(this).text().trim(" ").split(" ");
            if (len.length > 12) {
                var add_elip = $(this).text().trim().substring(0, 65) + "…";
                $(this).text(add_elip);
            }

        });


        $("#bell-count").on('click', function(e) {
            e.preventDefault();

            let belvalue = $('#bell-count').attr('data-value');

            if (belvalue == '') {

                console.log("inactive");
            } else {
                $(".round").css('display', 'none');
                $("#list").css('display', 'block');

                // $('.message').each(function(){
                // var i = $(this).attr("data-id");
                // ids.push(i);

                // });
                //Ajax
                $('.message').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: 'notify.php',
                        type: 'POST',
                        data: {
                            "incident_id": $(this).attr('data-id')
                        },
                        success: function(data) {

                            console.log(data);
                            location.reload();
                        }
                    });
                });
            }
        });
    });
    </script>





</body>

</html>