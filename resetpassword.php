<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(strlen($_SESSION['email'])==0) {
  header('location:login.php');
} else {
  if(isset($_POST['submit'])) {
    $Email=$_SESSION['email'];
    $Password=$_POST['newPassword'];
    $query=mysqli_query($con,"update employees set empPassword='$Password' where empEmail='$Email' ");
   if($query) {
    echo "<script>alert('Password successfully changed');</script>";
    session_destroy();
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

  <title>Forgot Password</title>

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
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will instruct you on how to reset your password.</p>
        </div>
          <p style="font-size:16px; color:red"> 
            <?php if($msg){
              echo $msg;
            } ?> 
          </p>
        <form action="" method="post" onsubmit="return checkpass();">
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Password" required="required">
              <label for="newPassword">New Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
              <label for="confirmPassword">Confirm password</label>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="submit" value="Reset">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="login.php">Login Page</a>
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
<?php } ?>