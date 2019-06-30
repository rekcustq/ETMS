<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['uid']==0)){
  header('location:logout.php');
} else {
  $taskId=$_GET['editid'];
  if(isset($_POST['submit_smtask'])) {
    $smTaskTitle=$_POST['taskTitle'];
    $smTaskContent=$_POST['taskContent'];
    $status=$_POST['status'];
    $query=mysqli_query($con, "insert into smallTasks (smTaskTitle, smTaskContent) values ('$smTaskTitle', '$smTaskContent') ");
    $smTskId=mysqli_fetch_array(mysqli_query($con,"select smTaskId from smallTasks where smTaskTitle='$smTaskTitle', smTaskContent='$smTaskContent' "));
    $smTaskId=$smTskId['smTaskId'];
    $query=mysqli_query($con, "insert into taskLink (taskId, smTaskId, status) values ('$taskId', '$smTaskId', '$status') ");
    if ($query) {
      $msg="Employee profile has been updated.";
    } else {
      $msg="Something Went Wrong. Please try again.";
    }
  }
  if(isset($_POST['submit_emp'])) {
    $empId=$_POST['empId'];
    $smTaskTitle=$_POST['taskTitle'];
    $smTaskContent=$_POST['taskContent'];
    $status=$_POST['status'];
    $query=mysqli_query($con, "insert into smallTasks (smTaskTitle, smTaskContent, status) values ('$smTaskTitle', '$smTaskContent', '$status') ");
    $smTskId=mysqli_fetch_array(mysqli_query($con,"select smTaskId from smallTasks where smTaskTitle='$smTaskTitle', smTaskContent='$smTaskContent' "));
    $smTaskId=$smTskId['smTaskId'];
    $query=mysqli_query($con, "insert into taskLink (taskId, smTaskId, status) values ('$taskId', '$smTaskId', '$status') ");
    if ($query) {
      $msg="Employee profile has been updated.";
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

  <title>Task Details</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php include_once('includes/header.php');?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once('includes/sidebar.php');?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="welcome.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Task Details</li>
        </ol>

        <!-- Page Content -->
        <div class="card mb-3">
          <div class="card-header">
            <?php
              $ret=mysqli_query($con,"select * from tasks where taskId='$taskId'");
              $row=mysqli_fetch_array($ret);
            ?>
            <div class="row">
              <div class="col-2 mb-3">Task name: </div>
              <div class="col-8 mb-3">
                <input type="text" name="taskTitle" class="form-control" required="required" value="<?php echo $row['taskTitle']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3">Task description: </div>
              <div class="col-8 mb-3">
                <input type="text" name="taskContent" class="form-control" required="required" value="<?php echo $row['taskContent']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3">Start time: </div>
              <div class="col-2 mb-3">
                <input type="text" name="startTime" class="form-control" required="required" value="<?php echo $row['taskStartTime']; ?>" readonly>
              </div>
              <div class="col-1 mb-3"></div>
              <div class="col-2 mb-3">Expired time: </div>
              <div class="col-2 mb-3">
                <input type="text" name="finishTime" class="form-control" required="required" value="<?php echo $row['taskFinishTime']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3">Task creator: </div>
              <div class="col-8 mb-3">
                <?php
                  $tmp=$row['taskCreator'];
                  $ret=mysqli_query($con,"select empName from employees where empId='$tmp'");
                  $row=mysqli_fetch_array($ret);
                ?>
                <input type="text" name="taskCreator" class="form-control" required="required" value="<?php echo $row['empName']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3">Task employees: </div>
              <div class="col-8 mb-3">
                <input type="text" name="taskCreator" class="form-control" required="required" value="<?php echo $row['empName']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3"></div>
              <div class="col-8 mb-3">
                <?php
                  $ret=mysqli_query($con,"select empName from employees, empTask where empTask.taskId='$taskId' group by employees.empId");
                  $row=mysqli_fetch_array($ret);
                ?>
                <input type="text" name="taskCreator" class="form-control" required="required" value="<?php echo $row['empName']; ?>" readonly>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p style="font-size:16px; color:green" align="center">
              <?php if($msg) {
                echo $msg;
              } ?>
            </p>

            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Task no.</th>
                    <th>Task Title</th>
                    <th>Task Content</th>
                    <th>Completed</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret=mysqli_query($con,"select * from taskLink, smallTasks where taskLink.tasksId='$taskId' group by smallTasks.smTaskId");
                  $cnt=1;
                  while ($row=mysqli_fetch_array($ret)) {
                  ?>
                    <tr>
                      <td><?php echo $cnt;?></td>
                      <td><?php echo $row['smTaskTitle'];?></td>
                      <td><?php echo $row['smTaskContent'];?></td>
                      <?php 
                        if($row['status']=="3") {
                      ?>
                      <td><input type="checkbox" checked></td>
                      <?php
                        } else {
                      ?>
                      <td><input type="checkbox"></td>
                      <?php } ?>
                    </tr>
                  <?php 
                  $cnt=$cnt+1;
                  } ?>
                </tbody>
              </table>
            </div>

          <!--
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
          -->
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php include_once('includes/footer.php');?>

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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

</body>

</html>
<?php } ?>