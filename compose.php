<?php
session_start();
include('includes/dbconnection.php');
if(strlen($_SESSION['uid']==0)){
  header('location:logout.php');
}
else {
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Compose</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

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
          <li class="breadcrumb-item active">Compose</li>
        </ol>

        <!-- Page Content -->
        <div class="card mb-3">
          <div class="card-header">
            <section class="mb-4">
              <div class="row">
                <div class="col-md-12 mb-md-0 mb-5">
                  <form id="mail" name="mail" action="mail.php" method="POST">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                          <div class="form-label-group">
                            <input type="email" name="from" id="mailFrom" class="form-control" placeholder="From" required="required">
                            <label for="mailFrom">From</label>
                          </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                          <div class="form-label-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required">
                            <label for="password">Password</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 mb-3">To</div>
                      <div class="col-md-10 mb-3">
                        <input type="email" name="to" id="mailTo" class="form-control" placeholder="To" required="required">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 mb-3">Subject</div>
                      <div class="col-md-10 mb-3">
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required="required">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 mb-3">Content</div>
                      <div class="col-md-10 mb-3">
                        <textarea type="text" id="message" name="message" rows="5" class="form-control md-textarea"></textarea>
                      </div>
                    </div>
                  </form>
                  <div class="text-center text-md-left">
                    <div class="row">
                      <div class="col-md-2 mb-3" style="margin-left: 13px"></div>
                      <input type="submit" name="submit" value="Send" class="btn btn-primary btn-user" onclick="document.getElementById('mail').submit();">
                    </div>
                  </div>
                  <div class="status"></div>
                </div>
              </div>
            </section>
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