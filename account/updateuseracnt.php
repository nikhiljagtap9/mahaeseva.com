<?php include("../includes/configuration.php");
$uid = $_REQUEST['uid']; $ufname = $_REQUEST['ufname']; $ulname = $_REQUEST['ulname']; $uemail = $_REQUEST['uemail']; $umbl = $_REQUEST['umbl'];
$data = array('u_fname'=>$ufname, 'u_lname'=>$ulname, 'u_mobile'=>$umbl, 'u_email'=>$uemail);
$update = updateQuery(WEB_USER,$data,"u_id=".$uid);
if($update)
echo "1";
else
echo "0"; ?>