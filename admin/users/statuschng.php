<?php include("../../includes/configuration.php"); $uid = $_REQUEST['uid'];
$setval = $_REQUEST['status'];
$data = array('isActive'=>$setval, 'email_verified'=>1);
$que = updateQuery(WEB_USER,$data,"u_id=".$uid);
if($que){ echo 1; } else { echo 0; } ?>