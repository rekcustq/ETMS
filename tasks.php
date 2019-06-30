<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
} else {

  if(isset($_POST['submit'])) {
    $eid=$_SESSION['uid'];
    $emp1name=$_POST['emp1name'];
    
     $query=mysqli_query($con, "insert into empexpireince (EmpID,Employer1Name) value('$eid','$emp1name')");
    if ($query) {
      $msg="Your Expirence data has been submitted succeesfully.";
    } else {
      $msg="Something Went Wrong. Please try again.";
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

  <title>Tasks</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Tasks</li>
        </ol>

        <!-- Create new task-->
        <div class="card mb-3 task-form" hidden>
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tasks Form
          </div>
          <div class="card-body">
            <form method="post" action="">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="title" name="title" id="inputTitle" class="form-control" placeholder="Title" autofocus="autofocus">
                  <label for="inputTitle">Title</label>
                </div>
              </div>  
              <br>
              <div class="form-group">                  
                <label for="inputDescription"><b>Description</b></label>
                  <br>
                  <textarea id="inputDescription" class="form-control" required="required" cols="10" rows="10"></textarea>
              </div>
              <br>
              <div class="employees-input">
                <label for=""><b> Employee ID </b></label>
                <div class="employee-template input-group" hidden>
                  <input type="empid" name="empid" id="inputEmployee" class="col-3 form-control" style="margin-bottom:10px;" placeholder="Employee ID" autofocus="autofocus">
                  <span class="input-group-btn" style="margin-left:10px">
                      <button class="btn btn-danger btn-block remove-employee-btn" onclick="remove_employee(this)" name="remove">
                        <i class="far fa-trash-alt"></i>
                      </button>
                  </span>
                </div>
                <div class="input-group" >
                  <input type="empid" name="empid" id="inputEmployee" class="col-3 form-control" style="margin-bottom:10px;" placeholder="Employee ID"  autofocus="autofocus">
                </div>
              </div>
              <input type="button" class="add-staff-btn col-12 col-md-2 col-lg-2 btn btn-primary btn-block" value="Add Staff">
              <br>  
              <input type="submit" class="col-3 btn btn-success btn-block" name="submit" value="Create Tasks">
            </form>
          </div>
        </div>
        <!-- Area Chart Example-->
        <div class="add-task-btn col-12 col-md-3 col-lg-3 btn btn-success btn-block"> Add Task </div>
        <div class="cancel-task-btn col-12 col-md-3 col-lg-3 btn btn-danger btn-block" hidden=""> Cancel </div>

        <div></div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright by ©rekcusTQ</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
<?php } ?>