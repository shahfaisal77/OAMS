
<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';


    // $query = "SELECT tblclass.className,tblclassarms.classArmName 
    // FROM tblclassteacher
    // INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
    // INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
    // Where tblclassteacher.Id = '$_SESSION[userId]'";

    // $rs = $conn->query($query);
    // $num = $rs->num_rows;
    // $rrw = $rs->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
   <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
           <?php include "Includes/topbar.php";?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Administrator Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3" >
          <!-- Students Card -->
          <?php 
$query1=mysqli_query($conn,"SELECT * from students");                       
$students = mysqli_num_rows($query1);
?>
            <div class="col-xl-3 col-md-6 mb-4" onclick="window.location.href = 'student.php';" style="cursor: pointer;" >
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Students</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $students;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-users fa-2x text-info"></i> -->
                      <!-- Following icons added from bootstrap by us -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
</svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Class Card -->
             <?php 
$query1=mysqli_query($conn,"SELECT * from subject");                       
$class = mysqli_num_rows($query1);
?>
            <div class="col-xl-3 col-md-6 mb-4"  onclick="window.location.href = 'createClass.php';" style="cursor: pointer;" >
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Subjects</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $class;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <!-- following is added from bootstrap icons by us -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
</svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Class Arm Card -->
             <!-- <?php 
$query1=mysqli_query($conn,"SELECT * from tblclassarms");                       
$classArms = mysqli_num_rows($query1);
?> -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Class Arms</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php //echo $classArms;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs"> -->
                        <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span> -->
                      <!-- </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-code-branch fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            
            <!-- Std Att Card  -->
            <!-- <?php 
$query1=mysqli_query($conn,"SELECT * from attendance");                       
$totAttendance = mysqli_num_rows($query1);
?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Student Attendance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totAttendance;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-secondary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- Teachers Card  -->
            <?php 
            $query1=mysqli_query($conn,"SELECT * from teachers");                       
            $classTeacher = mysqli_num_rows($query1);
            ?>
                        <div class="col-xl-3 col-md-6 mb-4" onclick="window.location.href = 'createClassTeacher.php';" style="cursor: pointer;">
                          <div class="card h-100">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-uppercase mb-1">Teachers</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classTeacher;?></div>
                                  <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span>Since last years</span> -->
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <!-- following code is from bootstrap for teacher icon added by us -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
  <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
  <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
</svg>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          

                         <!-- Session and Terms Card  -->
            <!-- <?php 
            $query1=mysqli_query($conn,"SELECT * from tblsessionterm");                       
            $sessTerm = mysqli_num_rows($query1);
            ?> -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card h-100">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-uppercase mb-1">Session & Terms</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sessTerm;?></div>
                                  <div class="mt-2 mb-0 text-muted text-xs">
                                     <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span>Since last years</span> 
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-calendar-alt fa-2x text-warning"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->


                        <!-- Terms Card  -->
            <!-- <?php 
            $query1=mysqli_query($conn,"SELECT * from tblterm");                       
            $termonly = mysqli_num_rows($query1);
            ?> -->
                        <!-- <div class="col-xl-3 col-md-6 mb-4">
                          <div class="card h-100">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                  <div class="text-xs font-weight-bold text-uppercase mb-1">Terms</div>
                                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $termonly;?></div>
                                  <div class="mt-2 mb-0 text-muted text-xs">
                                     <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span>Since last years</span> 
                                  </div>
                                </div>
                                <div class="col-auto">
                                  <i class="fas fa-th fa-2x text-info"></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
          <!--Row-->

          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                  class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
            </div>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>