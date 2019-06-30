<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
} else {
  $uid=$_SESSION['uid'];
  if(isset($_POST['submit'])) {
    $taskTitle=$_POST['taskTitle'];
    $taskContent=$_POST['taskContent'];
    $startTime=$_POST['startTime'];
    $finishTime=$_POST['finishTime'];
    
    $query=mysqli_query($con, "insert into tasks(taskCreator, taskTitle, taskContent, taskStartTime, taskFinishTime, taskStatus) values('$uid', '$taskTitle', '$taskContent', '$startTime', '$finishTime', '1')");
    if ($query) {
      $msg="Task created succeesfully.";
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
  <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

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
          <li class="breadcrumb-item active">Tasks</li>
        </ol>

        <!-- Create new task-->
        <div class="card mb-3 task-form" hidden>
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tasks Form
          </div>
          <div class="card-body">
            <p style="font-size:16px; color:green" align="center"> 
              <?php if($msg) {
                echo $msg;
              } ?> 
            </p>
            <form action="tasks.php" method="post">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="title" name="taskTitle" id="inputTitle" class="form-control" placeholder="Title" autofocus="autofocus">
                  <label for="inputTitle">Title</label>
                </div>
              </div>  
              <br>
              <div class="form-group">                  
                <label for="inputDescription"><b>Description</b></label>
                <br>
                <textarea name="taskContent" id="inputDescription" class="form-control" required="required" cols="10" rows="10"></textarea>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="startTime"><b>Start date:</b></label>
                  <br><br>
                  <input type="datetime-local" name="startTime" class="col-3 form-control" style="margin-bottom:10px;" autofocus="autofocus">
                </div>
              </div>  
              <div class="form-group">
                <div class="form-label-group">
                  <label for="finishTime"><b>Expire date:</b></label>
                  <br><br>
                  <input type="datetime-local" name="finishTime" class="col-3 form-control" style="margin-bottom:10px;" autofocus="autofocus">
                </div>
              </div>  
              <br>
              <input type="submit" class="col-3 btn btn-success btn-block" name="submit" value="Create Tasks">
            </form>
          </div>
        </div>
        <!-- Area Chart Example-->
        <div class="add-task-btn col-12 col-md-3 col-lg-3 btn btn-success btn-block"> Add Task </div>
        <div class="cancel-task-btn col-12 col-md-3 col-lg-3 btn btn-danger btn-block" hidden=""> Cancel </div>
        <br>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All tasks
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Task no.</th>
                    <th>Task Title</th>
                    <th>Task Description</th>
                    <th>Start Time</th>
                    <th>Expire Time</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret=mysqli_query($con,"select * from tasks where taskCreator='$uid'");
                  $cnt=1;
                  while ($row=mysqli_fetch_array($ret)) {
                    $tStat=$row['taskStatus'];
                    $stat=mysqli_fetch_array(mysqli_query($con,"select statDescription from status where stat='$tStat'"));
                  ?>
                    <tr>
                      <td><?php echo $cnt;?></td>
                      <td><?php echo $row['taskTitle'];?></td>
                      <td><?php echo $row['taskContent'];?></td>
                      <td><?php echo $row['taskStartTime'];?></td>
                      <td><?php echo $row['taskFinishTime'];?></td>
                      <td><?php echo $stat['statDescription'];?></td>
                      <td><a href="taskdetails.php?editid=<?php echo $row['taskId'];?>">Task Details</a></td>
                    </tr>
                  <?php 
                  $cnt=$cnt+1;
                  } ?>
                </tbody>
              </table>
            </div>
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

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

  <script type="text/javascript">
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    $scope.open = function() {
      console.log('calling open');
      $timeout( function(){
        $scope.status.opened = true;
      }, 50);
    };
  </script>    

</body>

</html>
<?php } ?>