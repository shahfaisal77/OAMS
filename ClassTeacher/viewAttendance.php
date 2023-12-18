
<?php 
error_reporting(0);
include '../Includes/dbcon.php'; 
include '../Includes/session.php';
//--------------------------------DELETE------------------------------------------------------------------

  // if (isset($_GET['Id']) && isset($_GET['classArmId']) && isset($_GET['action']) && $_GET['action'] == "delete")
  
  if (isset($_GET['Id']) && isset($_GET['action']))
	{
        $Id= $_GET['Id'];
        $c=  $_GET['action'];
        $date=$_GET['Id2'];
        
       
    
  
        $query = mysqli_query($conn,"DELETE FROM attendance WHERE st_id='$Id' and sub_id='$_SESSION[sub_id]' and stat_date='$date' ");

        if ($query == TRUE) {
          echo "<script>
          alert('Data Deleted Successfully');
        </script>";
    

          echo "<script type = \"text/javascript\">
                window.location = (\"viewAttendance.php\")
                </script>"; 

        }
        else{

          echo "<script>
          alert('An error Occurred!');
        </script>";
        echo "<script type = \"text/javascript\">
                window.location = (\"viewAttendance.php\")
                </script>"; 

    
         }
      
  }



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
            <h1 class="h3 mb-0 text-gray-800">View Subject Attendance</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Subject Attendance</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Subject Attendance</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                  <div class="form-group row mb-3">


                  <div class="col-xl-5">
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

                  <div class="col-xl-5">
                        <label class="form-control-label">Type<span class="text-danger ml-2">*</span></label>
                          <select required name="type" onchange="typeDropDown(this.value)" class="form-control mb-3">
                          <option value="">--Select--</option>
                          <option value="1" >All</option>
                          <option value="2" >By Single Date</option>
                          <option value="3" >By Date Range</option>
                        </select>
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
                    <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                  </form>
                </div>
              </div>

              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Attendance Table</h6>
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
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Delete</th>
                      </tr>
                      
                    </thead>
                   
                    <tbody>
 
                  <?php

                    if(isset($_POST['view'])){

                      $dateTaken =  $_POST['dateTaken'];
                      $type =  $_POST['type'];
                      $course=$_POST['classId'];
                      $_SESSION['sub_id']=$course;



                      $q="select subject_name from subject where sub_id='$course'";
                      $re = mysqli_query($conn,$q);
                      while ($row = mysqli_fetch_assoc($re)) {
                       
                        $sname= $row["subject_name"];
                    }
                  

                      if($type == "1"){ //Single Date Attendance
                        // $singleDate =  $_POST['singleDate'];
                        // $c1=$_SESSION['course'];
                        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course ORDER BY stat_date DESC";


                      }
                      if($type == "2"){ //Single Date Attendance
                        $singleDate =  $_POST['singleDate'];
                        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course and attendance.stat_date='$singleDate' ORDER BY stat_date DESC";


                      }
                      // $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,tblclass.className,
                      // tblclassarms.classArmName,tblsessionterm.sessionName,tblsessionterm.termId,tblterm.termName,
                      // tblstudents.firstName,tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber
                      // FROM tblattendance
                      // INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                      // INNER JOIN tblclassarms ON tblclassarms.Id = tblattendance.classArmId
                      // INNER JOIN tblsessionterm ON tblsessionterm.Id = tblattendance.sessionTermId
                      // INNER JOIN tblterm ON tblterm.Id = tblsessionterm.termId
                      // INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                      // where tblattendance.dateTimeTaken = '$dateTaken' and tblattendance.classId = '$_SESSION[classId]' and tblattendance.classArmId = '$_SESSION[classArmId]'";
                     
                      // $query = "SELECT * from students inner JOIN attendance on attendance.stat_id=students.st_id where attendance.stat_date='$dateTaken'";
                     
                     
                      if($type == "3"){ //Date Range Attendance

                        $fromDate =  $_POST['fromDate'];
                        $toDate =  $_POST['toDate'];
                      
                        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where  sub_id=$course and  
                          attendance.stat_date between '$fromDate' and '$toDate' order by stat_date DESC";
                      
                      
                      }
                      

                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                              if($rows['st_status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                 <td>".$rows['st_id']."</td>
                                <td>".$rows['st_name']."</td>
                                <td>".$rows['st_dept']."</td>
                                <td>".$rows['st_sem']."</td>
                                <td>".$sname."</td>
                                <td style='background-color:".$colour."'>".$status."</td>

                                
                                <td>".$rows['stat_date']."</td>
                                <td><a href='?action=".$sname."&Id=".$rows['st_id']."&Id2=".$rows['stat_date']."'><i class='fas fa-fw fa-trash'></i></a>

                 
                             
                                
                                </td>
                             
                                
                              </tr>";
                              // echo "<input name='course' value=".$rows['course']." type='hidden' class='form-control form-control-sm'>";
                              echo "<input name='admissionNo[]' value=".$sname." type='hidden' class='form-control form-control-sm'>";
                              // echo "<input name='course' value=".$rows['course']." type='hidden' class='form-control form-control-sm'>";
                             

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
                  <h5 style="text-align: center;"> Attendance Details </h5>
                  <hr>
              <?php
                  if(isset($_POST['view']))
                  {

                 
                    $type =  $_POST['type'];
                   
                    $_SESSION['type']= $_POST['type'];
                    
                 
                   
                     
                    
               
                    if($type=='1'){
                      
                      $sql="SELECT * FROM attendance  where  sub_id='$_SESSION[sub_id]' and st_status=1";
                      $sql1="SELECT * FROM attendance where sub_id='$_SESSION[sub_id]' and st_status=0";
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

                      $sql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status=1 and stat_date='$singleDate'";
                      $sql1="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status=0 and  stat_date='$singleDate'";

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



                      $sql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status=1 and attendance.stat_date between '$fromDate' and '$toDate'";
                      $sql1="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status=0 and attendance.stat_date between '$fromDate' and '$toDate'";

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
                
                  $sql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]'";
                  $sql1="SELECT * FROM attendance where sub_id='$_SESSION[sub_id]'and st_status='1' ";
                  $psql="SELECT * FROM attendance where sub_id='$_SESSION[sub_id]'and st_status='1' ";
                  $asql="SELECT * FROM attendance where sub_id='$_SESSION[sub_id]'and st_status='0' ";
              

                }
                if($t=='2')
                {
                  
                  $singleDate =  $_POST['singleDate'];
                  
                  $sql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]'  and stat_date='$singleDate'";
                  $sql1="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status='1' and  stat_date='$singleDate'";
                  $psql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status='1' and  stat_date='$singleDate'";
                  $asql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status='0' and  stat_date='$singleDate'";
                }
                if($t=='3')
                {
                  $fromDate =  $_POST['fromDate'];
                  $toDate =  $_POST['toDate'];
                  $_SESSION['fromDate']=$fromDate;
                  $_SESSION['toDate']= $toDate;
                  // echo $fromDate;

                        // SELECT * FROM attendance where course='OSI' and stat_date between '2022-12-01' and '2022-12-14';
                  $sql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and stat_date between '$fromDate' and '$toDate'";
                  $sql1="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status='1' and stat_date between '$fromDate' and '$toDate'";
                  $psql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status='1' and  stat_date between '$fromDate' and '$toDate'";
                  $asql="SELECT * FROM attendance where  sub_id='$_SESSION[sub_id]' and st_status='0' and stat_date between '$fromDate' and '$toDate'";
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
                  $percentage =number_format ((($rowcount1/$rowcount)*100));
                  ?>
                <br>
                <h6> Overall attendance percentage : <?php print($percentage); } }?>%</h6>
                
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