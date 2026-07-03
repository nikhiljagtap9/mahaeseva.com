<?php include("../../includes/configuration.php"); $uid = $_POST['uid']; $setval = '1'; $setval2 = '0';
$data = array('isdel'=>$setval);
$data2 = array('isActive'=>$setval2);
$que = updateQuery(USER,$data,"u_id=".$uid);
$que = updateQuery(USER,$data2,"u_id=".$uid);
if($que){echo 1;}else{ echo 0; } ?>
