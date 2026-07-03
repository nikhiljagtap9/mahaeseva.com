<?php include("../includes/configuration.php");
date_default_timezone_set('Asia/Calcutta');
$duration = (15 * 60);
$otp = $_REQUEST['code'];
$sess_otp = $_SESSION['otp'];
if(isset($_SESSION['otpstarted'])){
    $time = ($duration - (time() - $_SESSION['otpstarted']));
    if($time <= 0){
        echo 2;  unset($_SESSION['otp']); unset($_SESSION['otpstarted']);
    } else if($otp==$sess_otp){
        echo $otp; unset($_SESSION['otp']); unset($_SESSION['otpstarted']);
    } else{ echo 0; }
}
else{  echo 0; } ?>