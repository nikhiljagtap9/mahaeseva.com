<?php include("../../includes/configuration.php"); $uid = $_POST['uid']; $setval = '1';
$data = array( 'isDel'=>$setval );
$que = updateQuery(WEB_USER,$data,"u_id=".$uid);
if($que){ echo 1; } else{ echo 0; } ?>