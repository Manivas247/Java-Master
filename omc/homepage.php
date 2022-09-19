<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->



    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/d0d48d242d.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- FullCalendar -->
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href='css/fullcalendarxx.min.css' rel='stylesheet' />
    <link href='css/sweetalert.css' rel='stylesheet' />
    <link href='css/AdminLTE.min.css' rel='stylesheet' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


</head>
<?php
session_start();
require_once('bdd.php');
require('helper.php');
date_default_timezone_set("Asia/Manila");

$sql = "SELECT id, title, start, end, color FROM events_demo ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

if(isset($_SESSION['email'])){
    require ('mysqli_connect.php');
    $user = get_user_info($con, $_SESSION['email']);
   
        $email = $_SESSION['email'];
    
}
?>

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
                        <a class="collapse-item" href="assigntask.php">Assign Task</a>
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
                                <i class="fas fa-bell fa-fw" style="margin-right: -5px; font-size: 18px;"></i>
                                <!-- Counter - Alerts -->

                                <?php
        $query = "SELECT * FROM assign_task where active =0 and email ='$email' ORDER BY date DESC LIMIT 0,5 ";
        $count = mysqli_num_rows(mysqli_query($con,$query));
        ?>
                                <span class="badge badge-danger badge-counter"
                                    style="border-radius: 50%;  font-size: 13px;"><?php echo $count; ?></span>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="container shadow p-3 mb-5 bg-white rounded emp-profile"
                            style="font-family: 'Nunito', sans-serif;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-img">
                                        <img src="./img/profile.png" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-head">
                                        <h5 style="text-transform: uppercase;font-family: 'Nunito', sans-serif;">
                                            </b><span><?php echo isset($user['name']) ? $user['name'] : ''; ?></span>
                                        </h5>
                                        <h6 style="text-transform: uppercase;font-family: 'Nunito', sans-serif;">
                                            </b><span><?php echo isset($user['designation']) ? $user['designation'] : ''; ?></span>
                                        </h6>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                                    role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-work">
                                        <p>WORK LINK</p>
                                        <a href="">Passport Details</a><br />
                                        <a href="">IME/PME</a><br />
                                    </div>
                                </div>
                                <div class="col-md-8 " style="margin-top: -50px;">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-md-6">
                                                    </b><span
                                                        style="text-transform: capitalize;"><?php echo isset($user['name']) ? $user['name'] : ''; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-6">
                                                    </b><span
                                                        style="text-transform: none;"><?php echo isset($user['email']) ? $user['email'] : ''; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-md-6">
                                                    </b><span
                                                        style="text-transform: capitalize;"><?php echo isset($user['phone']) ? $user['phone'] : ''; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Blood Group</label>
                                                </div>
                                                <div class="col-md-6">
                                                    </b><span
                                                        style="text-transform: capitalize;"><?php echo isset($user['blood']) ? $user['blood'] : ''; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Designation</label>
                                                </div>
                                                <div class="col-md-6">
                                                    </b><span
                                                        style="text-transform: capitalize;"><?php echo isset($user['designation']) ? $user['designation'] : ''; ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Date of Joining</label>
                                                </div>
                                                <div class="col-md-6">
                                                    </b><span
                                                        style="text-transform: capitalize;"><?php echo isset($user['doj']) ? $user['doj'] : ''; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Experience</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Expert</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Hourly Rate</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>10$/hr</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Total Projects</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>230</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>English Level</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Expert</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Availability</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>6 months</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Your Bio</label><br />
                                                    <p>Your detail description</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row" style="font-family: 'Nunito', sans-serif;">
                        <!-- Area Chart -->

                        <div class="col-6 shadow p-3 mb-5 bg-white rounded py-2 calendar">
                            <div class="box box-success">

                                <div class=" box-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="example1" class="table table-bordered table-hover"
                                                style="margin-right:-10px">




                                                <div id="calendar" class="col-centered">
                                                </div>


                                            </table>

                                        </div>
                                        <!--col end -->

                                    </div>
                                    <!--row end-->

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col (right) -->


                        <div class="col-5 shadow p-3 mb-5 bg-white rounded colors">
                            <div class="box box-success">
                            </div>
                            <!-- Date range -->

                            <div class="col-12 colors-div">
                                <label class="color-scheme-text">ACTIVITY COLOR SCHEME:</label><br>

                                <label class="color-text">Urgent Meeting</label><br>

                                <input type="text" class="form-control" style="background:#FF0000;" required readonly>


                                <label class="color-text">Personal Schedule:</label><br>

                                <input type="text" class="form-control" style="background:#008000;" required readonly>



                                <label class="color-text">Executives Schedule</label><br>

                                <input type="text" class="form-control" style="background:#FF8C00;" required readonly>


                                <label class="color-text">ETC:</label><br>

                                <input type="text" class="form-control" style="background:#0071c5;" required readonly>

                            </div>
                        </div>

                        <!-- /.row -->
                        <?php include('modal.php');?>


                    </div>
                </div>





            </div>
        </div>

        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy;Kodingamali Bauxite Mines 2022</span>
            </div>
        </div>
    </footer>

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>


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
    <script src='js/sweetalert.min.js'></script>
    <script src='packages/list/main.js'> </script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script>
    $(document).ready(function() {


        $('#calendar').fullCalendar({
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: 'prev,next',
                center: 'title',
                //right: 'month,agendaWeek,agendaDay,listDay,listWeek,listMonth',
                right: 'today,month,listWeek,listMonth',
            },
            views: {
                listDay: {
                    buttonText: 'List day'
                },
                listWeek: {
                    buttonText: 'List week'
                },
                listMonth: {
                    buttonText: 'List month'
                },
                month: {
                    buttonText: 'Month'
                },
                today: {
                    buttonText: 'Today'
                },
                agendaWeek: {
                    buttonText: 'Week'
                },
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            timeFormat: "h:mma",
            defaultView: 'month',
            scrollTime: '08:00', // undo default 6am scrollTime
            eventOverlap: false,
            allDaySlot: false,



            select: function(start, end) {

                //$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick',
                    function() { //gawin mong CLICK yung parameter para maging single
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.title);
                        $('#ModalEdit #color').val(event.color);
                        //$('#ModalEdit #start').val(event.start);
                        $('#ModalEdit #start').val(moment(event.start).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        $('#ModalEdit #end').val(moment(event.end).format(
                            'YYYY-MM-DD HH:mm:ss'));
                        //	$('#ModalEdit #end').val(event.end);
                        $('#ModalEdit').modal('show');
                        //var formattedTime = $.fullCalendar.formatDates(event.start, event.end, "HH:mm { - HH:mm}");

                    });

            },

            eventDrop: function(event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function(event, dayDelta, minuteDelta,
                revertFunc) { // si changement de longueur

                edit(event);

            },

            eventMouseover: function(Event, jsEvent) {
                /*var tooltip = '<div class="tooltip" >' +'<b>ACTIVITY :</b>&nbsp;'+ Event.title + '<br><b>TIME :</b>&nbsp;'+(moment(Event.start).format('HH:mma'))+'</div>';*/

                var tooltip = '<div class="tooltip" >' + '<b>Title :</b>&nbsp;' + Event
                    .title +
                    '<br><b>Duration :</b>&nbsp;' + (moment(Event.start).format('HH:mma')) +
                    '&nbsp;-&nbsp;' + (moment(Event.end).format('HH:mma')) + '</div>';

                var $tooltip = $(tooltip).appendTo('body');

                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $tooltip.fadeIn('50');
                    $tooltip.fadeTo('100', 1.9);
                }).mousemove(function(e) {
                    $tooltip.css('top', e.pageY + 10);
                    $tooltip.css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(Event, jsEvent) {
                $(this).css('z-index', 8);
                $('.tooltip').remove();
            },


            events: [
                <?php foreach($events as $event):


            $start = explode(" ", $event['start']);
            $end = explode(" ", $event['end']);
            if($start[1] == '00:00:00'){
                $start = $start[0];
            }else{
                $start = $event['start'];
            }
            if($end[1] == '00:00:00'){
                $end = $end[0];
            }else{
                $end = $event['end'];
            }
            ?> {
                    id: '<?php echo $event['id']; ?>',
                    title: '<?php echo $event['title']; ?>',
                    start: '<?php echo $start; ?>',
                    end: '<?php echo $end; ?>',
                    color: '<?php echo $event['color']; ?>',
                },
                <?php endforeach; ?>
            ]
        });


    });
    </script>

</body>

</html>