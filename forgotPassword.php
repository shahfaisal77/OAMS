
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
                    <img src="img/logo/forgotPassword.png" style="width:100px;height:100px">
                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
                  </div>
                  <form class="user" method="Post" action="">
                  <div class="form-group">
                      <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Enter User Name">
                    </div>
                    <div class="form-group">
                      <input type="email" name = "email" required class="form-control" id="exampleInputPassword" placeholder="Enter Email Address" >
                    </div>
                     
                    <div class="form-group">
                        <input type="submit"  class="btn btn-primary btn-block" value="Submit" name="submit" />
                    </div>
                    </form>

                    <?php

              if(isset($_POST['submit'])){
                  $username=$_POST['username'];
                  $email=$_POST['email'];
                
                $query = "SELECT * FROM students WHERE username = '$username' AND st_email = '$email'";
                $rs = $conn->query($query);
                $num = $rs->num_rows;
                $rows = $rs->fetch_assoc();
          
                if($num > 0){
          
                  echo "<div class='alert alert-success' role='alert'>
                  Request Issued. We will get Back to You !
                  </div>";
          
                  // echo "<script type = \"text/javascript\">
                  // window.location = (\"Admin/index.php\")
                  // </script>";
                }
          
                else{
          
                  echo "<div class='alert alert-danger' role='alert'>
                  Invalid Username or Email!
                  </div>";
          
                }
				}
			?>

                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  <hr>
                  <div class="text-center" style="margin-left: 20px;">
                    <a class="font-weight-bold small align-center" href="index.php">Bact to Sign In!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <a class="font-weight-bold small" href="organizationSetup.php">Setup Cooperative Account!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="font-weight-bold small" href="forgotPassword.php">Forgot Password?</a> -->

                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>