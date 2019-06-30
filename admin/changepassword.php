<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if(strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $adminid=$_SESSION['aid'];
    $cpassword=$_POST['currentpassword'];
    $newpassword=$_POST['newpassword'];
    $query=mysqli_query($con,"select id from admin where id='$adminid' and 	password='$cpassword'");
    $row=mysqli_fetch_array($query);
    if($row>0) {
      $ret=mysqli_query($con,"update admin set password='$newpassword' where id='$adminid'");
      $msg= "Your password successully changed"; 
    } else {
      $msg="Your current password is wrong";
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

  <title>Change Password</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.min.css" rel="stylesheet">

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

<body id="page-top">
  <?php include_once('includes/header.php')?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php')?>
  
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="welcome.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Change Password</li>
        </ol>

        <!-- Page Content -->
        <h1 class="h3 mb-4">Change Password</h1>
        <p style="font-size:16px; color: red" align="center"> 
          <?php if($msg) {
            echo $msg;
          } ?> 
        </p>

        <form action="changepassword.php" method="post" onsubmit="return checkpass();">
          <?php
            $cid=$_SESSION['aid'];
            $ret=mysqli_query($con,"select * from admin where id='$cid'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {
          ?>

          <div class="row">
            <div class="col-1 mb-3"></div>
            <div class="col-2 mb-3">Current Password</div>
            <div class="col-8 mb-3">   
              <input type="Password" class="form-control form-control-user" id="Password" name="currentpassword"  value="" required="true">
            </div>
          </div>  
          <div class="row">
            <div class="col-1 mb-3"></div>
            <div class="col-2 mb-3">New Password </div>
            <div class="col-8 mb-3">  
              <input type="Password" class="form-control form-control-user" id="newpassword" name="newpassword"  value="" required="true">
            </div>  
          </div>
          <div class="row">
            <div class="col-1 mb-3"></div>
            <div class="col-2 mb-3">Confirm Password </div>
            <div class="col-8 mb-3">
              <input type="Password" class="form-control form-control-user" id="confirmpassword" name="confirmpassword"  value="" required="true">
            </div>
          </div>
          <?php } ?>

          <div class="row" style="margin-top:4%">
            <div class="col-4"></div>
            <div class="col-4">
              <input type="submit" name="submit"  value="Change" class="btn btn-primary btn-user btn-block">
            </div>
          </div>
        
        </form>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once('includes/footer.php');?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

</body>

</html>
<?php } ?>
