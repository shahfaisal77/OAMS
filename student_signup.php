
<?php 
include 'Includes/dbcon.php';
session_start();
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
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <img src="img/logo/signUp.png" style="width:100px;height:100px">
                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4">Student Registration</h1>
                  </div>
                  <form method="post">
                  <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Roll No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="rollno" id="exampleInputFirstName" pattern="[0-9]{1,7}" title="Numeric Only i.e 226263">
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">First Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_name"  id="exampleInputFirstName" pattern="[A-Za-z\s]{1,20}" title="Character Only i.e Suhail">
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Last Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_lname"  id="exampleInputFirstName" pattern="[A-Za-z\s]{1,20}" title="Character Only i.e Suhail">
                        </div>
                        
                 
                      <div class="col-xl-6">
                        <label class="form-control-label">Department<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_dept"  id="exampleInputFirstName" pattern="[A-Z]{1,20}" title="Character Only in Capital Letter i.e. CS" >
                        </div>
                        
                        
                    <div class="col-xl-6">
                        <label class="form-control-label">Semester<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_sem" id="exampleInputFirstName"  pattern="[0-9]{1}" title="Numeric, Only one digit i.e '1'">
                        </div>

                        <div class="col-xl-6">
                        <label class="form-control-label">Email<span class="text-danger ml-2">*</span></label>
                        <input type="email" class="form-control" required name="st_email"  id="exampleInputFirstName">
                        </div>
                     

                     <div class="col-xl-6">
                        <label class="form-control-label">Contact No<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="st_phone"  id="exampleInputFirstName" pattern="[+0-9-\s]{10,15}" title="Numeric Only Not Less than 10 i.e '+91-**********','0091 ***********'">
                        </div>
                        

                      <div class="col-xl-6">
                        <label class="form-control-label">Username<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" required name="username"  id="exampleInputFirstName" pattern="[A-Za-z]{1,20}" title="Character Only i.e Suhail" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!._@]).{8,16}" title="Must contain at least one  number and one uppercase and lowercase letter at least one Special character '@._' , and at least 8 or 16 characters" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
                        <input type="password" class="form-control" required name="password"  id="exampleInputFirstName" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!._@]).{8,16}" title="Must contain at least one  number and one uppercase and lowercase letter at least one Special character '@._' , and at least 8 or 16 characters" >
                        </div>
                       
                    </div>
                    
                   
                  
                    <button type="submit" name="save" class="btn btn-primary">Sign Up!</button>
                   
                  </form>

<?php

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
    $rollno=$_POST['rollno'];
    $firstName=$_POST['st_name'];
    $LastName=$_POST['st_lname'];
    $dept=$_POST['st_dept'];
    $sem=$_POST['st_sem'];
    $emailAddress=$_POST['st_email'];
  
    $phoneNo=$_POST['st_phone'];
    // $course=$_POST['className'];

    // $username=$_POST['username'];
    // $password=$_POST['password'];

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $password=md5($password); // Encrypted Password
  
  
  
     
      $query=mysqli_query($conn,"select * from students where st_id ='$rollno'");
      $ret=mysqli_fetch_array($query);
  


    if($ret > 0){ 
      echo "<script >
      alert('User Already Exist!')
       </script>"; 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Email Address Already Exists!</div>";
        
    }
    else{

        $query=mysqli_query($conn,"INSERT into students(st_id,st_name,st_lname,st_dept,st_email,st_phone,st_sem,username,password)
        VALUES('$rollno','$firstName','$LastName','$dept','$emailAddress','$phoneNo','$sem','$username','$password')")or die("Not inserted");



    if ($query==true) {
    
      echo "<script >
      alert('User Created Successfuly !')
       </script>"; 
      $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
      echo "<script type = \"text/javascript\">
      window.location = (\"student_signup.php\")
      </script>"; 
     
        
    }
    else
    {
         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
         echo "<script>
      alert('An error Occurred!! Please Try Again');
    </script>";
    }
  }
}
?>

                
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="index.php">Already Have a Login!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <a class="font-weight-bold small" href=".php">Cooperative Account!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="font-weight-bold small" href="forgotPassword.php">Forgot Password?</a> -->

       
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>