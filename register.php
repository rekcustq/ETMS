<?php
include('includes/dbconnection.php');
error_reporting(0);
if(isset($_POST['submit'])) {
  $Name=$_POST['Name'];
  $Gender=$_POST['Gender'];
  $Position=$_POST['Position'];
  $Email=$_POST['Email'];
  $Password=$_POST['Password'];
  //$RPassword=$_POST['RepeatPassword'];
  $ret=mysqli_query($con, "select empEmail from employees where empEmail='$Email'");
  $result=mysqli_fetch_array($ret);
  if($result>0) {
    $msg="This email already associated with another account".$Email."!";
  } else {
    $query=mysqli_query($con, "insert into employees(empName, empGender, empPosition, empEmail,  empPassword) values('$Name', '$Gender', '$Position', '$Email', '$Password' )");
    if ($query) {
      $msg="You have successfully registered";
    } else {
      $msg="Something Went Wrong. Please try again";
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

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <script type="text/javascript">
  function checkpass() {
    if (document.register.Password.value != document.register.RepeatPassword.value) {
      alert('New Password and Confirm Password field does not match');
      document.register.RepeatPassword();
      return false;
    }
    return true;
  }
  </script>

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <p style="font-size:16px; color:red" align="center"> 
          <?php if($msg) {
            echo $msg;
          } ?> 
        </p>
        <form action="register.php" method="post" onsubmit="return checkpass();">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="Name" id="Name" class="form-control" placeholder="Name" required="required" autofocus="autofocus">
                  <label for="Name">Name</label>
                </div>
              </div>
              <div class="col-md-3" style="margin-left: 22px">
                <div class="form-label-group">
                  <label class="radio-inline">
                    <input type="radio" name="Gender" value="Male" />Male
                  </label>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                  <label class="radio-inline">
                    <input type="radio" name="Gender" value="Female" />Female
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="position" name="Position" id="inputPosition" class="form-control" placeholder="Position" required="required">
              <label for="inputPosition">Position</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="Password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <input class="btn btn-primary btn-block" type="submit" name="submit" value="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Already have an account? Login!</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
