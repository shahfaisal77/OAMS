
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

<body  style="background-image: url('img/logo/homeBackground.jpg');  background-repeat: no-repeat;  background-position: center;  background-size:1400px 675px;" style="background-image: url('img/logo/loral1.jpe00g');">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <h5 align="center">ONLINE ATTENDANCE SYSTEM</h5>
                  <div class="text-center">
                    <img src="img/logo/homePageIcon.png" style="width:100px;height:100px">
                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4">Login Panel</h1>
                  </div>
                  <form class="user" method="Post" action="">
                  <div class="form-group">
                  <select required name="userType" class="form-control mb-3">
                          <option value="">--SELECT USER MODE--</option>
                          <option value="Administrator">Administrator</option>
                          <option value="Teacher">Teacher</option>
                          <option value="Student">Student</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Enter Your User Name">
                    </div>
                    <div class="form-group">
                      <input type="password" name = "password" required class="form-control" id="exampleInputPassword" placeholder="Enter Your Password" >
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div> -->
                    <div class="form-group">
                        <input type="submit"  class="btn btn-success btn-block" value="Login" name="login" />
                    </div>
                     </form>

<?php

  if(isset($_POST['login'])){

    $userType = $_POST['userType'];
    // $username = $_POST['username'];
    // $password = $_POST['password'];
    // $password = mysqli_real_escape_string($conn, $_POST["password"]);  
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
      $password=md5($password); // Encrypted Password
   
   
    if($userType == "Administrator"){

      $query = "SELECT * FROM admininfo WHERE username = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['userId'] = $rows['id'];
        $_SESSION['firstName'] = $rows['fname'];
        $_SESSION['lastName'] = $rows['lname'];
        $_SESSION['emailAddress'] = $rows['email'];

        echo "<script type = \"text/javascript\">
        window.location = (\"Admin/index.php\")
        </script>";
      }

      else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

      }
    }
    else if($userType == "Teacher"){

      $query = "SELECT * FROM teachers WHERE username = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){
        $tc = $rows['tc_id'];

      $query1 = "SELECT * FROM subject WHERE tc_id='$tc'";
      $rs1 = $conn->query($query);
      $num1 = $rs->num_rows;
      $rows1 = $rs->fetch_assoc();

        $_SESSION['userId'] = $rows['tc_id'];
        $_SESSION['firstName'] = $rows['tc_name'];
        $_SESSION['lastName'] = $rows['lname'];
        $_SESSION['emailAddress'] = $rows['tc_email'];
        $_SESSION['classId'] = $rows1['sub_id'];
        // $_SESSION['classArmId'] = $rows['classArmId'];

        echo "<script type = \"text/javascript\">
        window.location = (\"ClassTeacher/index.php\")
        </script>";
      }
    }
    
    else if($userType == "Student"){

      $query = "SELECT * FROM students WHERE username = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){
        $st= $rows['st_id'];

        $query1 = "SELECT * FROM st_sub WHERE sub_id='$st'";
        $rs1 = $conn->query($query);
        $num1 = $rs->num_rows;
        $rows1 = $rs->fetch_assoc();

        $_SESSION['userId'] = $rows['st_id'];
        $_SESSION['firstName'] = $rows['st_name'];
        // $_SESSION['lastName'] = $rows['tc_dept'];
        $_SESSION['emailAddress'] = $rows['st_email'];
        $_SESSION['classId'] = $rows1['sub_id'];
        // $_SESSION['classArmId'] = $rows['classArmId'];

        echo "<script type = \"text/javascript\">
        window.location = (\"student/index.php\")
        </script>";
      }

    else{

      echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";

    }
  }
    
    else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

    }
}
?>


                <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="student_signup.php">Sign Up!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <!-- <a class="font-weight-bold small" href=".php">Cooperative Account!</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                    <a class="font-weight-bold small" href="forgotPassword.php">Forgot Password?</a> 

                  </div>
                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->

                
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