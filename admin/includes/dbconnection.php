<?php

$con = mysqli_connect("Localhost", "root", "", "ETMSDB");
mysqli_set_charset($con, "utf8");
if(mysqli_connect_errno()) {
	echo "Connection Fail".mysqli_connect_error();
}

?>