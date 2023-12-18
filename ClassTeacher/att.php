
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';


  
        // $qus1=mysqli_query($conn,"SELECT * from teachers inner join subject on tc_id = teachers.tc_id and teachers.tc_id='$_SESSION[userId]'");
        // $ros1 = $qus1->fetch_assoc();
        // $c=$ros1['tc_name'];
        // echo $c;
        
        // $dateTaken = date("Y-m-d");
        $todaysDate = date("Y-m-d");

        $todaysDate1 = date("Y-m-d");
    //     if(isset($_POST['save'])){
    //       $dateTaken=$_POSt['dateTaken'];
        
    //     //     $qurty=mysqli_query($conn,"select * from attendance  where course = '$c' and stat_date='$dateTaken'");
    //     //     $count = mysqli_num_rows($qurty);
       
    //     // if($count == 0){ //if Record does not exsit, insert the new record

    //       //insert the students record into the attendance table on page load
    //       // $qus=mysqli_query($conn,"select * from tblstudents  where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]'");
    //       $qus1=mysqli_query($conn,"SELECT * from teachers inner join class on class_id = teachers.tc_course and teachers.tc_id='$_SESSION[userId]'");
    //       $ros1 = $qus1->fetch_row();
          
          
          
    //       $qus=mysqli_query($conn,"select * from students");
    //       while ($ros = $qus->fetch_assoc())
    //       {
    //           $qquery=mysqli_query($conn,"insert into attendance(stat_id,course,st_status,stat_date) 
    //           values('$ros[st_id]','$c','0','$dateTaken')");

    //       }
    //     }

    // //   }
      



if(isset($_POST['save'])){
    $dateTaken=$_POST['dateTaken'];
    $c=$_SESSION['sub_id'];
    $_SESSION['date'];
        // if($dateTaken >  $todaysDate )
        $qurty=mysqli_query($conn,"select * from attendance  where sub_id ='$c' and stat_date='$_SESSION[date]'");
        $count = mysqli_num_rows($qurty);
        if($count == 0){ 
            // $qus1=mysqli_query($conn,"SELECT * from teachers inner join subject on sub_id = $c and teachers.tc_id='$_SESSION[userId]'");
            // $ros1 = $qus1->fetch_row();
            $qus=mysqli_query($conn,"SELECT * FROM `students` where st_id in(SELECT st_id from st_sub where st_sub.sub_id in(SELECT sub_id from subject WHERE sub_id='$c'))");
            while ($ros = $qus->fetch_assoc())
            {
                $qquery=mysqli_query($conn,"insert into attendance(st_id,sub_id,tc_id,st_status,stat_date) 
                values('$ros[st_id]','$c','$_SESSION[userId]','0','$_SESSION[date]')");
  
            }


        }
        else{
            
            $qquery1=mysqli_query($conn," update attendance set st_status='0' where  sub_id ='$c' and tc_id='$_SESSION[userId]' and  stat_date='$_SESSION[date]' ")or die("not");
            if ($qquery1==true) {

                $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Attendance Taken Successfully!</div>";
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }

        }
    
    
        $admissionNo=$_POST['admissionNo'];

    $check=$_POST['check'];
    $N = count($admissionNo);
   
    $status = "";
        for($i = 0; $i < $N; $i++)
        {
  

       

                $admissionNo[$i]; //admission Number

                if(isset($check[$i])) //the checked checkboxes
                {
                  
                    
                      $qquery=mysqli_query($conn," update attendance set st_status='1' where st_id = '$check[$i]' and sub_id ='$c' and tc_id='$_SESSION[userId]' and stat_date='$_SESSION[date]'")or die("not");
       
                      if ($qquery==true) {

                          $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Attendance Taken Successfully!</div>";
                      }
                      else
                      {
                          $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
                      }
                  
                }
               
                
          }
      }

   

// }


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



   <script>
     $("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});
    function classArmDropdown(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxClassArms2.php?cid="+str,true);
        xmlhttp.send();
    }
}
</script>
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
            <h1 class="h3 mb-0 text-gray-800">Take Attendance (Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Select Subject and Date</h6>
                   
                </div>
                <div class="card-body">
                  <form method="post">
                  <div class="form-group row mb-3">

                

                         <div class="col-xl-4">
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                        <?php
                        $qry= "SELECT * FROM subject where subject.tc_id='$_SESSION[userId]' ORDER BY subject_name ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="classId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['sub_id'].'" >'.$rows['subject_name'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                        
                        <div class="col-xl-4">
                        <label class="form-control-label">Select Date<span class="text-danger ml-2" >*</span></label>
                            <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName" placeholder="Class Arm Name" required>
                        </div>



                        <!-- <div class="col-xl-6">
                        <label class="form-control-label">Select Date<span class="text-danger ml-2">*</span></label>
                            <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName" placeholder="Class Arm Name">
                        </div>
                       -->
                    </div>
                    <?php
                        echo"<div id='txtHint'></div>";
                      ?>
                    <button type="submit" name="view" class="btn btn-primary">View Students</button>
                  </form>
                </div>
              </div>

              <!-- Input Group -->
        <form method="post">
            <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
               
                
              
                        
                       
                  
                
                <div class="table-responsive p-3">
                <?php echo $statusMsg; ?>
                 
                  <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">

                      
                      <tr>
                       
                        <th>#</th>
                        <th>Roll No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <!-- <th>Batch</th> -->
                        <!-- <th>Semester</th> -->
                        <th>Present</th>
                        
                        <!-- <th><input type="checkbox" class="checkbox" id="checkAll"  />Present</th> -->
                        <!-- <th >Check</th> -->

                        <!-- <th>Class</th>
                        <th>Class Arm</th> -->
                      </tr>
                    </thead>
                    
                    <tbody>

                  <?php
                    
                    if(isset($_POST['view'])){

                        $dateTaken =  $_POST['dateTaken'];
                        $type =  $_POST['type'];
                        $course=$_POST['classId'];
                        $_SESSION['sub_id']=$course;
                        $_SESSION['date']=$dateTaken;
                          $q="select subject_name from subject where sub_id='$course'";
                          $re = mysqli_query($conn,$q);
                          while ($row = mysqli_fetch_assoc($re)) {
                           
                            $sname= $row["subject_name"];
                        }
                      
                        
                        if($dateTaken > $todaysDate1)
                        {
                            echo "<script>
                                alert('Future Date is selected!');
                                </script>";
                        }
                        elseif($dateTaken < $todaysDate1){
                            echo "<script>
                            alert('Past Date is selected!');
                            </script>";
                        }
                      
                        ?>
                          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Student in (<?php echo $sname;?>)  / Date (<?php echo $dateTaken;?>) </h6>
                        
                        <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click on the checkboxes besides each student to take attendance!</i></h6>
                        </div> 
                <?php
                       
                          $query = "SELECT * FROM `students` where st_id in(SELECT st_id from st_sub where st_sub.sub_id in(SELECT sub_id from subject WHERE sub_id='$course'))";
  
                    //   $query = $query = "SELECT * from students ";

                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                            
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['st_id']."</td>
                                <td>".$rows['st_name']."</td>
                                <td>".$rows['st_lname']."</td>
                                <td>".$rows['st_dept']."</td>
                                 
                                <td><input name='check[]' type='checkbox' value=".$rows['st_id']." class='check' ></td>
                              </tr>";
                              echo "<input name='admissionNo[]' value=".$rows['st_id']." type='hidden' class='form-control form-control-sm'>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                    }
                      ?>
                    </tbody>
                  </table>
                  <br>
                  <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php include "Includes/footer.php";?>
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
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>









































<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';


  
        // $qus1=mysqli_query($conn,"SELECT * from teachers inner join subject on tc_id = teachers.tc_id and teachers.tc_id='$_SESSION[userId]'");
        // $ros1 = $qus1->fetch_assoc();
        // $c=$ros1['tc_name'];
        // echo $c;
        
        // $dateTaken = date("Y-m-d");
        $todaysDate = date("Y-m-d");
    //     if(isset($_POST['save'])){
    //       $dateTaken=$_POSt['dateTaken'];
        
    //     //     $qurty=mysqli_query($conn,"select * from attendance  where course = '$c' and stat_date='$dateTaken'");
    //     //     $count = mysqli_num_rows($qurty);
       
    //     // if($count == 0){ //if Record does not exsit, insert the new record

    //       //insert the students record into the attendance table on page load
    //       // $qus=mysqli_query($conn,"select * from tblstudents  where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]'");
    //       $qus1=mysqli_query($conn,"SELECT * from teachers inner join class on class_id = teachers.tc_course and teachers.tc_id='$_SESSION[userId]'");
    //       $ros1 = $qus1->fetch_row();
          
          
          
    //       $qus=mysqli_query($conn,"select * from students");
    //       while ($ros = $qus->fetch_assoc())
    //       {
    //           $qquery=mysqli_query($conn,"insert into attendance(stat_id,course,st_status,stat_date) 
    //           values('$ros[st_id]','$c','0','$dateTaken')");

    //       }
    //     }

    // //   }
      



if(isset($_POST['save'])){
    $dateTaken=$_POST['dateTaken'];
        // if($dateTaken >  $todaysDate )
        $qurty=mysqli_query($conn,"select * from attendance  where course = '$c' and stat_date='$dateTaken'");
        $count = mysqli_num_rows($qurty);
        if($count == 0){ 
            $qus1=mysqli_query($conn,"SELECT * from teachers inner join class on class_id = teachers.tc_course and teachers.tc_id='$_SESSION[userId]'");
            $ros1 = $qus1->fetch_row();
            $qus=mysqli_query($conn,"select * from students");
            while ($ros = $qus->fetch_assoc())
            {
                $qquery=mysqli_query($conn,"insert into attendance(stat_id,course,st_status,stat_date) 
                values('$ros[st_id]','$c','0','$dateTaken')");
  
            }


        }
        else{
            
            $qquery=mysqli_query($conn," update attendance set st_status='0' where  stat_date='$dateTaken' ")or die("not");

        }
    
    
        $admissionNo=$_POST['admissionNo'];

    $check=$_POST['check'];
    $N = count($admissionNo);
   
    $status = "";
        for($i = 0; $i < $N; $i++)
        {
  

       

                $admissionNo[$i]; //admission Number

                if(isset($check[$i])) //the checked checkboxes
                {
                  
                    
                      $qquery=mysqli_query($conn," update attendance set st_status='1' where stat_id = '$check[$i]' and  stat_date='$dateTaken'")or die("not");
       
                      if ($qquery==true) {

                          $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Attendance Taken Successfully123123!</div>";
                      }
                      else
                      {
                          $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
                      }
                  
                }
               
                
          }
      }

   

// }


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



   <script>
     $("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});
    function classArmDropdown(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxClassArms2.php?cid="+str,true);
        xmlhttp.send();
    }
}
</script>
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
            <h1 class="h3 mb-0 text-gray-800">Take Attendance (Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->


              <!-- Input Group -->
        <form method="post">
            <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Student in (<?php echo $rrw['className'].' - '.$rrw['classArmName'];?>) Class</h6>
                  <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click on the checkboxes besides each student to take attendance!</i></h6>
                </div>  
                <div class="col-xl-4">
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                        <?php
                        $qry= "SELECT * FROM subject where subject.tc_id='$_SESSION[userId]' ORDER BY subject_name ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="classId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['sub_id'].'" >'.$rows['subject_name'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>  
                        </div>
              
                        <div class="col-xl-4">
                        <label class="form-control-label">Select Date<span class="text-danger ml-2" >*</span></label>
                            <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName" placeholder="Class Arm Name" required>
                        </div>
                        
                       
                  
                
                <div class="table-responsive p-3">
                <?php echo $statusMsg; ?>
                 
                  <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">

                      
                      <tr>
                       
                        <th>#</th>
                        <th>Roll No</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <!-- <th>Batch</th> -->
                        <!-- <th>Semester</th> -->
                        <th>Present</th>
                        
                        <!-- <th><input type="checkbox" class="checkbox" id="checkAll"  />Present</th> -->
                        <!-- <th >Check</th> -->

                        <!-- <th>Class</th>
                        <th>Class Arm</th> -->
                      </tr>
                    </thead>
                    
                    <tbody>

                  <?php
                    
                    
                      $query = $query = "SELECT * from students ";

                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                            
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['st_id']."</td>
                                <td>".$rows['st_name']."</td>
                                <td>".$rows['st_dept']."</td>
                                 
                                <td><input name='check[]' type='checkbox' value=".$rows['st_id']." class='check' ></td>
                              </tr>";
                              echo "<input name='admissionNo[]' value=".$rows['st_id']." type='hidden' class='form-control form-control-sm'>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
                    </tbody>
                  </table>
                  <br>
                  <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php include "Includes/footer.php";?>
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
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>
