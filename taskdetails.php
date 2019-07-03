<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['uid']==0)){
  header('location:logout.php');
} else {
  $taskId=$_GET['editid'];
  if(isset($_POST['submit_smtask'])) {
    $tskList=$_POST['checkList'];
    foreach ($tskList as $id) {
      echo $id.' ';
      $smTaskId=$id;
      $query=mysqli_query($con, "update taskLink set status=3-status where smTaskId='$smTaskId'");
      if (!$query) {
        $msg2="Something Went Wrong. Please try again.";
      }
    }
    if ($query)
      $msg2="Task details has been updated.";
  }
  if(isset($_POST['submit_emp'])) {
    $empList=$_POST['empList'];
    foreach ($empList as $empId) {
      $query=mysqli_query($con, "insert into empTask (empId, taskId) values ('$empId', '$taskId');");
      if (!$query) {
        $msg="Something Went Wrong. Please try again.";
      }
    }
    if ($query)
      $msg="Employee list has been updated.";
  }
  if(isset($_POST['removeStaff'])) {
    $no=$_POST['noET'];
    $query=mysqli_query($con, "delete from empTask where no=$no;");
    if ($query)
      $msg="Employee list has been updated.";
    else
      $msg="Something Went Wrong. Please try again.";
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
        <p style="font-size:16px; color:green" align="center"> 
          <?php if($msg) {
            echo $msg;
          } ?> 
        </p>
        <div class="card mb-3">
          <div class="card-header">
            <?php
              $ret=mysqli_query($con,"select * from tasks where taskId='$taskId'");
              $row=mysqli_fetch_array($ret);
            ?>
            <div class="row">
              <div class="col-2 mb-3"><b> Task name </b></div>
              <div class="col-8 mb-3">
                <input type="text" name="taskTitle" class="form-control" required="required" value="<?php echo $row['taskTitle']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3"><b> Task description </b></div>
              <div class="col-8 mb-3">
                <input type="text" name="taskContent" class="form-control" required="required" value="<?php echo $row['taskContent']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3"><b> Start time </b></div>
              <div class="col-2 mb-3">
                <input type="text" name="startTime" class="form-control" required="required" value="<?php echo $row['taskStartTime']; ?>" readonly>
              </div>
              <div class="col-1 mb-3"></div>
              <div class="col-2 mb-3"><b> Expired time </b></div>
              <div class="col-2 mb-3">
                <input type="text" name="finishTime" class="form-control" required="required" value="<?php echo $row['taskFinishTime']; ?>" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-2 mb-3"><b> Task creator </b></div>
              <div class="col-8 mb-3">
                <?php
                  $tmp=$row['taskCreator'];
                  $ret=mysqli_query($con,"select empName from employees where empId='$tmp'");
                  $row=mysqli_fetch_array($ret);
                ?>
                <input type="text" name="taskCreator" class="form-control" required="required" value="<?php echo $row['empName']; ?>" readonly>
              </div>
            </div>
            <!-- show and remove staff -->
            <div class="row">
              <div class="col-2 mb-3"><b> Task employees list </b></div>
            </div>
            <?php
              $ret=mysqli_query($con,"select no, empName from employees inner join emptask on emptask.empId=employees.empId where empTask.taskId='$taskId'");
              while ($row=mysqli_fetch_array($ret)) {
            ?>
            <form action="" method="post">
              <div class="row">
                <div class="col-2 mb-3"></div>
                <div class="input-group col-8 mb-3">
                  <input type="text" name="empName" class="form-control" required="required" value="<?php echo $row['empName']; ?>" readonly>
                  <input name="noET" value="<?php echo $row['no']; ?>" hidden>
                  <span class="input-group-btn" style="margin-left:10px">
                    <button type="submit" name="removeStaff" class="btn btn-danger">
                      <i class="far fa-trash-alt"></i>
                    </button>
                  </span>
                </div>
              </div>
            </form>
            <?php } ?>
            <!-- add staff -->
            <div class="row">
              <div class="col-2 mb-3"></div>
              <div class="col-8 mb-3">
                <form action="" method="post">
                  <div class="employees-input">
                    <div class="employee-template input-group" hidden>
                      <input type="empid" name="empList[]" id="empList" class="col-3 form-control" style="margin-bottom:10px;" placeholder="Employee ID" autofocus="autofocus">
                      <span class="input-group-btn" style="margin-left:10px">
                          <button class="btn btn-danger btn-block remove-employee-btn" onclick="remove_employee(this)" name="remove">
                            <i class="far fa-trash-alt"></i>
                          </button>
                      </span>
                    </div>
                    <div class="input-group" >
                      <input type="empid" name="empList[]" id="empList" class="col-3 form-control" style="margin-bottom:10px;" placeholder="Employee ID"  autofocus="autofocus">
                    </div>
                  </div>
                  <input type="button" class="add-staff-btn col-12 col-md-2 col-lg-2 btn btn-primary btn-block" value="Add Staff">
                  <div class="row" style="margin-top:2%">
                    <div class="col-4"></div>
                    <div class="col-4">
                      <input type="submit" name="submit_emp" value="Update staff" class="btn btn-primary btn-user btn-block">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- small task details -->
          <div class="card-body">
            <p style="font-size:16px; color:green" align="center">
              <?php if($msg) {
                echo $msg2;
              } ?>
            </p>

            <form method="post" action="">
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
                    $ret=mysqli_query($con,"select no, smTaskTitle, smTaskContent, taskLink.status from taskLink inner join smallTasks on taskLink.smTaskId=smallTasks.smTaskId where taskLink.tasksId='$taskId'");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)) {
                    ?>
                      <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php echo $row['smTaskTitle'];?></td>
                        <td><?php echo $row['smTaskContent'];?></td>
                        <td><input type="checkbox" name="checkList[]" value="<?php echo $row['no'];?>" <?php echo ($row['status']=='2')?"checked":"";?> ></td>
                      </tr>
                    <?php 
                    $cnt=$cnt+1;
                    } ?>
                  </tbody>
                </table>
              </div>
              <div class="row" style="margin-top:2%">
                <div class="col-4"></div>
                <div class="col-4">
                  <input type="submit" name="submit_smtask" value="Update" class="btn btn-primary btn-user btn-block">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer --
      <?php //include_once('includes/footer.php');?>-->

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