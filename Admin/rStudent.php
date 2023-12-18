
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
 
  $rollno=$_POST['rollno'];
  $firstName=$_POST['firstName'];
  $dept=$_POST['st_dept'];
  $sem=$_POST['st_sem'];
  $emailAddress=$_POST['st_email'];

  $phoneNo=$_POST['st_phone'];
  $batch=$_POST['st_batch'];
  $username=$_POST['username'];
  $password=$_POST['password'];



   
    $query=mysqli_query($conn,"select * from students where st_id ='$rollno'");
    $ret=mysqli_fetch_array($query);



    if($ret > 0){ 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Roll No Already Exists!</div>";
        
    }
    else{

    $query=mysqli_query($conn,"INSERT into students(st_id,st_name,st_dept,st_email,st_phone,st_sem,username,password)
                                 VALUES('$rollno','$firstName','$dept','$emailAddress','$phoneNo','$sem','$username','$password')")or die("Not inserted");
    


    if ($query==true) {
        
      $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";

       
    }
    else
    {
         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
    }
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
<?php include 'includes/title.php';?>
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
        xmlhttp.open("GET","ajaxClassArms.php?cid="+str,true);
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
        <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Teachers</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create Class Teachers</li>
            </ol>
          </div> -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Register New Student</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Student Registration Form</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->


              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Student Registration Form</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                   <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Roll No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="rollno" value="<?php echo $row['st_id'];?>" id="exampleInputFirstName" pattern="[0-9]{1,6}" title="Numeric Only i.e 226263">
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Full Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="firstName" value="<?php echo $row['st_name'];?>" id="exampleInputFirstName" pattern="[A-Za-z\s]{1,20}" title="Character Only i.e Suhail">
                        </div>
                        
                    </div>
                    
                    <div class="form-group row mb-3">
                      <div class="col-xl-6">
                        <label class="form-control-label">Department<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_dept" value="<?php echo $row['st_dept'];?>" id="exampleInputFirstName"  pattern="[A-Z]{1,20}" title="Character Only in Capital Letter i.e. CS">
                        </div>
                        <!-- <div class="col-xl-6"> -->
                        <!-- <label class="form-control-label">Batch<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_batch" value="<?php echo $row['st_batch'];?>" id="exampleInputFirstName">
                        </div> -->
                        
                   
                        
                    <div class="col-xl-6">
                        <label class="form-control-label">Semester<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_sem" value="<?php echo $row['st_sem'];?>" id="exampleInputFirstName"  pattern="[0-9]{1}" title="Numeric, Only one digit i.e '1'">
                        </div>

                        <div class="col-xl-6">
                        <label class="form-control-label">Email<span class="text-danger ml-2">*</span></label>
                        <input type="email" class="form-control" required name="st_email" value="<?php echo $row['st_email'];?>" id="exampleInputFirstName">
                        </div>
                   

                     <div class="col-xl-6">
                        <label class="form-control-label">Contact No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_phone" value="<?php echo $row['st_phone'];?>" id="exampleInputFirstName" pattern="[+0-9-\s]{10,15}" title="Numeric Only Mot Less than 10 i.e '+91-**********','0091 ***********'">
                        </div>
                        

                      <div class="col-xl-6">
                        <label class="form-control-label">Username<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="username" value="<?php echo $row['username'];?>" id="exampleInputFirstName" pattern="[A-Za-z]{1,20}" title="Character Only i.e Suhail" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="password" value="<?php echo $row['password'];?>" id="exampleInputFirstName"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!._@]).{8,16}" title="Must contain at least one  number and one uppercase and lowercase letter at least one Special character '@._' , and at least 8 or 16 characters" 
>
                        </div>
                       
                    </div>
                    
                  
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    
                  </form>
                </div>
              </div>

             

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