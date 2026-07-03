<?php include("../includes/configuration.php");
unset($_SESSION["user"]);
unset($_SESSION['adminuname']);
unset($_SESSION['last_login_timestamp']);
unset($_SESSION['staff']);
unset($_SESSION['post']);
unset($_SESSION['dept']);
unset($_SESSION['staffname']);
unset($_SESSION['acc_type']);
unset($_SESSION['uname']);
echo '<script> window.location="'.ADMINURL.'index.php";</script>'; ?>