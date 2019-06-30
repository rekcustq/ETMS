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

  <title>Inbox</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/inbox.css" rel="stylesheet">  

    <style>
    .collapsible {
      color: white;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
    }

    .collapsible:hover {
      background-color: #d0e2e2;
      -o-transition:color .2s ease-out, background .5s ease-in;
      -ms-transition:color .2s ease-out, background .5s ease-in;
      -moz-transition:color .2s ease-out, background .5s ease-in;
      -webkit-transition:color .2s ease-out, background .5s ease-in;
      /* ...and now override with proper CSS property */
      transition:color .2s ease-out, background .5s ease-in;    
    }

    .content {
      padding: 0 18px;
      display: none;
      background-position: center;
      background-size:  80% 100%;
      background-color: #f1f1f1;
    }
    </style>

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
          <li class="breadcrumb-item active">Inbox</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
            <?php
            /* connect to gmail */
            $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';

            /*$username = 'davidwalshblog@gmail.com';
            $password = 'davidwalsh';
            /*/
            $username = 'tacc31337@gmail.com';
            $password = 'Hades123';
            /*/

            /* try to connect */
            $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

            /* grab emails */
            $emails = imap_search($inbox,'ALL');

            /* if emails are returned, cycle through each... */
            if($emails) {
                
                /* begin output var */
                
                /* put the newest emails on top */
                rsort($emails);
                
                /* for every email... */
                foreach($emails as $email_number) {
                $output = '';
                    
                    /* get information specific to this email */
                    $overview = imap_fetch_overview($inbox,$email_number,0);
                    $message = imap_fetchbody($inbox,$email_number,2);
                    
                    /* output the email header information */
                    $output.= '<div class="collapsible">';
                    $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
                    $output.= '<td class="subject">'.$overview[0]->subject.'</td> ';
                    $output.= '<td class="from">'.$overview[0]->from.'</td>';
                    $output.= '<td class="date">on '.$overview[0]->date.'</td>';
                    $output.= '</div>';
                    $output.= '</div>';
                    
                    /* output the email body */
                    $output.= '<div class="content"><div class="body">'.$message.'</div></div>';
                echo $output;
                }
                
            } 

            /* close the connection */
            imap_close($inbox);
            ?>
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

  <!-- Collapse box-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
  var coll = document.getElementsByClassName("collapsible");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="mootools-core.js"></script>

</body>

</html>
<?php } ?>