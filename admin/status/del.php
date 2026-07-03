<?php include("../../includes/configuration.php");
$uid = $_POST['uid']; $setval = '1';
$data = array( 'isdel'=>$setval, 'isActive'=>'0' );
$que = updateQuery(STATUS,$data,"s_id=".$uid);
if($que){
    echo 1;
}
else{ echo 0; } ?>