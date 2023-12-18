
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
  $id=$_POST['id'];
  $firstName=$_POST['firstName'];
  $lName=$_POST['lastName'];
  $dept=$_POST['tc_dept'];
  $emailAddress=$_POST['tc_email'];

  $phoneNo=$_POST['tc_phone'];
  $course=$_POST['classId'];
  $username=$_POST['username'];
  $password=$_POST['password'];
  $password=md5($password);
  

   
    $query=mysqli_query($conn,"select * from teachers where tc_name ='$firstName' and tc_email ='$emailAddress'");
    $ret=mysqli_fetch_array($query);



    if($ret > 0){ 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>User Already Exists!</div>";
        
    }
    else{

      $query=mysqli_query($conn,"INSERT into teachers(tc_name,tc_lname,tc_dept,tc_email,tc_phone,username,password)
      VALUES('$firstName','$lName','$dept','$emailAddress','$phoneNo','$username','$password')")or die("Not inserted");
      // $query1=mysqli_query($conn,"insert into subject(subject_name,tc_id) value('$course','$tc_id')") or die("Not inserted2");
    // $sq="insert into teachers (tc_name,tc_dept,tc_email,tc_course,username,password,tc_phone)values('$firstName','$dept','$emailAddress','$course','$username','$password','$phoneNo')";
    // $result=mysqli_query($conn,$sq) or die("not inser");


    if ($query==true ) {
        
      $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";

        // $qu=mysqli_query($conn,"update tblclassarms set isAssigned='1' where Id ='$classArmId'");
        //     if ($qu) {
                
        //         $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
        //     }
        //     else
        //     {
        //         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        //     }
    }
    else
    {
         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
    }
  }
}

//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

 if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id= $_GET['Id'];

        $query=mysqli_query($conn,"select * from teachers where tc_id ='$Id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
          $firstName=$_POST['firstName'];
          $lName=$_POST['lastName'];
          $dept=$_POST['tc_dept'];
          $emailAddress=$_POST['tc_email'];
        
          $phoneNo=$_POST['tc_phone'];
          $course=$_POST['classId'];
          echo $course; 
          $username=$_POST['username'];
          $password=$_POST['password'];
          $password=md5($password);
       
            $query=mysqli_query($conn,"update teachers set tc_name='$firstName',tc_lname='$lName', tc_dept='$dept',
            tc_email='$emailAddress', password='$password',tc_phone='$phoneNo', username='$username' where tc_id='$Id'")or die("not");
            if ($query =true) {
              echo "<script>
              alert('Data Updated Successfully');
            </script>";
                echo "<script type = \"text/javascript\">
                window.location = (\"createClassTeacher.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

  // if (isset($_GET['Id']) && isset($_GET['classArmId']) && isset($_GET['action']) && $_GET['action'] == "delete")
  
  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];
        

        $query = mysqli_query($conn,"DELETE FROM teachers WHERE tc_id='$Id'");

        if ($query == TRUE) {
          echo "<script>
          alert('Data Deleted Successfully');
        </script>";
          echo $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";

          sleep(1);
          echo "<script type = \"text/javascript\">
                window.location = (\"createClassTeacher.php\")
                </script>"; 

          
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
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
            <h1 class="h3 mb-0 text-gray-800">Teacher</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Teacher</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->


              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Register Teacher</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                   <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">First Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="firstName" value="<?php echo $row['tc_name'];?>" id="exampleInputFirstName" pattern="[A-Za-z\s]{1,20}" title="Character Only i.e Suhail">
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Last Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="lastName" value="<?php echo $row['tc_lname'];?>" id="exampleInputFirstName" pattern="[A-Za-z\s]{1,20}" title="Character Only i.e Suhail">
                        </div>
                        
                         

                        <!-- from here -->
                        <!-- <div class="col-xl-6"> -->
                        <!-- <label class="form-control-label">Department<span class="text-danger ml-2">*</span></label> -->
                        <!-- <input type="text" class="form-control" required name="tc_dept" value="<?php echo $row['tc_dept'];?>" id="exampleInputFirstName" pattern="[A-Z]{1,20}" title="Character Only in Capital Letter i.e. CS"> -->
                        <!-- </div> -->
                        <!-- till here -->
                     <!-- add drop list -->
                        <div class="col-xl-6">
    <label class="form-control-label">Department<span class="text-danger ml-2">*</span></label>
    <select class="form-control" required name="st_dept" id="exampleInputFirstName">
        <option value="CS" <?php if ($row['tc_dept'] == 'CS') echo 'selected'; ?>>CS</option>
        <option value="CA" <?php if ($row['tc_dept'] == 'CA') echo 'selected'; ?>>CA</option>
        <option value="DS" <?php if ($row['tc_dept'] == 'DS') echo 'selected'; ?>>DS</option>
    </select>
</div>









                    
                    <!-- <div class="col-xl-6">
                        <label class="form-control-label">Select Department<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM subject ORDER BY dept ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="dept" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Department--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['sub_id'].'" >'.$rows['dept'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>  
                        </div> -->

                    <!-- <div class="col-xl-6">
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM subject ORDER BY subject_name ASC";
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
                        </div> -->
                        <div class="col-xl-6">
                        <label class="form-control-label">Email<span class="text-danger ml-2">*</span></label>
                        <input type="email" class="form-control" required name="tc_email" value="<?php echo $row['tc_email'];?>" id="exampleInputFirstName" >
                        </div>
                    
                        <div class="col-xl-6">
                        <label class="form-control-label">Contact No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="tc_phone" value="<?php echo $row['tc_phone'];?>" id="exampleInputFirstName" pattern="[+0-9-\s]{10,15}" title="Numeric Only Mot Less than 10 i.e '+91-**********','0091 ***********'">
                        </div>
                       
                   
                      
                       
                        <div class="col-xl-6">
                        <label class="form-control-label">Username<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="username" value="<?php echo $row['username'];?>" id="exampleInputFirstName" pattern="[A-Za-z0-9]{1,20}" title="Character Only i.e Suhail" >
                        </div>
                    
                     
                        <div class="col-xl-6">
                        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
                        <input type="password" class="form-control" required name="password" value="<?php echo $row['password'];?>" id="exampleInputFirstName" pattern="(?=.*\d)(?=.*[a-z])([A-Z])(?=.*[!._@]).{8,32}" title="Must contain at least one  number and one uppercase and lowercase letter at least one Special character '@._' , and at least 8 or 32 characters" >
                        </div>
                        
                       
                    </div>
                    <!-- <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM tblclass ORDER BY className ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="classId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['className'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Class Arm<span class="text-danger ml-2">*</span></label>
                            <?php
                                echo"<div id='txtHint'></div>";
                            ?>
                        </div>
                    </div> -->
                      <?php
                    if (isset($Id))
                    {
                    ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    } else {           
                    ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php
                    }         
                    ?>
                  </form>
                </div>
              </div>

              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Teachers</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                       
                        <th>Email Address</th>
                        <th>Contact No</th>
                        <th>Dept</th>
                       
                        <th>Username</th>
                       
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                      // $query = "SELECT tblclassteacher.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblclassteacher.firstName,
                      // tblclassteacher.tc_dept,tblclassteacher.emailAddress,tblclassteacher.phoneNo,tblclassteacher.dateCreated
                      // FROM tblclassteacher
                      // INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
                      // INNER JOIN tblclassarms ON tblclassarms.Id = tblclassteacher.classArmId";
                      // $query = $query = "SELECT * from teachers inner join subject on subject.tc_id = teachers.tc_id";
                      $query = $query = "SELECT * from teachers";
                      // ,class where teacher.tc_course=class.class_id ORDER BY tc_id asc";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            // echo"
                            //   // <tr>
                            //   //   <td>".$sn."</td>
                            //   //   <td>".$rows['firstName']."</td>
                            //   //   <td>".$rows['tc_dept']."</td>
                            //   //   <td>".$rows['emailAddress']."</td>
                            //   //   <td>".$rows['phoneNo']."</td>
                            //   //   <td>".$rows['className']."</td>
                            //   //   <td>".$rows['classArmName']."</td>
                            //   //    <td>".$rows['dateCreated']."</td>
                            //   //   <td><a href='?action=delete&Id=".$rows['Id']."&classArmId=".$rows['classArmId']."'><i class='fas fa-fw fa-trash'></i></a></td>
                            //   // </tr>";
                          //   echo "
                          //   <tr>
                          //   <td>".$sn."</td>
                          //   <td>".$rows['tc_name']."</td>
                          //   <td>".$rows['tc_lname']."</td>
                          //   <td>".$rows['tc_email']."</td>
                          //   <td>".$rows['tc_phone']."</td>
                          //   <td>".$rows['tc_dept']."</td>
                          //   <td>".$rows['subject_name']."</td>
                          //   <td>".$rows['username']."</td>
                          //   <td>".$rows['password']."</td>
                          //     <td><a href='?action=edit&Id=".$rows['tc_id']."'><i class='fas fa-fw fa-edit'></i>Edit</a></td>
                           
                          //     <td><a href='?action=delete&Id=".$rows['tc_id']."&classArmId=".$rows['classArmId']."'><i class='fas fa-fw fa-trash'></i></a></td>
                          // </tr>";

                          echo "
                                <tr>
                                <td>".$sn."</td>
                                <td>".$rows['tc_name']."</td>
                                <td>".$rows['tc_lname']."</td>
                                <td>".$rows['tc_email']."</td>
                                <td>".$rows['tc_phone']."</td>
                                <td>".$rows['tc_dept']."</td>
                                
                                <td>".$rows['username']."</td>
                               
                                  <td><a href='?action=edit&Id=".$rows['tc_id']."'><i class='fas fa-fw fa-edit'></i>Edit</a></td>
                               
                                  <td><a href='?action=delete&Id=".$rows['tc_id']."&classArmId=".$rows['classArmId']."'><i class='fas fa-fw fa-trash'></i></a></td>
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