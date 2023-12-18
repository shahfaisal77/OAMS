
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
  <title>Dashboard</title>
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
            <h1 class="h3 mb-0 text-gray-800">View Students </h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Students</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Class Attendance</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                  <div class="form-group row mb-3">

                  <!-- <div class="col-xl-6">
                        <label class="form-control-label">Type<span class="text-danger ml-2">*</span></label>
                          <select required name="type" onchange="typeDropDown(this.value)" class="form-control mb-3">
                          <option value="">--Select--</option>
                          <option value="1" >All</option>
                          <option value="2" >By Single Date</option>
                          <option value="3" >By Date Range</option>
                        </select>
                        </div>   -->

                         <div class="col-xl-6">
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
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                </div>
                <div class="table-responsive p-3">
                <!-- <button  class="btn btn-primary my-2 my-sm-0" onclick="exportToExcel('dataTableHover', 'user-data')"><i class="fas fa-download"></i> Generate Report</button> <br><br> -->

                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <form method="post" action="downloadRecord.php">
                    <!-- <div class="form-group row mb-3">
                        <button type="submit" name="down" class="btn btn-primary">Download Attendance</button>
                    </div> -->
                  </form>
                    <thead class="thead-light">
                      
                      <tr>
                     
                        
                        <th>#</th>
                        <th>Roll No</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Email Address</th>
                        <th>Phone No</th>
                        
                      </tr>
                      
                    </thead>
                   
                    <tbody>
 
                  <?php

                    if(isset($_POST['view'])){

                      $dateTaken =  $_POST['dateTaken'];
                      $type =  $_POST['type'];
                      $course=$_POST['classId'];
                  
                     
                        $query = "SELECT * FROM `students` where st_id in(SELECT st_id from st_sub where st_sub.sub_id in(SELECT sub_id from subject WHERE sub_id='$course'))";


                  
                    
                      

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
                                <td>".$rows['st_sem']."</td>
                                <td>".$rows['st_email']."</td>
                                <td>".$rows['st_phone']."</td>
                           
                               
                             
                                
                              </tr>";
                              
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
                </div>
              </div>
            </div>
            </div>
          </div>
         

        </div>
        <!---Container Fluid-->
        
        <div class="row">
               <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Student Attendance</h6>
                    
                </div>
                <div class="card-body">
                                <div class="Basic">
                  <h5 style="text-align: center;"> Attendance Count </h5>
                  <hr>
              <?php
                  if(isset($_POST['view']))
                  {

                 
                    $type =  $_POST['type'];
                   
                    $_SESSION['type']= $_POST['type'];
                    
                    $course=$_SESSION['course'];
                   
                     
                    
               
                    if($type=='1'){
                      $sql="SELECT * FROM attendance  where  course='$course' and st_status=1";
                      $sql1="SELECT * FROM attendance where course='$course' and st_status=0";
                      if ($result=mysqli_query($conn,$sql))
                      {
                          $rowcount=mysqli_num_rows($result);
                          if ($result1=mysqli_query($conn,$sql1))
                          {
                              $rowcount1=mysqli_num_rows($result1);

                                          $dataPoints = array( 

                                              array("y" => $rowcount,"label" => "Present" ),
                                              array("y" => $rowcount1,"label" => "Absent" ),
                                            
                                              );
                                      
                        } 
                      }

                    }

                    if($type=='2'){
                      $singleDate =  $_POST['singleDate'];

                      $sql="SELECT * FROM attendance where  course='$course' and st_status=1 and stat_date='$singleDate'";
                      $sql1="SELECT * FROM attendance where  course='$course' and st_status=0 and  stat_date='$singleDate'";

                      if ($result=mysqli_query($conn,$sql))
                      {
                          $rowcount=mysqli_num_rows($result);
                          if ($result1=mysqli_query($conn,$sql1))
                          {
                              $rowcount1=mysqli_num_rows($result1);

                                          $dataPoints = array( 

                                              array("y" => $rowcount,"label" => "Present" ),
                                              array("y" => $rowcount1,"label" => "Absent" ),
                                            
                                              );
                                      
                        } 
                      }

                    }


                    if($type=='3'){
                      $fromDate =  $_POST['fromDate'];
                      $toDate =  $_POST['toDate'];
                      $_SESSION['fromDate']=$fromDate;
                      $_SESSION['toDate']= $toDate;



                      $sql="SELECT * FROM attendance where  course='$course' and st_status=1 and attendance.stat_date between '$fromDate' and '$toDate'";
                      $sql1="SELECT * FROM attendance where  course='$course' and st_status=0 and attendance.stat_date between '$fromDate' and '$toDate'";

                      if ($result=mysqli_query($conn,$sql))
                      {
                          $rowcount=mysqli_num_rows($result);
                          if ($result1=mysqli_query($conn,$sql1))
                          {
                              $rowcount1=mysqli_num_rows($result1);

                                          $dataPoints = array( 

                                              array("y" => $rowcount,"label" => "Present" ),
                                              array("y" => $rowcount1,"label" => "Absent" ),
                                            
                                              );
                                      
                        } 
                      }

                    }




                    
              }
                ?>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                <?php 
               
                $c1=$_SESSION['course'];
                if(isset($_POST['type'])){
                  $t=$_POST['type'];
                  
                if($t=='1'){  
                
                  $sql="SELECT * FROM attendance where  course='$c1'";
                  $sql1="SELECT * FROM attendance where course='$c1'and st_status='1' ";
                  $psql="SELECT * FROM attendance where course='$c1'and st_status='1' ";
                  $asql="SELECT * FROM attendance where course='$c1'and st_status='0' ";
              

                }
                if($t=='2')
                {
                  
                  $singleDate =  $_POST['singleDate'];
                  echo $singleDate;
                  $sql="SELECT * FROM attendance where  course='$c1'  and stat_date='$singleDate'";
                  $sql1="SELECT * FROM attendance where  course='$c1' and st_status='1' and  stat_date='$singleDate'";
                  $psql="SELECT * FROM attendance where  course='$c1' and st_status='1' and  stat_date='$singleDate'";
                  $asql="SELECT * FROM attendance where  course='$c1' and st_status='0' and  stat_date='$singleDate'";
                }
                if($t=='3')
                {
                  $fromDate =  $_POST['fromDate'];
                  $toDate =  $_POST['toDate'];
                  $_SESSION['fromDate']=$fromDate;
                  $_SESSION['toDate']= $toDate;
                  // echo $fromDate;

                        // SELECT * FROM attendance where course='OSI' and stat_date between '2022-12-01' and '2022-12-14';
                  $sql="SELECT * FROM attendance where  course='$c1' and stat_date between '$fromDate' and '$toDate'";
                  $sql1="SELECT * FROM attendance where  course='$c1' and st_status='1' and stat_date between '$fromDate' and '$toDate'";
                  $psql="SELECT * FROM attendance where  course='$c1' and st_status='1' and  stat_date between '$fromDate' and '$toDate'";
                  $asql="SELECT * FROM attendance where  course='$c1' and st_status='0' and stat_date between '$fromDate' and '$toDate'";
                }
              }
                  
                  // $query = "SELECT * from students inner JOIN attendance on attendance.stat_id=students.st_id where  course='$c1'";
                
                    //   $sql="SELECT * FROM attendance where  course='$c1'";
                    // $sql1="SELECT * FROM attendance where course='$c1' and st_status=1";
                  
                  if ($result=mysqli_query($conn,$sql))
                {
                  $rowcount=mysqli_num_rows($result);
                if ($result1=mysqli_query($conn,$sql1))
                {
                  $rowcount1=mysqli_num_rows($result1);
                  $percentage =number_format ((($rowcount1/$rowcount)*100),1);
                  ?>
                <br>
                <h6> Overall attendance percentage : <?php print($percentage); } }?> %</h6>
                
                <?php

                // $sql="SELECT * FROM attendance where  course='$course' and st_status=1";

                  if ($result=mysqli_query($conn,$psql))
                {
                  $rowcount=mysqli_num_rows($result);
                  ?>
                <h6> Total Presents : <?php print($rowcount); }?> </h6>
                <?php
                // $sql="SELECT * FROM attendance where email='$email' and attendance='absent'";
                // $sql="SELECT * FROM attendance where  course='$course' and st_status=0";

                  if ($result=mysqli_query($conn,$asql))
                {
                  $rowcount=mysqli_num_rows($result);
                  ?>
                <h6> Total Absents : <?php print($rowcount); }?> </h6>
                
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

<!-- <script type="text/javascript">
function exportToExcel(tableID, filename = ''){
    var downloadurl;
    var dataFileType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'export_excel_data.xls';
    
    // Create download link element
    downloadurl = document.createElement("a");
    
    document.body.appendChild(downloadurl);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTMLData], {
            type: dataFileType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
    
        // Setting the file name
        downloadurl.download = filename;
        
        //triggering the function
        downloadurl.click();
    }
}

</script> -->

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Graphical display of user attendance"
  },
  axisY: {
    title: "Attendance Chart",
    includeZero: false,
    prefix: "",
    suffix:  ""
  },
  data: [{
    type: "bar",
    yValueFormatString: "#,##0d",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontWeight: "bolder",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>



</body>

</html>

















<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

// $query = "SELECT tblclass.className,tblclassarms.classArmName 
//     FROM tblclassteacher
//     INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
//     INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId
//     Where tblclassteacher.Id = '$_SESSION[userId]'";

//     $rs = $conn->query($query);
//     $num = $rs->num_rows;
//     $rrw = $rs->fetch_assoc();

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
            <h1 class="h3 mb-0 text-gray-800">All Student in (<?php echo $rrw['className'].' - '.$rrw['classArmName'];?>) Class</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->


              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Student In Class</h6>
                </div>
                <div class="table-responsive p-3">
                  
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      
                      <tr>
                        <th>#</th>
                        <th>Roll No</th>
                        <th>Full Name</th>
                        <th>Department</th>
                        <!-- <th>Batch</th> -->
                        <th>Semester</th>
                        <th>Email Address</th>
                        <th>Phone No</th>
                      </tr>
                    </thead>
                    
                    <tbody>

                  <?php
                      // $query = "SELECT tblstudents.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblstudents.firstName,
                      // tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber,tblstudents.dateCreated
                      // FROM tblstudents
                      // INNER JOIN tblclass ON tblclass.Id = tblstudents.classId
                      // INNER JOIN tblclassarms ON tblclassarms.Id = tblstudents.classArmId
                      // where tblstudents.classId = '$_SESSION[classId]' and tblstudents.classArmId = '$_SESSION[classArmId]'";
                     
                      // $query = $query = "SELECT * from students INNER JOIN attendance on stat_id=students.st_id
                      //  ORDER BY st_id asc";
                      
                      $query =  "SELECT * from students";
                      // $query =  "SELECT * FROM students,attendance,teachers where students.st_id=attendance.stat_id and 
                      // attendance.course=teachers.tc_id and teachers.tc_id='$_SESSION[userId]'";

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
                              
                                <td>".$rows['st_sem']."</td>

                                <td>".$rows['st_email']."</td>
                                <td>".$rows['st_phone']."</td>
                              </tr>";
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
                </div>
              </div>
            </div>
            </div>
          </div>
          <!--Row-->

          <!-- Documentation Link -->
          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/"
                  target="_blank">
                  bootstrap forms documentations.</a> and <a
                  href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                  groups documentations</a></p>
            </div>
          </div> -->

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