
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';



   

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
  <title>Online Attendance System</title>
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
            <h1 class="h3 mb-0 text-gray-800">Subjects</h1>
            <ol class="breadcrumb" style="
    margin-bottom: 0px;
">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Subject</li>
            </ol>
          </div>

          
            <div class="col-lg-12" >
             

              <!-- Input Group -->
        <form method="post">
            <div class="row"  >
              <div class="col-lg-12">
              <div class="card mb-4">
               
                
              
                        
                       
                  
                
                <div class="table-responsive p-3">
                <?php echo $statusMsg; ?>
                 
                  <table class="table align-items-center table-flush table-hover ">
                    <thead class="thead-light">

                      
                      <tr>
                       
                        <th>#</th>
                        <th>Subject</th>
                     
                        
                        
                      </tr>
                    </thead>
                    
                    <tbody>

                  <?php
                    
                    

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
                      
                        
                        // if($dateTaken > $todaysDate1)
                        // {
                        //     echo "<script>
                        //         alert('Future Date is selected!');
                        //         </script>";
                        // }
                        // elseif($dateTaken < $todaysDate1){
                        //     echo "<script>
                        //     alert('Past Date is selected!');
                        //     </script>";
                        // }
                      
                        ?>
                          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Allotted Subjects </h6>
                        
                       
                        </div> 
                <?php
                       
                        //   $query = "SELECT * FROM `students` where st_id in(SELECT st_id from st_sub where st_sub.sub_id in(SELECT sub_id from subject WHERE sub_id='$course'))";
                        //   $query = "SELECT * FROM subject inner join teachers on teachers.tc_id = subject.tc_id inner join st_sub on st_sub.sub_id = subject.sub_id and st_id='$_SESSION[userId]'";
                        //   $query = "SELECT sub_id FROM subject where sub_id not IN(SELECT sub_id from st_sub where st_id='$_SESSION[userId]')";
                          $query = "SELECT * FROM subject,teachers where sub_id not IN(SELECT sub_id from st_sub where st_id='$_SESSION[userId]') and subject.tc_id=teachers.tc_id";
                          $query = "SELECT * FROM subject where tc_id='$_SESSION[userId]'";
  
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
                                
                                <td>".$rows['subject_name']."</td>";
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