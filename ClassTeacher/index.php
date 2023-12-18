
<?php 
include '../Includes/dbcon.php';
include '../Includes/session.php';


    // $query = "SELECT tblclass.className,tblclassarms.classArmName 
    // FROM tblclassteacher
    // INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
    // INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
    // Where tblclassteacher.Id = '$_SESSION[userId]'";

  // $query = "SELECT * from teachers where id= '$_SESSION[userId]'";

  //   $rs = $conn->query($query);
  //   $num = $rs->num_rows;
  //   $rrw = $rs->fetch_assoc();


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
  <title>Online Attendance System</title>
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
            <h1 class="h3 mb-0 text-gray-800">Teacher Dashboard </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
          <!-- New User Card Example -->
          <?php 
          $sql="SELECT st_id FROM students where st_id in (SELECT st_id from st_sub where sub_id in (select sub_id from subject where tc_id='$_SESSION[userId]'));";
            $query1=mysqli_query($conn,$sql);                       
            $students = mysqli_num_rows($query1);
?>
            <div class="col-xl-3 col-md-6 mb-4" onclick="window.location.href = 'viewStudents.php';" style="cursor: pointer;">
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
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
             <?php 
// $query1=mysqli_query($conn,"SELECT tc_course from teachers where ");            

$query1=mysqli_query($conn,"SELECT * FROM subject WHERE tc_id='$_SESSION[userId]'");                       
$class = mysqli_num_rows($query1);
?>
            <div class="col-xl-3 col-md-6 mb-4" onclick="window.location.href = 'class.php';" style="cursor: pointer;">
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
                      <i class="fas fa-book fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
             <!-- <?php 
$query1=mysqli_query($conn,"SELECT * from tblclassarms");                       
$classArms = mysqli_num_rows($query1);
?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Class Arms</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $classArms;?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                         <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span> 
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-code-branch fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             -->
            <!-- Pending Requests Card Example -->
            <!-- <?php 
$query1=mysqli_query($conn,"SELECT * from attendance");                       
$totAttendance = mysqli_num_rows($query1);
?> -->
            <div class="col-xl-3 col-md-6 mb-4"  onclick="window.location.href = 'attendance.php';" style="cursor: pointer;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Take Attendance</div>
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totAttendance;?></div> -->
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- Pending Requests Card Example -->
            <!-- <?php 
$query1=mysqli_query($conn,"SELECT * from attendance");                       
$totAttendance = mysqli_num_rows($query1);
?> -->
            <div class="col-xl-3 col-md-6 mb-4"  onclick="window.location.href = 'attendance.php';" style="cursor: pointer;">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Attendance Report</div>
                      
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-download fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          <!--Row-->
          
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
  </div>
      <!-- Footer -->
      <?php include 'includes/footer.php';?>
      <!-- Footer -->
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