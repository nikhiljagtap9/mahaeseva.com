<?php include("../../includes/configuration.php");
$testid = $_REQUEST['testid']; $setval = $_REQUEST['status'];
$data = array('isActive'=>$setval);
$que = updateQuery(TESTIMONIALS,$data,"test_id=".$testid);
if($que){ echo "1"; }else{ echo "0"; } ?>