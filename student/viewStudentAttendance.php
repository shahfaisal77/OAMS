
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
            <h1 class="h3 mb-0 text-gray-800">View Student Attendance</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Student Attendance</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">View Student Attendance</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group row mb-3">
                      
                        <div class="col-xl-6">
                        <label class="form-control-label" >Roll No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="roll" value="<?php echo $_SESSION['userId'];?>" id="exampleInputFirstName" readonly>
                        
                        </div>

                        <div class="col-xl-6">
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
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
                        <div class="col-xl-6">
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
                        echo"<div id='txtHint'></div>";3
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
                  <h6 class="m-0 font-weight-bold text-primary">Attendance Details</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>

                        
                        <th>#</th>
                        <th>Roll No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Subject</th>
                    
                        <th>Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php

                    if(isset($_POST['view'])){

                       $admissionNumber =  $_POST['roll'];
                       $type =  $_POST['type'];
                       $_SESSION['type']= $_POST['type'];
                      
                       $course=$_POST['classId'];
                       $_SESSION['sub_id']=$course;


                       $q="select subject_name from subject where sub_id='$course'";
                       $re = mysqli_query($conn,$q);
                       while ($row = mysqli_fetch_assoc($re)) {
                        
                         $sname= $row["subject_name"];
                     }


                       if($type == "1"){ //All Attendance
                        ?>
                    
                        <?php
                      
                        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where students.st_id='$admissionNumber' and  
                        attendance.sub_id='$course' order by stat_date asc";

                        

                       }
                       if($type == "2"){ //Single Date Attendance

                        $singleDate =  $_POST['singleDate'];

                       
                        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where students.st_id='$admissionNumber' and attendance.stat_date='$singleDate' and sub_id='$course'";
                        

                       }
                       if($type == "3"){ //Date Range Attendance

                         $fromDate =  $_POST['fromDate'];
                         $toDate =  $_POST['toDate'];
                         $_SESSION['fromDate']=$fromDate;
                         $_SESSION['toDate']= $toDate;


                        $query = "SELECT * from students inner JOIN attendance on attendance.st_id=students.st_id where 
                        students.st_id='$admissionNumber' and sub_id='$course' and attendance.stat_date between '$fromDate' and '$toDate'";
                        
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
                                <td>".$rows['st_lname']."</td>
                                <td>".$rows['st_dept']."</td>
                                <td>".$sname."</td>
                                
                               
                                <td style='background-color:".$colour."'>".$status."</td>
                                <td>".$rows['stat_date']."</td>
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

                    $admissionNumber =  $_POST['roll'];
                    
                    $type =  $_POST['type'];
                    $_SESSION['type']= $_POST['type'];
                    
               
                    if($type=='1'){
                      $sql="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=1 and sub_id= '$_SESSION[sub_id]'";
                      $sql1="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=0 and sub_id= '$_SESSION[sub_id]'";
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

                      $sql="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=1 and stat_date='$singleDate' and sub_id= '$_SESSION[sub_id]'";
                      $sql1="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=0 and  stat_date='$singleDate' and sub_id= '$_SESSION[sub_id]'";

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



                      $sql="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=1 and sub_id= '$_SESSION[sub_id]' and attendance.stat_date between '$fromDate' and '$toDate'";
                      $sql1="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=0 and sub_id= '$_SESSION[sub_id]' and attendance.stat_date between '$fromDate' and '$toDate'";

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
                $sql="SELECT * FROM attendance where st_id='$admissionNumber' and sub_id= '$_SESSION[sub_id]'";
                  $sql1="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=1 and sub_id= '$_SESSION[sub_id]'";
                  
                  if ($result=mysqli_query($conn,$sql))
                {
                  $rowcount=mysqli_num_rows($result);
                if ($result1=mysqli_query($conn,$sql1))
                {
                  $rowcount1=mysqli_num_rows($result1);
                  $percentage = number_format ((($rowcount1/$rowcount)*100),1);
                  ?>
                <br>
                <h6> Overall attendance percentage : <?php print($percentage); } }?> %</h6>
                <?php
                // $sql="SELECT * FROM attendance where email='$email' and attendance='present'";
                $sql="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=1 and sub_id= '$_SESSION[sub_id]'";

                  if ($result=mysqli_query($conn,$sql))
                {
                  $rowcount=mysqli_num_rows($result);
                  ?>
                <h6> Total Presents : <?php print($rowcount); }?> </h6>
                <?php
                // $sql="SELECT * FROM attendance where email='$email' and attendance='absent'";
                $sql="SELECT * FROM attendance where st_id='$admissionNumber' and st_status=0 and sub_id= '$_SESSION[sub_id]'";

                  if ($result=mysqli_query($conn,$sql))
                {
                  $rowcount=mysqli_num_rows($result);
                  ?>
                <h6> Total Absents : <?php print($rowcount); }?> </h6>
                
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