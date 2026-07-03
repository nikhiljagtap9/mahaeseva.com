<?php include("../../includes/configuration.php"); $plan = $_REQUEST['plan']; $arr = explode(",",$plan); $user = $_SESSION['user']; $getusername = selectQuery(USER,"*","u_id=".$user);
$data = array('credits'=>$arr[1], 'date'=>date("d/m/Y H:i:s"), 'amount'=>$arr[2], "status"=>"In Process");
$que = insertQuery(TOPUP,$data);
if($que){
/*$to=MAIN_ADMIN;*/
$to="sarvesh.s@suruninfocoresystems.com";
$headers1  = 'MIME-Version: 1.0' . "\r\n";
$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers1 .= "From:".EMAIL_SENDER;
$subject1="Top up request from ".SITENAME;
$body1=' <hr style="margin-bottom:50px"><div style="width: 70%;margin:0 auto">
<div style="margin: 0 auto;text-align: left"><img src="'.SITEURL.'/img/projectimage/logo.png" alt="" /></div>
<p>Dear Admin<br>SMS Top-up request received from '.$getusername[0]['u_name'].' for '.SITENAME.' with following plan ,
</p>
<div>
Price -'.$arr[2].'/- <br>
SMS -'.$arr[1].'
</div>
';
$sentmail2= @mail($to, $subject1, $body1, $headers1);
echo 1;
} else{ echo 0; }
?>