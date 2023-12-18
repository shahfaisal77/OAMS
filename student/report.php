<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';
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

<script>
    function typeDropDown(str) {
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
        xmlhttp.open("GET","ajaxCallTypes.php?tid="+str,true);
        xmlhttp.send();
    }
}
</script>

</head>
<style type="text/css">
        .Basic {
	background-color: #f8f9fa;
	padding: 14px;
	border-radius: 4px;
	margin-left: 120px;
	margin-right: 120px;
	margin-bottom: 10px;
	margin-top: 14px;
	
}
    </style>

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
            <h1 class="h3 mb-0 text-gray-800">Generate Attendance Report</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Attendance Report</li>
            </ol>
          </div>

         
                
              <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Student Attendance Report</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form action="r.php" method="post">
                    <div class="form-group row mb-3">
                        <!-- <div class="col-xl-6">
                        <label class="form-control-label">Select Student<span class="text-danger ml-2">*</span></label>
                        <?php
                        $qry= "SELECT * FROM tblstudents where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]' ORDER BY firstName ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="admissionNumber" class="form-control mb-3">';
                          echo'<option value="">--Select Student--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['admissionNumber'].'" >'.$rows['firstName'].' '.$rows['lastName'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>  
                        </div> -->
                        <div class="col-xl-5">
                        <label class="form-control-label">Roll No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="roll" value="<?php echo $_SESSION['userId'];?>" id="exampleInputFirstName" readonly>
                        </div>
                        

                        <div class="col-xl-5">
                        <label class="form-control-label">Select Subject<span class="text-danger ml-2">*</span></label>
                        <?php
                        // $qry= "SELECT * FROM subject where subject.tc_id='$_SESSION[userId]' ORDER BY subject_name ASC";
                        $qry= "  SELECT * FROM subject where sub_id in ( select sub_id from st_sub where st_id='$_SESSION[userId]' )ORDER BY subject_name ASC";

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
                        
                        
                        <div class="col-xl-5">
                        <label class="form-control-label">Type<span class="text-danger ml-2">*</span></label>
                          <select required name="type" onchange="typeDropDown(this.value)" class="form-control mb-3">
                          <option value="">--Select--</option>
                          <option value="1" >All</option>
                          <option value="2" >By Single Date</option>
                          <option value="3" >By Date Range</option>
                        </select>
                        </div>
                    </div>
                      <?php
                        echo"<div id='txtHint'></div>";
                      ?>
                
                    <button type="submit" name="sview" class="btn btn-primary">Generate Report</button>
                  </form>
                </div>
              </div>
              </div>
              </div>
              </div>

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


